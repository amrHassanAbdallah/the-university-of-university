@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{route('course.store')}}" method="post">
                    <div class="form-group">
                        <label for="name">Course name</label>
                        <input name="name" type="text" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Enter course name" value="{{old('name')}}">

                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" type="text" class="form-control" id="description"
                                  placeholder="Enter description"
                        >{{old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Code</label>
                        <input type="text" class="form-control" id="code" placeholder="course code"
                               name="code" value="{{old('code')}}">
                    </div>

                    <div class="form-group">
                        <label for="total_grade">total grade</label>
                        <input type="number" class="form-control" id="total_grade" placeholder="grade"
                               name="total_grade" value="{{old('total_grade')}}">
                    </div>

                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Select course prerequisite</label>
                        <select name="prerequisite[]" multiple class="form-control" id="exampleFormControlSelect2">
                            @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>

        </div>
    </div>
@endsection