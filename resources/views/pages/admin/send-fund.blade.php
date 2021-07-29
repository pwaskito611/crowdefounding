@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
       @forelse ($items as $item)
       <div class="card">
        <h5 class="card-header">{{$item->name}}</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <img src="{{url($item->photo_path)}}" 
                    style="max-width: 100%; max-height : 400px">
                </div>
                <div class="col-lg-9">
                    <h5 class="card-title">{{$item->title}}</h5>
                    <p class="card-text">Amount : ${{$item->collected}}</p>
                    <p class="card-text">Bank Account : {{$item->bank_account}}</p>
                    <div class="row">
                        <a href="{{url('donation/detail/' . $item->donation_id)}}" class="btn btn-secondary">Detail</a>
                        <form action="{{url('admin/send-fund/confirm')}}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <button type="submit" class="btn btn-secondary ml-2">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
       @empty
           <h2>No Donation is pending</h2>
       @endforelse
    </div>
    {{$items->links()}}
@endsection