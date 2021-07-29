@extends('layouts.app')

@section('content')

<form action="{{url("logout")}}" method="post">
    @csrf
   <div class="row">

    @if ( \URL::full() == url('account') )
    <a href="{{'account'}}" class="py-3 px-2 mt-3 text-dark" style="font-weight: 500;">Profile</a>
    @else
    <a href="{{'account'}}" class="py-3 px-2 mt-3 text-dark">Profile</a>    
    @endif
    
    @if ( \URL::full() == url('my-campaign') )
    <a href="{{'my-campaign'}}" class="py-3 px-2 mt-3 text-dark" style="font-weight: 500;">My campaign</a>
    @else
    <a href="{{'my-campaign'}}" class="py-3 px-2 mt-3 text-dark">My campaign</a>
    @endif

    <button type="submit" class="btn btn-danger mt-4 mb-2" 
    style="margin-left: auto;">Logout</button>
   </div>
</form>

@foreach ($errors->all() as $error)
<div class="p-3 bg-danger rounded">
   <li>{{ $error }}</li>
</div>
@endforeach
<div class="row">
    <div class="col-sm-12 col-lg-4 p-4 border">
       <h3 class="text-center">
          Profile Picutre
       </h3>
       <center>
           <form action="{{url('account/update/photo-profile')}}" method="post" enctype="multipart/form-data">
               @csrf
                @method('put')
            <div class="form-group">
                <label for="profile-picture">
                  <p class="mt-3">before update</p>
                   @if (Auth::user()->photo_path == null)
                   <img src="/asset/default.png" 
                   style="max-width: 200px; max-height: 200px;"
                   class="rounded">
                   @else
                   <img src="{{Auth::user()->photo_path}}" 
                   style="max-width: 200px; max-height: 200px;"
                   class=" rounded">
                   @endif
                 </label>
                 <input type="file" name="image" id="profile-picture">
             </div>
             <button class="btn btn-primary ">Update profil picture</button>
           </form>
       </center>
    </div>

    <div class="col-sm-12 col-lg-4 p-4 border">
      <h3 class="text-center">
         Personal information
      </h3>
      <form action="{{url('account/update/personal-information')}}" method="POST">
        @csrf
        @method('put')
          <div class="form-group">
              <label for="name" class="form-label">Email</label>
              <input type="email" name="" id="" class="form-control"
              disabled value="{{Auth::user()->email}}">
          </div>
          <div class="form-group">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="name" id="name" class="form-control"
              value="{{Auth::user()->name}}">
          </div>
         <center>
          <button class="btn btn-primary">Update personal information</button>
         </center>
      </form>
   </div>

   <div class="col-sm-12 col-lg-4 p-4 border">
      <h3 class="text-center">
         Password
      </h3>
      <form action="{{url('account/update/password')}}" method="POST">
        @csrf
        @method('put')
          <div class="form-group">
              <label for="password" class="form-label">Current password</label>
              <input type="password" name="password" id="password" class="form-control">
          </div>
          <div class="form-group">
              <label for="newPasword" class="form-label">New password</label>
              <input type="password" name="newPassword" id="newPassword" class="form-control">
          </div>
          <div class="form-group">
              <label for="confirmPasword" class="form-label">Confirm new password</label>
              <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
          </div>
         <center>
          <button class="btn btn-primary">Update personal information</button>
          @if ( request()->session()->get('passwordChanged') !== null )
            @if (request()->session()->get('passwordChanged'))
                <p class="text-danger">Password updated</p>
            @else
                <p class="text-danger">You input wrong Password</p>
            @endif      
          @endif

          @php(request()->session()->forget('passwordChanged') )
         </center>
      </form>
   </div>

</div>
</div>
@endsection