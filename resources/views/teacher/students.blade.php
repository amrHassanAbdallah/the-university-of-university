@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-section-heading text-center">


                    <h3 class="text-secondary mb-0">Manage</h3>

                    <h2 class="mb-5">Class</h2>
                </div>
            </div>


        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-pagination table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{$student->id}}</td>
                        <td>{{$student->name}}</td>

                        <td>
                            <a class="btn btn-primary d-inline-block" href="">send message</a>

                        </td>
                    </tr>
                @endforeach
            </table>

        </div>

    </div>
    {{--
    will be filling students grade section
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    @if(Auth::user()->level =="admin")
                    <h3> Other actions </h3>
                    <br>
                    <div><a href="{{route('class.create')}}" class="btn btn-success">add a Class</a></div>
                    @endif
                    @if(Auth::user()->level == 'student')
                        <h4 class="mb-3">enrollment</h4>
                        <table id="example" class="table table-pagination table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>name</th>
                                <th>date</th>
                                <th>location</th>
                                <th>state</th>
                                <th>actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($myClasses as $class)
                                <tr>
                                    <td>{{$class->name}}</td>
                                    <td>{{$class->date}}</td>
                                    <td>{{$class->location}}</td>
                                    <td>{{$class->getOriginal()['pivot_state']}}</td>
                                    <td>
                                        <form style="display: inline-block"
                                              action="{{route('class.cancelEnrollment',$class->id)}}"
                                              method="post">
                                            <input type="hidden" name="_method" value="PUT">
                                            {{csrf_field()}}

                                            <button type="submit" class="btn btn-xs btn-destroy"
                                                    style="margin-right: 20px">cancel enrollment
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            </tfoot>
                        </table>

                    @endif

                </div>
                <br>
                <div class="col-lg-6"></div>
            </div>

        </div>
    --}}
@endsection

