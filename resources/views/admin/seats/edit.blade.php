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
                                <a href="{{ route('seat#list') }}"><i
                                        class="fa-solid fa-arrow-left-long text-dark"></i></a>
                                <h3 class="text-center title-2">Update</h3>
                            </div>

                            <hr>

                            <form action=" {{ route('seat#update') }} " method="POST">
                                @csrf
                                <div class="form-group">

                                    <input type="hidden" name="seatId" value="{{ $seats->id }}">

                                    <label class="mb-2 control-label text-danger font-weight-bold">Name</label>
                                    <input type="text" name="seatName" value="{{ old('seatName', $seats->seat_name) }}"
                                        class="form-control @error('seatName') is-invalid @enderror">
                                    @error('seatName')
                                        <div class="is-invalid text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">

                                    <label class="mb-2 control-label text-danger font-weight-bold">Price</label>
                                    <input type="text" name="Sprice" value="{{ old('Sprice', $seats->price) }}"
                                        class="form-control @error('Sprice') is-invalid @enderror">
                                    @error('Sprice')
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
                                                @if ($seats->theater_id == $t->id) selected @endif>{{ $t->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('theaters')
                                        <div class="is-invalid text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="mb-1 control-label">ShowTime</label>

                                    <select name="showtime" class="au-input au-input--full form-control" style="border-radius: 10px; height: 43px;">

                                        <option value="">Choose Theaters</option>
                                        @foreach ($schedule as $s)
                                            <option value="{{$s->id }}"
                                                @if ($seats->showtime_id == $s->id) selected @endif>{{ $s->id }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('showtime')
                                        <div class="is-invalid text-danger">
                                            {{ $message }}
                                        </div>
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
