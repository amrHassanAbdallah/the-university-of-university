@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{route('course.update',$Course->id)}}" method="post">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">
                        <label for="name">Course name</label>
                        <input name="name" type="text" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Enter course name" value="{{$Course->name}}">

                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" type="text" class="form-control" id="description"
                                  placeholder="Enter description"
                        >{{$Course->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Code</label>
                        <input type="text" class="form-control" id="code" placeholder="course code"
                               name="code" value="{{$Course->code}}">
                    </div>

                    <div class="form-group">
                        <label for="total_grade">total grade</label>
                        <input type="number" class="form-control" id="total_grade" placeholder="grade"
                               name="total_grade" value="{{$Course->total_grade}}">
                    </div>

                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Select course prerequisite</label>
                        <select name="prerequisite[]" multiple class="form-control" id="exampleFormControlSelect2">
                            @foreach($OtherCourses as $course)
                                <option value="{{$course->id}}">{{$course->name .', code: '. $course->code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Select course prerequisite to be deleted </label>
                        <select name="prerequisite_to_be_deleted[]" multiple class="form-control"
                                id="exampleFormControlSelect2">
                            @foreach($Prerequisites as $course)
                                <option value="{{$course->id}}">{{$course->name .', code: '. $course->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">update</button>
                </form>

            </div>

        </div>
    </div>
@endsection