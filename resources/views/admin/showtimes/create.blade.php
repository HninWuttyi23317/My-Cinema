@extends('admin.layouts.main')
@section('title', 'Add Schedules')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-6 offset-3">
                    <div class="card">

                        <div class="card-body">
                            <div class="card-title ">

                                <a href="{{ route('showtimes#index') }}">
                                    <i class="fa-regular fa-circle-left text-dark" style="font-size: 25px"></i>
                                </a>

                                <h3 class="text-center title-2">Add Schedules</h3>
                            </div>

                            <hr>
                            <form action="{{ route('showtimes#creating') }}" method="post" novalidate="novalidate">
                                @csrf

                                <div class="form-group col-6">

                                    <label class="control-label mb-1">Movies</label>
                                    <select name="movies" class="form-select @error('movies') is-invalid @enderror text-primary">

                                        <option value="">Choose Movies</option>

                                        @foreach ($movies as $movie)
                                            <option value="{{ $movie->id }}">{{ $movie->movie_title }}</option>
                                        @endforeach
                                    </select>

                                    @error('movies')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-6">

                                    <label class="control-label mb-1">Theaters</label>
                                    <select name="theaters" class="form-select @error('theaters') is-invalid @enderror text-primary">

                                        <option value="">Choose Theaters</option>

                                        @foreach ($theaters as $theater)
                                            <option value="{{ $theater->id }}">{{ $theater->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('theaters')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                    <div class="form-group mx-5">
                                        <label for="" class="form-label my-2">Show_Time</label>
                                        <input type="datetime-local" name="showtime"
                                            class="form-control @error('showtime') is-invalid  @enderror">
                                            @error('showtime')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-danger col-6 offset-3 mb-3">
                                        <span id="payment-button-amount">Add</span>
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
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
