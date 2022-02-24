@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div>
                    <p id="demo">test</p>
                    <button class="btn btn-primary" type="button" id="jquery-get">Change</button>
                    <form method="post">
                        <input type="text" name="name" id="name" class="form-control">
                        <button type="button" class="btn btn-primary jquery-post">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function(){
        $('#jquery-get').click(function(){
            $.get("{{ route('jquery.ajax.get') }}", function(data, status){
                if(data){
                    $('#demo').html(data);
                    console.log(status);
                }
            });
        });

        $('.jquery-post').click(function(){
            let name = $('#name').val();
            let _token = "{{ csrf_token() }}";
            $.post("{{ route('jquery.ajax.post') }}", {name: name, _token: _token}, function(data, status){
                if(data){
                    $('#demo').html(data);
                    console.log(status);
                }
            });
        });
    });
</script>
@endpush
