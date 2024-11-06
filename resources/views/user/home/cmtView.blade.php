@extends('user.layouts.master')
@section('content')
    <!-- Comment Start -->
    <div class="container-lg py-5 wow fadeInUp bg-light" style="height: 60vh" data-wow-delay="0.4s">
        <div class="card col-6 offset-3 bg-dark-subtle">
            <div class="card-title d-flex shadow-lg">
                <div class="ms-5 py-2 text-dark">
                    <a href="{{ route('user#comments') }}"><i class="fa-solid fa-arrow-left-long fs-6"></i></a>
                </div>
                <div style="margin-left: 150px">
                    @if (Auth::user()->id == $comment->user_id)
                        <h5 class="text-dark -10 py-2">Your Comment</h5>
                    @else
                        <h5 class="text-dark -10 py-2">{{ $comment->user_name }}</h5>
                    @endif
                </div>
            </div>
            <div class="card-body col-8 offset-2">
                {{ $comment->description }}
            </div>
        </div>
    </div>
    <!-- Comment End -->
@endsection
