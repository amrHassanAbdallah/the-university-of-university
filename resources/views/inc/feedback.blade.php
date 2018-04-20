<div class="col-md-8    " style="margin: auto">

    @if(isset($errors) &&count($errors)>0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">  {{$error}}</div>

        @endforeach
    @endif
    @if(session('success'))
        <div class="alert alert-success text-center">{{session('success')}}    </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger"> {{session('error')}}</div>
    @endif


</div>