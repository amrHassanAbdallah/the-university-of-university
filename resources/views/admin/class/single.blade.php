@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12" style="margin-bottom: 30px">
                <div class="content-section-heading text-center">

                    <h3 class="text-secondary mb-0">{{$class->name}}</h3>
                    <h4 class="mb-5">Class</h4>
                    <h3> date : {{$class->date}}</h3>
                    <h3> location : {{$class->location}}</h3>
                </div>


            </div>

            <div class="col-lg-6">
                <h3 class="text-secondary mb-0 text-center">course info</h3>
                <h5>code :{{$course->code}}</h5>
                <h5>name :{{$course->name}}</h5>
                <h5>score :{{$course->total_grade}}</h5>
                <h5>description :{{$course->description}}</h5>
            </div>
            <div class="col-lg-6 teacherSect text-center">
                <h3 class="text-secondary mb-0 text-center">Teacher info</h3>
                <?php $image = ($teacher->image) ?? 'img/Teachers-icon.png'; ?>
                <img src="{{asset($image)}}" alt="">
                <h5>name : {{$teacher->name}}</h5>

            </div>


        </div>
    </div>

@endsection