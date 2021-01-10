@extends('master')
@section('content')



<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form action="login" method="POST">
            @csrf
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
                <b><a>Forget Password</a></b><br><br>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <a href="/registrator">Registracia</a>
        </div>
    </div>

</div>



@endsection