@extends('master')
@section('content')



<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form action="/registrator" method="POST">
            @csrf
            <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control"    placeholder="Enter name">
                    <span  style="background-color: red;"> @error('name'){{$message}}@enderror </span><br>   

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control"    placeholder="Enter email">
                    <span style="background-color: red;"> @error('email'){{$message}}@enderror </span><br>   
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control"  placeholder="Password">
                    <span style="background-color: red;"> @error('password'){{$message}}@enderror </span><br>   
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" name="password_1" class="form-control"  placeholder="Confirm Password">
                    <span style="background-color: red;"> @error('password_1'){{$message}}@enderror </span><br>   
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <b><a href="/login">LOGIN</a></b>

        </div>
    </div>

</div>



@endsection