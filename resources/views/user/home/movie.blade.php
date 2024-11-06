@extends('user.layouts.master')
@section('content')
   <!-- Now Showing Start -->
        <div class="container-xxl ">
            <div class="container">
                <div class="d-flex my-4">
                    <div class="text-center mx-auto py-4 mb-5 wow fadeInUp box" data-wow-delay="0.5s"
                    style="--color: #f71c1cde;">
                    <h2 class="text-uppercase py-4">Now Showing</h2>
                </div>

                </div>
                <div class="row g-4">
                    @if (count($movie) != 0)
                        @foreach ($movie as $m)
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                                <div class="team-item card">

                                    <div class="card-header bg-dark">
                                        <h5 class="text-white">{{ $m->movie_title }}</h5>
                                    </div>

                                    <div class="team-img position-relative overflow-hidden" style="background-color: rgba(255, 0, 0, 0.54)">

                                        <img class="img-fluid" src="{{ asset('storage/' . $m->image) }}">

                                        <div class="team-social">
                                            <a href="{{route('userMovie#trailer',$m->id)}}" data-wow-delay="0s">
                                                <button class="btn btn-square" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Trailerကြည့်ရန်...">
                                                    <i class="fa-solid fa-circle-play"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('userMovie#detail',$m->id)}}">
                                                <button class="btn btn-square" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Detailsကြည့်ရန်...">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('user#comments') }}">
                                                <button class="btn btn-square" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Reviewsကြည့်ရန်...">
                                                    <i class="fa-solid fa-comment-dots"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center bg-dark py-3 card-footer">
                                        <div class="text-danger">{{ $m->cast }}</div>
                                        <span class="text-danger">{{ $m->duration }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="noMovie">There is no movie here!</h3>
                    @endif
                </div>
            </div>
        </div>
        <!-- Movie End -->

    <!-- Upcoming Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto my-5 wow fadeInUp box" data-wow-delay="0.5s" style="--color: #07f41fde;">
                <h2 class="text-uppercase py-3">Coming Soon</h2>
            </div>
            {{-- @if (count($upmovie != 0)) --}}
            <div class="owl-carousel testimonial-carousel wow fadeInUp">
                @foreach ($upmovie as $up)

                <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src=' {{ asset('storage/' . $up->image) }} ' alt=''>">
                    <h4 class="text-uppercase py-2">{{ $up->movie_title }}</h4>
                    <p class="text-primary"> {{ $up->cast }} </p>
                    <p class="text-primary">Director : {{ $up->director }}</p>
                </div>

                @endforeach
            </div>
            {{-- @endif --}}
        </div>
    </div>
    <!-- Upcoming End -->
@endsection





