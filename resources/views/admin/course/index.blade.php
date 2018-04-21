@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-section-heading text-center">
                    <h3 class="text-secondary mb-0">Manage</h3>
                    <h2 class="mb-5">Courses</h2>
                </div>
            </div>


        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-pagination table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>code</th>
                    <th>name</th>
                    <th>description</th>
                    <th>actions</th>

                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{$course->code}}</td>
                        <td>{{$course->name}}</td>
                        <td>{{$course->description}}</td>
                        <td>
                            <a href="{{route('course.edit',$course->id)}}" class="btn btn-xs btn-info"
                               style="margin-right: 20px">Edit</a>
                            <form style="display: inline-block" action="{{route('course.destroy',$course->id)}}"
                                  method="post">
                                <input type="hidden" name="_method" value="delete">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </tfoot>
            </table>

        </div>

    </div>

    <div class="row text-center">
        <div class="col-lg-12">

            <h3> Other actions </h3>
            <br>
            <div><a href="{{route('course.create')}}" class="btn btn-success">add a Course</a></div>

        </div>
        <br>
        <div class="col-lg-6"></div>
    </div>

    </div>
@endsection

