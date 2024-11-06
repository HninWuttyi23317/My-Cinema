@extends('admin.layouts.main')
@section('title', 'Add Upcoming_Movie')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-12">
                    <div class="card col-6 offset-3">

                        <div class="card-body">
                            <div class="card-title ">

                                <a href="{{ route('upmovies#list') }}">
                                    <i class="fa-regular fa-circle-left text-dark" style="font-size: 25px"></i>
                                </a>

                                <h3 class="text-center title-2">Add Upcoming_Movie</h3>
                            </div>

                            <hr>
                            <form action="{{ route('upmovies#creating') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf

                                    <div class="form-group">
                                        <label for="cc-payment" class="form-label">Movie_Name</label>
                                        <input id="cc-pament" name="movieName" type="text" value="{{ old('movieName') }}"
                                            class="form-control @error('movieName') is-invalid  @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('movieName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">

                                        <label class="control-label">Movie_Genres</label>
                                        <select name="genre" class="form-select @error('genre') is-invalid @enderror text-primary fw-bold">

                                            <option value="">Choose movie_generes</option>

                                            @foreach ($genres as $g)
                                                <option value="{{ $g->id }}">{{ $g->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('genre')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="form-label my-2">Cast</label>
                                        <input id="cc-pament" name="actor" type="text" value="{{ old('actor') }}"
                                            class="form-control @error('actor') is-invalid  @enderror" aria-required="true"
                                            aria-invalid="false">
                                        @error('actor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="form-label my-2">Director</label>
                                        <input id="cc-pament" name="movieDirector" type="text"
                                            value="{{ old('movieDirector') }}"
                                            class="form-control @error('movieDirector') is-invalid  @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('movieDirector')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="form-label my-2">Movie Poster</label>
                                        <input type="file" name="moviePoster"
                                            class="form-control @error('moviePoster') is-invalid  @enderror">
                                        @error('moviePoster')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                    <button type="submit" class="btn btn-danger mb-5">
                                        <span id="payment-button-amount">Add</span>
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
