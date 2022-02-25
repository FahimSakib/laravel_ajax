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
                    <button class="btn btn-primary" type="button" onclick="OnClick()">Change</button>
                    <form method="post">
                        <input type="text" name="name" id="name" class="form-control">
                        <button type="button" class="btn btn-primary" onclick="ajaxPost()">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    function OnClick(){
        let req = new XMLHttpRequest();
        req.open('GET','{{ url('ajax') }}',true);
        req.send();

        req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        // Typical action to be performed when the document is ready:
        document.getElementById("demo").innerHTML = req.responseText;
            }
        }
    }
    function ajaxPost(){
        let name = document.getElementById('name').value;
        if(name){
            let req = new XMLHttpRequest();
            req.open('POST','{{route("ajax.post")}}',true);
            req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            req.send('name='+name+'&_token={{ csrf_token() }}');

            req.onreadystatechange = function(){
                console.log(req);
                if(req.readyState == 4 && req.status == 200){
                    document.getElementById('demo').innerHTML = req.responseText;
                }
            }
        }
        
    }
</script>
@endpush
