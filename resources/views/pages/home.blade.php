@extends('layouts.app')

@section('content')
    <!--header-->
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <h2 id="header-title">
              Different faiths, common action.
            </h2>
            <p id="header-content">
              Lorem ipsum dolor sit amet, consectetur adipiscing 
              elit, sed do eiusmod tempor incididunt ut labore et
              dolore magna aliqua.
            </p>
            <a href="{{url('donation')}}" class="btn btn-dark px-5 py-3">Browse donation</a>
        </div>
        <div class="col-sm-12 col-lg-6 row">
            <img src="/asset/alexandra-lammerink-18dBgSKfKPA-unsplash.jpg"
            id="header-image" class="ml-auto mr-auto">
        </div>
    </div>
    <!--end header-->

    <!--campaign-->
    <h2 class="text-center" id="campaign-title">Campaign</h2>
    <p class="text-center">
      Campaigns and Projects that are in need of
       funding, let's help by donating.
    </p>
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
                          <p class="donation-funds">${{$item->collected}}</p>
                          <p class="donation-information">Collected</p>
                          <p class="donation-funds">${{$item->target}}</p>
                          <p class="donation-information">Target</p>
                      </div>
                      <div class="col-sm-6 pr-2">
                        <p class="donation-funds">{{($item->collected / $item->target * 100) - ($item->collected * $item->target * 100 % 1) }}%</p>
                          <p class="donation-information">Progress</p>
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
      <a href="{{url('donation')}}" class="btn btn-dark mt-2 px-5 mb-5">See more</a>
   </center>
    <!--end campaign-->
@endsection