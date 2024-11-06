@extends('user.layouts.master')
@section('content')
    <!-- Movie Detail Start -->
<div class="col-12 bg-light">
    <div class="card wow fadeInUp bg-light shadow shadow-sm" data-wow-delay="0.3s" style=" width:50%;margin-left:25%;">
        <div class="my-4">
            <a href="{{ route('user#movie') }}">
                <i class="fa-sharp fa-regular fa-circle-left text-dark fs-3 ms-4"></i>
            </a>
            <div class="card-header d-flex justify-content-center">
                <h4 class=" text-dark">{{$trailer->movie_title}}</h4>
            </div>
            <div class=" h-350 card-body">
                <video width="100%" height="350" controls="controls" autoplay class="pb-3">
                    <source src="{{ asset('storage/' . $trailer->trailer) }}" type="video/mp4" />
                </video>
            </div>
        </div>
    </div>
</div>
    <!-- Movie Detail End -->
@endsection
