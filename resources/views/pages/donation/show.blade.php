@extends('layouts.app')

@section('content')
    <!--campaign-->
    <div class="row">
        <div class="col-12 col-sm-8">
          <h2 id="campaign-title">Campaign</h2>
          <p>
            Campaigns and Projects that are in need of
             funding, let's help by donating.
          </p>
        </div>
        <div class="ml-auto pr-3">
            <a href="{{url('donation/create')}}" class="btn btn-primary py-2 d-none d-sm-block" 
            style="margin-top: 55px;">Add campaign</a>
        </div>
        <a href="{{url('donation/create')}}" class="btn btn-primary py-2 d-block d-sm-none mx-3" 
        style="width: 100vw;">Add campaign</a>
    </div>
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
      {{$items->links()}}
   </center>
    <!--end campaign-->
@endsection