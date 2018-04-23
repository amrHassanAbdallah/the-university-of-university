@extends('layouts.app')
@section('content')

    <section class="content-section" id="portfolio">
        <div class="container">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0">Your</h3>
                <h2 class="mb-5">Dashboard</h2>
            </div>

            <div class="row" style="margin-bottom: 40px;">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Courses
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">view classes</h5>
                            <p class="card-text">view classes ,students in classes , send mass mail for the whole class
                                .</p>
                            <a href="{{route('class.index')}}" class="btn btn-primary">Go </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Grades & record
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">view Grades & record </h5>
                            <p class="card-text"> current registered courses grades and transcript</p>
                            <a href="{{route('course.index')}}" class="btn btn-primary">Go </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection