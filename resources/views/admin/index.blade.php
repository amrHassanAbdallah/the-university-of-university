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
                            Users
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Manage users</h5>
                            <p class="card-text">add , delete , edit users .</p>
                            <a href="{{route('user.index')}}" class="btn btn-primary">Go </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Courses
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Courses</h5>
                            <p class="card-text">add , delete , edit users .</p>
                            <a href="{{route('course.index')}}" class="btn btn-primary">Go </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Courses
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Classes</h5>
                            <p class="card-text">add , delete , edit Classes .</p>
                            <a href="{{route('class.index')}}" class="btn btn-primary">Go </a>
                        </div>
                    </div>
                </div>

            </div>
            {{--<div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Featured
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Featured
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
    </section>

@endsection