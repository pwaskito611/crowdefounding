@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-8 p-4">
        <h2>
          {{$item->title}}
        </h2>
        <center>
            <div class="black-background">
                <img src="{{url($item->photo_path)}}" 
                style="max-height: 100%; max-width: 100%;" class="text-center">
            </div>
        </center>
        <div class="detail-description">
            <p style="white-space: pre-line;">
                {{$item->description}}
            </p>
            <h4>Campaign created by</h4>
            <div class="row">
                <div>
                    @if ($item->user->photo_path == null)
                    <img src="/asset/default.png" 
                    class="rounded detail-profile-image ml-3">
                    @else
                    <img src="{{url($item->user->photo_path)}}" 
                    class="rounded detail-profile-image ml-3">
                    @endif
                </div>
                <div class="ml-1 pt-2">
                    <h4 style="font-weight: 400;">{{$item->user->name}}</h4>
                </div>
            </div>
            @auth
                @if ($item->creator_id == \Auth::user()->id && $item->status == "OPEN")
                    <div class="row mt-2">
                        <form action="{{url('donation/edit')}}" method="get">
                            @csrf
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <button type="submit" class="btn btn-primary px-3 py-1 ml-3">Edit</button>
                        </form>
                        <form action="{{url('donation/close')}}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <button type="submit" class="btn btn-danger px-3 py-1 ml-2">Close campaign</button>
                        </form>
                    </div>
                @endif   

                @if ($item->creator_id == \Auth::user()->id && $item->status == "CLOSED")
                <div class="mt-2">
                    <form action="{{url('donation/reopen')}}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <button type="submit" class="btn btn-primary px-3 py-1 ">Reopen Campaign</button>
                    </form>
                    <br>
                    <form action="{{url('donation/take-funds-request')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <div class="form-group">
                        <label for="backAccount">Your bank account</label>
                        <input type="text" name="bankAccount" id="bankAccount" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-danger px-3 py-1 ">Take funds</button>
                    </form>
                </div>
                @endif

            @endauth
        </div>
    </div>
    <div class="col-sm-12 col-lg-4 p-4">
        <p>
            <span class="detail-assertive-word">${{$item->collected}}</span>
            <span class="detail-small-word">collected</span>
        </p>
        <p>
            <span class="detail-assertive-word">${{$item->target}}</span>
            <span class="detail-small-word">target</span>
        </p>
        <p>
            <span class="detail-assertive-word">{{($item->collected / $item->target * 100) - ($item->collected * $item->target * 100 % 1) }}%</span>
            <span class="detail-small-word">progress</span>
        </p>
        <p>
            <span class="detail-assertive-word" id="how-many-days-{{$item->id}}"></span>
            <span class="detail-small-word">days running</span>
        </p>
        <form action="{{url('payment/create')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$item->id}}">
            <div class="form-group">
                <label for="amount" class="form-label">Amount (usd)</label>
                <input type="number" name="amount" id="amount"  class="form-control">
            </div>
            <button type="submit" class="btn btn-primary form-control">Contribute</button>
        </form>
    </div>
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
@endsection