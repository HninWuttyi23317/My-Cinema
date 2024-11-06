@extends('admin.layouts.main')
@section('title', 'Edit Movies')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid ">
                <div class="col-lg-11 offset-1">
                    <div class="card">
                        <div class="card-body">

                            {{-- <div class="card-title">
                                <h3 class="text-center title-2">Update</h3>
                            </div> --}}
                            <div class="ms-5">
                                <a href="{{ route('movies#list') }}"><i class="fa-solid fa-arrow-left-long"></i></a>
                            </div>

                            <hr>

                            <form action=" {{route('movies#update')}} " method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-5 offset-1">

                                        <input type="hidden" name="movieId" value="{{ $movie->id }}">

                                        <img src="{{ asset('storage/' . $movie->image) }}"
                                            class="img-thumbnail shadow-sm" />

                                            <div class="form-group">
                                                <label class="mb-2 control-label "></label>
                                                <input type="file" name="moviePoster"
                                                    class="form-control @error('moviePoster') is-invalid @enderror">
                                                @error('moviePoster')
                                                    <div class="is-invalid">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                                <textarea name="movieDescription" class="form-control @error('movieDescription')is-invalid @enderror" cols="30"
                                                    rows="10" placeholder="Enter description about movies...">{{ old('movieDescription', $movie->description) }}</textarea>

                                                @error('movieDescription')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                        <div class="mt-3">
                                            <button class="btn btn-danger col-12" type="submit">Update</button>
                                        </div>
                                    </div>

                                    <div class="row col-6">

                                        <div class="form-group">
                                            <label for="cc-payment" class="form-label">Movie_Name</label>
                                            <input id="cc-pament" name="movieName" type="text"
                                                value="{{ old('movieName', $movie->movie_title) }}"
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
                                            <select name="genre"
                                                class="form-select @error('genre') is-invalid @enderror">

                                                <option value="">Choose movie_genres</option>

                                                @foreach ($genres as $g)
                                                    <option value="{{ $g->id }}"
                                                        @if ($movie->genre_id == $g->id) selected @endif>
                                                        {{ $g->name }}</option>
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
                                            <input id="cc-pament" name="actor" type="text"
                                                value="{{ old('actor', $movie->cast) }}"
                                                class="form-control @error('actor') is-invalid  @enderror"
                                                aria-required="true" aria-invalid="false">
                                            @error('actor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="form-label my-2">Director</label>
                                            <input id="cc-pament" name="movieDirector" type="text"
                                                value="{{ old('movieDirector', $movie->director) }}"
                                                class="form-control @error('movieDirector') is-invalid  @enderror"
                                                aria-required="true" aria-invalid="false">
                                            @error('movieDirector')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="trailer" class="form-label my-2">Movie_Trailer</label>
                                            <input id="trailer" name="movieTrailer" type="file"
                                                value="{{ old('movieTrailer', $movie->trailer ?? '') }}"
                                                class="form-control @error('movieTrailer') is-invalid  @enderror"
                                                aria-required="true" aria-invalid="false">
                                            @error('movieTrailer')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="form-label my-2">Released_Date</label>
                                            <input id="cc-pament" name="releaseDate" type="date"
                                                value="{{ old('releaseDate', $movie->release_date) }}"
                                                class="form-control @error('releaseDate') is-invalid  @enderror"
                                                aria-required="true" aria-invalid="false">
                                            @error('releaseDate')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="form-label my-2">Duration</label>
                                            <input id="cc-pament" name="movieDuration" type="text"
                                                value="{{ old('movieDuration', $movie->duration) }}"
                                                class="form-control @error('movieDuration') is-invalid  @enderror"
                                                aria-required="true" aria-invalid="false">
                                            @error('movieDuration')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
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
