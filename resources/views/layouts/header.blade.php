  
<?php
use App\Http\Controllers\MailController;
$total = 0;
if(Auth::check() && auth()->user()->role =='employee' || Auth::check() && auth()->user()->role =='admin' )
{
  $total = MailController::message();
 
}
?>

<nav class="navbar navbar-default header-class">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand fas fa-paw header-title" href=""> <b>Solleza's AniShelter</b></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="{{route('home.index')}}"><b>Home</b> </a></li>
       
      </ul>
      <form action="{{route('animal.search')}}" class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" name= "search" class="form-control seacrh-box" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="{{route('email.index')}}"><i class="far fa-envelope-open">Email({{$total}})</i></a> </li>
        <li ><a class="f" href="{{route('animal.index')}}"><b>Animal</b></a ></li>

        @if(Auth::check() && auth()->user()->role =='employee' || Auth::check() && auth()->user()->role =='admin' )
        <li class="dropdown"> 
                 <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Menu
             <span class="caret"></span></a>
                <ul class="dropdown-menu">
              <li><a href="{{route('rescuer.index')}} " >Rescuer Table Info</li> </a></li> 
               <li><a href="{{route('adopter.index')}}" >Adopter Table Info</li> </a></li> 
             <li><a href="{{route('personnel.index')}}">Personnel Table Info</li> </a></li> 
             <li><a href="{{route('animaldisease_injury.index')}}">Medical Condition Info</li> </a></li> 
           </ul> 
        </li>
        <li class="dropdown"> 
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ auth()->user()->name}}
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a  href="{{route('profile')}}" >My Account</li> </a></li> 
          <li><a  href="{{route('rescuer.create')}}" >Add animal</li> </a></li> 
          <li><a  href="/logout" >Logout </li> </a></li> 
        </ul>
      </li>
      @elseif(Auth::check() && auth()->user()->role !='employee' || Auth::check() && auth()->user()->role !='admin' )
      <li class="dropdown"> 
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hello,{{auth()->user()->name}}
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a  href="{{route('profile')}}" >My Account</li> </a></li>  
          <li><a  href="{{route('user.logout')}}" >Logout </li> </a></li> 
        </ul> 
      </li>
        @else
        <li><a href="{{route('user.login')}}"><b>Login</b></a></li>
        <li><a href="{{route('register')}}"><b>Register</b></a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>