@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-section-heading text-center">
                    <h3 class="text-secondary mb-0">Manage</h3>
                    <h2 class="mb-5">Registration</h2>
                </div>
            </div>


        </div>
        <div class="col-lg-12">
            <table id="example" class="table table-pagination table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>start</th>
                    <th>end</th>
                    <th>actions</th>

                </tr>
                </thead>
                <tbody>
                @foreach($registrations as $registration)
                    <tr>
                        <td>{{$registration->start}}</td>
                        <td>{{$registration->end}}</td>
                        <td>
                            <a href="{{route('registration.edit',$registration->id)}}" class="btn btn-xs btn-info"
                               style="margin-right: 20px">Edit</a>
                            <form style="display: inline-block"
                                  action="{{route('registration.destroy',$registration->id)}}"
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
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-12">

                <h3> Other actions </h3>
                <br>
                <div><a href="{{route('registration.create')}}" class="btn btn-success">add a Registration</a></div>

            </div>
            <br>
            <div class="col-lg-6"></div>
        </div>

    </div>

    </div>
@endsection

