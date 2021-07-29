@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h4 class="font-weight-bold mb-0">Dashboard</h4>
        </div>
        <div>
            <a href="{{url('payment/update-all')}}" class="btn btn-primary btn-icon-text btn-rounded text-white">
              <i class="ti-clipboard btn-icon-prepend"></i>Update
            </a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title text-md-center text-xl-left">Donation</p>
          <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
            <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$donation}}</h3>
            <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
          </div>  
          <p class="mb-0 mt-2 text-danger"><span class="text-black ml-1"><small>(30 days)</small></span></p>
        </div>
      </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title text-md-center text-xl-left">Donor</p>
          <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
            <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$donor}}</h3>
            <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
          </div>  
          <p class="mb-0 mt-2 text-danger"><span class="text-black ml-1"><small>(30 days)</small></span></p>
        </div>
      </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title text-md-center text-xl-left">funds sended</p>
          <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
            <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$fundsSended}}</h3>
            <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
          </div>  
          <p class="mb-0 mt-2 text-success"><span class="text-black ml-1"><small>(30 days)</small></span></p>
        </div>
      </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title text-md-center text-xl-left">total funds held</p>
          <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
            <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$fundsSended}}</h3>
            <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
          </div>  
        </div>
      </div>
    </div>
  </div>
</div>
@endsection