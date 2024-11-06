@extends('user.layouts.master')
@section('content')
    <!-- Comment Start -->
    <div class="container-lg py-5 wow fadeInUp bg-dark-subtle" data-wow-delay="0.4s">
        <form action="{{route('comment#update',$comment->id)}}" method="post">
            @csrf
            <input type="hidden" name="cmtId" value="{{$comment->id}}">
            <div class="col-4 offset-4 ">
                <div class="card-header shadow-sm">
                    <a href="{{ route('user#comments') }}"><i class="fa-solid fa-arrow-left-long"></i></a>
                    <h5 class="text-dark offset-3">Edit Your Comment</h5>
                </div>
                <div class="card-body">
                    <textarea name="postDescription" class="form-control @error('postDescription') is-invalid  @enderror"
                        rows="8" placeholder="Enter Post Description">{{ $comment->description }}</textarea>
                    @error('postDescription')
                        <small class="text-danger"><b>မှတ်ချက်ပေးရန်စာရိုက်ရပါမည်...</b></small>
                    @enderror
                </div>
                    <button class=" col-12 btn btn-dark text-white" type="submit">Update</button>
            </div>
        </form>
    </div>
    <!-- Comment End -->
@endsection
