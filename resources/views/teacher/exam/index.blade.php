@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-section-heading text-center">
                    <h3 class="text-secondary mb-0">Manage</h3>
                    <h2 class="mb-5">Exams</h2>
                </div>
            </div>


        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-pagination table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Course code</th>
                    <th>Course name</th>
                    <th>day</th>
                    <th>hour</th>
                    <th>location</th>
                    <th>type</th>
                    <th>grade</th>
                    <th>actions</th>

                </tr>
                </thead>
                <tbody>
                @foreach($exams as $exam)
                    <tr>
                        <td>{{$exam->Course->code}}</td>
                        <td>{{$exam->Course->name}}</td>
                        <td>{{$exam->test_day}}</td>
                        <td>{{$exam->test_hour}}</td>
                        <td>{{$exam->location}}</td>
                        <td>{{$exam->type}}</td>
                        <td>{{$exam->grade}}</td>
                        <td>
                            <a href="{{route('exam.edit',$exam->id)}}" class="btn btn-xs btn-info"
                               style="margin-right: 20px">Edit</a>
                            @if(date('Y-m-d') < $exam->test_day)
                            <form style="display: inline-block" action="{{route('exam.destroy',$exam->id)}}"
                                  method="post">
                                <input type="hidden" name="_method" value="delete">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                            </form>

                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </tfoot>
            </table>

        </div>

    </div>
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12">

                <h3> Other actions </h3>
                <br>
                <div><a href="{{route('exam.create')}}" class="btn btn-success">add an Exam</a></div>

            </div>
            <br>
            <div class="col-lg-6"></div>
        </div>

    </div>

    </div>
@endsection

