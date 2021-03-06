@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{route('user.store')}}" method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Enter email" value="{{old('email')}}">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Enter Name"
                               value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                               name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Verify Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                               name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select name="level" class="form-control" id="exampleSelect1">
                            <option value="admin" @if(old('level') ==="admin") selected @endif>admin</option>
                            <option value="teacher" @if(old('level') ==="teacher") selected @endif>teacher</option>
                            <option value="student" @if(old('level') ==="student") selected @endif>student</option>
                            <option value="visitor" @if(old('level') ==="visitor") selected @endif>visitor</option>
                        </select>
                    </div>

                    {{csrf_field()}}


                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>

        </div>
    </div>
@endsection