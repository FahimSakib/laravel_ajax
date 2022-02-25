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
                    <p id="demo"></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    let data = {
        "name" : "fahim",
        "email" : "fahim@mail.com",
        "fav" : ['mango','apple','xyz','abc']
    };
    let html = '<b>'+data.name+'</b><br><ol>';
    $.each(data.fav,function(key,value){
        html += '<li>'+value+'</li>';
    });
    html += '</ol>';
    $('#demo').append(html);
</script>
@endpush
