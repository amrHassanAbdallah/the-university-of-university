@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table id="example" class="table table-pagination table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>email</th>
                        <th>level</th>
                        <th>actions</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->level}}</td>
                            <td>
                                <a href="{{route('user.edit',$user->id)}}" class="btn btn-xs btn-info"
                                   style="margin-right: 20px">Edit</a>
                                <form style="display: inline-block" action="{{route('user.destroy',$user->id)}}"
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
                <div><a href="{{route('user.create')}}" class="btn btn-success">add a user</a></div>

            </div>
            <br>
            <div class="col-lg-6"></div>
        </div>

    </div>
@endsection

