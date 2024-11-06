@extends('user.layouts.master')
@section('content')
    <!-- Movie Detail Start -->
    <div class=" wow fadeInUp movie bg-light" data-wow-delay="0.4s">
        <div class="ms-5">
            <a href="{{ route('user#movie') }}">
                <i class="fa-sharp fa-regular fa-circle-left text-dark fs-3 ms-5 my-2"></i>
            </a>
        </div>
        <div class="mt-4 col-10 offset-1 aboutMovie">

            <div class="imageDetail">
                <img src="{{ asset('storage/' . $movies->image) }}" alt="Image">

                <div  class="d-flex mt-3">
                    <a href="{{ route('userMovie#trailer', $movies->id) }}">
                        <i class="fa-solid fa-circle-play fa-beat text-danger fs-3 mx-2"></i>
                        <span class="">Watch Trailer</span>
                    </a>
                </div>

                <div class="my-3 d-flex">
                    @foreach ($showTime as $st)
                        <a href="{{route('user#showTime',$st->id)}}" class="me-2">
                            <button class="btn btn-danger text-dark"
                                style="border-radius: 10px">{{\Carbon\Carbon::parse($st->show_time)->format('j-M')}}</button>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="movieDetail">
                <h4 class="text-center text-dark">
                    <i class="fa-solid fa-clapperboard me-2"></i>{{ $movies->movie_title }}<i
                        class="fa-solid fa-clapperboard ms-2"></i>
                </h4>

                <input type="hidden" value="{{ Auth::user()->id }}" id="userId">
                <input type="hidden" value="{{ $movies->id }}" id="movieId">

                <h5 class="text-center text-dark">{{ $movies->cast }}</h5>

                <h5 class="text-center text-dark">Director : {{ $movies->director }}</h5>

                <p class=" text-dark me-2">Movie_genre : {{ $movies->genre_name }}</p>

                <p class="text-dark me-2">Duration : {{ $movies->duration }}</p>

                <p class="text-dark me-2">Release_date : {{ $movies->release_date }}</p>

                <p class="text-dark">{{ $movies->description }}</p>

                <div class="social d-flex">
                    <strong class="text-dark mr-2">Visit on:</strong>
                    <div class="d-inline-flex">
                        <a class="px-2" href="">
                            <i class="fa-brands fa-facebook" style="color: blue"></i>
                        </a>
                        <a class="px-2" href="">
                            <i class="fa-brands fa-square-youtube" style="color: rgba(255, 0, 0, 0.789)"></i>
                        </a>
                        <a class="px-2" href="">
                            <i class="fa-brands fa-tiktok" style="color: black"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Movie Detail End -->
@endsection
