@extends('layouts.app')

@section('content')
     <!--form-->
     @foreach ($errors->all() as $error)
     <div class="p-3 bg-danger rounded">
        <li>{{ $error }}</li>
     </div>
     @endforeach
 <form action="{{url('donation/update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <input type="hidden" name="id" value="{{$item->id}}">
    <div class="form-group">
        <label for="exampleFormControlInput1">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="{{$item->title}}" required>
    </div>
     <div class="form-group">
        <label for="exampleFormControlInput1">Target (in ether)</label>
        <input type="number" class="form-control" name="target" value="{{$item->target}}" id="target" required> 
     </div>
     <div class="form-group">
        <label for="description">Description</label><br>
        <textarea name="description" name="description" id="description" rows="10"
        style="width: 100%;" required>{{$item->description}}</textarea> 
     </div>

     <div class="form-group">
         <p>Photo before update</p><br>
        <img src="{{url($item->photo_path)}}" style="max-width : 400px; max-height: 400px;">
     </div>

     <div class="form-group">
        <label for="image">
            <p class="camera-icon"><i class="fas fa-camera"></i></p>
           </label>
       <input type="file" name="image" id="image">
     </div>
     <div class="row">
         <button type="submit"  class="btn btn-primary ml-3">Submit</button>
         <a href="{{ url()->previous() }}" class="btn btn-secondary ml-3">Cancel</a>
     </div>
</form>
<!--end form-->

@endsection