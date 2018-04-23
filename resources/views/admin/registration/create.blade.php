@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{route('registration.store')}}" method="post">
                    <div class="form-group">
                        <label for="start">start</label>
                        <input name="start" type="date" class="form-control" id="start"
                               aria-describedby="emailHelp" placeholder="Enter start date for registration"
                               value="{{old('start')}}">

                    </div>
                    <div class="form-group">
                        <label for="end">end</label>
                        <input name="end" type="date" class="form-control" id="end"
                               aria-describedby="emailHelp" placeholder="Enter start date for registration"
                               value="{{old('end')}}">

                    </div>

                    {{csrf_field()}}


                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>

        </div>
    </div>
@endsection