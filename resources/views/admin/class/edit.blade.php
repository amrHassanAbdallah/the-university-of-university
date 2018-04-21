@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{route('class.update',$class->id)}}" method="post">

                    <input type="hidden" name="_method" value="PUT">

                    {{csrf_field()}}

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label for="exampleFormControlSelect2">Select course </label>
                            <select name="course_id" class="form-control" id="exampleFormControlSelect2">
                                @foreach($courses as $course)
                                    <option value="{{$course->id}}"
                                            @if($class->course_id === $course->id) selected @endif>{{$course->name.', code: '. $course->code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label for="exampleFormControlSelect2">Select teacher </label>
                            <select name="user_id" class="form-control" id="exampleFormControlSelect2">
                                @foreach($teachers as $teacher)
                                    <option value="{{$teacher->id}}"
                                            @if($class->user_id === $teacher->id) selected @endif>{{$teacher->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="description">class name</label>
                        <input name="name" type="text" class="form-control" id="name"
                               placeholder="Enter class name" value="{{$class->name}}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="description">date</label>
                        <input name="date" type="text" class="form-control" id="date"
                               placeholder="Enter date" value="{{$class->date}}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">location</label>
                        <input type="text" class="form-control" id="location" placeholder="course code"
                               name="location" value="{{$class->location}}">
                    </div>


                    <button type="submit" class="btn btn-info">update</button>
                </form>

            </div>

        </div>
    </div>
@endsection