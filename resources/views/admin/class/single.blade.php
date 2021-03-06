@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12" style="margin-bottom: 30px">
                <div class="content-section-heading text-center">

                    <h4 class="">Class</h4>
                    <h3 class="text-secondary mb-5 ">{{$class->name}}</h3>
                    <h3> date : {{$class->date}}</h3>
                    <h3> location : {{$class->location}}</h3>
                </div>


            </div>

            <div class="col-lg-6">
                <h3 class="text-secondary mb-3 text-center">course info</h3>
                <h5>code :{{$course->code}}</h5>
                <h5>name :{{$course->name}}</h5>
                <h5>score :{{$course->total_grade}}</h5>
                <h5>description :{{$course->description}}</h5>

                <h4 class="text-secondary mb-3 text-center">Prerequisite</h4>
                @foreach($PreCourses as $preCours)
                    <h6>code :{{$preCours->code}}</h6>
                    <h6>name :{{$preCours->name}}</h6>
                    <h6>score :{{$preCours->total_grade}}</h6>
                    <h6>description :{{$preCours->description}}</h6>
                    <br>
                @endforeach
                @if(!count($PreCourses))
                    None
                @endif
            </div>
            <div class="col-lg-6 teacherSect text-center">
                <h3 class="text-secondary mb-3 text-center">Teacher info</h3>
                <?php $image = ($teacher->image) ?? 'img/Teachers-icon.png'; ?>
                <img src="{{asset($image)}}" alt="">
                <h5>name : {{$teacher->name}}</h5>

            </div>


        </div>
    </div>
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12">
                @if(Auth::user()->level =="student"&&!Auth::user()->Classes()->where('id',$class->id)->first())
                    <h3> Other actions </h3>
                    <br>
                    <div>

                        <form style="display: inline-block" action="{{route('class.join',$class->id)}}"
                              method="post">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-xs btn-primary">Join class</button>
                        </form>


                    </div>
                @else
                    you already enrolled in this course
                @endif

            </div>
            <br>
            <div class="col-lg-6"></div>
        </div>

    </div>

@endsection