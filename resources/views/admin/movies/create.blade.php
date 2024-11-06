@extends('admin.layouts.main')
@section('title', 'Add NowShowing_Movie')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="card-title ">

                                <a href="{{ route('movies#list') }}">
                                    <i class="fa-regular fa-circle-left text-dark" style="font-size: 25px"></i>
                                </a>

                                <h3 class="text-center title-2">Add NowShowing_Movie</h3>
                            </div>

                            <hr>
                            <form action="{{ route('movies#creating') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                {{ csrf_field() }}
                                <div class="d-flex">

                                    <div class="form-group col-6">
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
                                    <div class="form-group col-6">

                                        <label class="control-label">Movie_Genres</label>
                                        <select name="genre" class="form-select @error('genre') is-invalid @enderror text-primary">

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
                                </div>

                                <div class="d-flex">
                                    <div class="form-group col-6">
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

                                    <div class="form-group col-6">
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
                                </div>

                                <div class="d-flex">
                                    <div class="form-group col-6">
                                        <label for="" class="form-label my-2">Movie Poster</label>
                                        <input type="file" name="moviePoster"
                                            class="form-control @error('moviePoster') is-invalid  @enderror">
                                        @error('moviePoster')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="cc-payment" class="form-label my-2">Movie_Trailer</label>
                                        <input id="cc-pament" name="movieTrailer" type="file"
                                            value="{{ old('movieTrailer') }}"
                                            class="form-control @error('movieTrailer') is-invalid  @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('movieTrailer')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <div class="form-group col-6">
                                        <label for="cc-payment" class="form-label my-2">Released_Date</label>
                                        <input id="cc-pament" name="releaseDate" type="date"
                                            value="{{ old('releaseDate') }}"
                                            class="form-control @error('releaseDate') is-invalid  @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('releaseDate')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="cc-payment" class="form-label my-2">Duration</label>
                                        <input id="cc-pament" name="movieDuration" type="text"
                                            value="{{ old('movieDuration') }}"
                                            class="form-control @error('movieDuration') is-invalid  @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('movieDuration')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-10 offset-1">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea name="movieDescription" class="form-control @error('movieDescription')is-invalid @enderror" cols="30"
                                        rows="10" placeholder="Enter description about movies...">{{ old('movieDescription') }}</textarea>

                                    @error('movieDescription')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-danger col-6 offset-3">
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
