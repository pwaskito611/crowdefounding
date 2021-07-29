@extends('layouts.app')

@section('content')
    <!--campaign-->
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
    <div class="row some-donation">
        @foreach ($items as $item)
        <div class="col-sm-12 col-lg-4 p-4">
            <div class="border p-4">
                  <h4 style="font-weight: 500;">
                     {{$item->title}}
                  </h4>
                  <div class="line-1 mb-2"></div>
                  <div class="row">
                      <div class="col-sm-6 pl-2">
                          <p class="donation-funds">3.81111 ETH</p>
                          <p class="donation-information">Collected</p>
                          <p class="donation-funds">{{$item->target}} ETH</p>
                          <p class="donation-information">Target</p>
                      </div>
                      <div class="col-sm-6 pr-2">
                          <p class="donation-funds">55</p>
                          <p class="donation-information">Contributor</p>
                          <p class="donation-funds" id="how-many-days-{{$item->id}}"></p>
                          <p class="donation-information">days running</p>
                      </div>
                  </div>
                  <div class="line-1"></div>
                  <center>
                      <a href="{{url('donation/detail/'. $item->id)}}" class="btn btn-dark mt-3 px-5">Detail</a>
                  </center>
            </div>
        </div>
        <script>
            start = new Date("{{$item->created_at}}"),
            end   = new Date(),
            diff  = new Date(end - start),
            minus = diff /1000/60/60/24 % 1
            days  = diff /1000/60/60/24 - minus;
            $("#how-many-days-{{$item->id}}").text(days)
        </script>
        @endforeach
    </div>
   <center>
      {{$items->links()}}
   </center>
    <!--end campaign-->
@endsection