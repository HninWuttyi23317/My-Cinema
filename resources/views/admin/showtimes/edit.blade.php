@extends('admin.layouts.main')
@section('title', 'Edit')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid ">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-title row">
                                <a href="{{ route('showtimes#index') }}"><i
                                        class="fa-solid fa-arrow-left-long text-dark"></i></a>
                                <h3 class="text-center title-2">Update</h3>
                            </div>


                            <hr>

                            <form action=" {{ route('showtimes#update') }} " method="POST">
                                @csrf

                                <input type="hidden" name="scheduleId" value="{{ $schedules->id }}">

                                    <div class="form-group">
                                        <label for="" class="mb-1 control-label">Movie_Name</label>

                                        <select name="movies" class="au-input au-input--full form-control" style="border-radius: 10px; height: 43px;">

                                            <option value="">Choose Movies</option>
                                            @foreach ($movies as $m)
                                                <option value="{{$m->id }}"
                                                    @if ($schedules->movie_id == $m->id) selected @endif>{{ $m->movie_title }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('movies')
                                            <div class="is-invalid text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="mb-1 control-label">Theater_Name</label>

                                        <select name="theaters" class="au-input au-input--full form-control" style="border-radius: 10px; height: 43px;">

                                            <option value="">Choose Theaters</option>
                                            @foreach ($theaters as $t)
                                                <option value="{{$t->id }}"
                                                    @if ($schedules->theater_id == $t->id) selected @endif>{{ $t->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('theaters')
                                            <div class="is-invalid text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mx-5">
                                        <label for="" class="form-label my-2">Show_Time</label>
                                        <input type="datetime-local" name="showtime"
                                            value="{{ old('showtime', $schedules->show_time) }}"
                                            class="form-control @error('showtime') is-invalid  @enderror">
                                        @error('showtime')
                                            <div>class="invalid-feedback">
                                            {{ $message }}
                                        @enderror
                                    </div>

                                <button type="submit" class="btn btn-dark col-12">
                                    <span id="payment-button-amount">Update</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
