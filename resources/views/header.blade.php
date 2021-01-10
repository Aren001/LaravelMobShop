<?php 
use App\Http\Controllers\ProductController;
use Illuminate\Contracts\Session\Session;

$total=0;
// if(Session::has('user'))
// {
  $total= ProductController::cartItem();
// }
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">ElectronicS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">


        <li class="active"><a href="/">Home</span></a></li>
        <li><a href="/myorders">Orders</a></li>
        <li class="text-warning admin"><a   href="/login">AdminPanel</a></li>
       

      </ul>

      <!-- SEARCH -->
      <form action="/search" class="navbar-form navbar-left">
        <div class="form-group">
          <!-- Name pti unena -->
          <input type="text" name="query" class="form-control" placeholder="Search"> 
        </div>
        <button type="submit"  class="btn btn-default">SEARCH</button>
      </form>



      <ul class="nav navbar-nav navbar-right">
        <li><a href="/cartlist">Cart({{$total}})</a></li>
        <li style="background-color: red;color:black;"><a href="/login">SignIn</a></li>
        <li><a class="dropdown-toggle"  href="#" style="color:#00DB3A; font-size:30px; " > User -* {{session()->get('user')['name']}}</li>
        
       
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>