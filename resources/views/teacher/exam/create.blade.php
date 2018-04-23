@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{route('exam.store')}}" method="post">
                    <div class="form-group">
                        <label for="location">location</label>
                        <input name="location" type="text" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Enter location" value="{{old('location')}}">

                    </div>
                    <div class="form-group">
                        <label for="description">exam day </label>
                        <input name="test_day" type="date" class="form-control" id="test_day"
                               placeholder="Enter exam date "
                                {{old('test_day')}}>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">grade</label>
                        <input type="number" class="form-control" id="code" placeholder="exam grade"
                               name="grade" value="{{old('grade')}}">
                    </div>

                    <div class="form-group">
                        <label for="test_hour">hour </label>
                        <input name="test_hour" type="text" class="form-control" id="test_hour"
                               placeholder="ex : 9 am"
                                {{old('test_hour')}}>
                    </div>
                    <div class="form-group">
                        <label for="type">Exam type </label>
                        <select name="type" class="form-control" id="type">
                            <option value="quiz">quiz</option>
                            <option value="midterm">midterm</option>
                            <option value="final">final</option>
                        </select>
                    </div>
                    {{csrf_field()}}

                    <div class="form-group ">
                        <label for="exampleFormControlSelect2">Select course </label>
                        <select name="course_id" class="form-control" id="exampleFormControlSelect2">
                            @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->name.', code: '. $course->code }}</option>
                            @endforeach
                        </select>

                        {{--
                                                <div class="col-lg-6">
                                                    <label for="exampleFormControlSelect2">Select Class/es </label>
                                                    <select name="classes[]" multiple class="form-control" id="exampleFormControlSelect2">
                                                        @foreach($classes as $class)
                                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                        --}}

                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>

            </div>

        </div>
    </div>
@endsection