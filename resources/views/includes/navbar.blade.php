<!--navbar-->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" href="{{url('/')}}"><b>Ether4Charity</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        
        @if (\URL::full() == url('/'))
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/')}}">Home</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{url('/')}}">Home</a>
        </li>
        @endif

        
        @if (\URL::full() == url('/donation'))
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/donation')}}">Donation</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{url('donation')}}">Donation</a>
        </li> 
        @endif

        @auth

        @if (\URL::full() == url('/account'))
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/account')}}">Account</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{url('account')}}">Account</a>
        </li> 
        @endif

        @if (Auth::user()->role == 'admin')
        
        <li class="nav-item">
          <a class="nav-link" href="{{url('/admin')}}">Admin panel</a>
        </li>
        
        @endif

        @endauth

        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{url('login')}}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('register')}}"><b>Signup</b></a>
        </li>
        @endguest

      </ul>
    </div>
  </nav>
    <!--end navbar-->
