@extends('admin.layouts.main')
@section('title', 'Seat List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content bg-primary-subtle">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-right col-6 offset-3">
                            <div class="card" style="background-color: floralwhite;">
                                <div class="card-header">
                                    <div class="card-title ">

                                        <a href="{{ route('seat#list') }}">
                                            <i class="fa-regular fa-circle-left text-dark" style="font-size: 25px"></i>
                                        </a>

                                        {{-- <h3 class="text-center title-2">Add Seats</h3> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('seat#add') }}" method="post" novalidate="novalidate" class="col-8 offset-2">
                                        @csrf
                                        <div class="form-group pt-3 pe-3">
                                            <input id="cc-pament" name="seatName" type="text" value="{{ old('seatName') }}"
                                                class="form-control me-3 @error('seatName') is-invalid  @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Seats name">
                                            @error('seatName')
                                                <div class="invalid-feedback fw-bold text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group pt-3 pe-3">
                                            <input id="cc-pament" name="Sprice" type="number" value="{{ old('Sprice') }}"
                                                class="form-control me-3 @error('Sprice') is-invalid  @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Seats Price">
                                            @error('Sprice')
                                                <div class="invalid-feedback fw-bold text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group pt-3 pe-3">
                                            <select name="theaters" class="form-select @error('theaters') is-invalid @enderror text-primary">

                                                <option value="">Choose Theaters</option>

                                                @foreach ($theaters as $t)
                                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('theaters')
                                                <div class="invalid-feedback fw-bold text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group pt-3 pe-3">
                                            <select name="showtime" class="form-select @error('showtime') is-invalid @enderror text-primary">

                                                <option value="">Choose ShowTime</option>

                                                @foreach ($schedule as $s)
                                                    <option value="{{ $s->id }}">{{ $s->id }}</option>
                                                @endforeach
                                            </select>

                                            @error('showtime')
                                                <div class="invalid-feedback fw-bold text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn col-12 btn-danger"
                                            style="height: 40px;">
                                            Add Seats<i class="fa-solid fa-plus ms-2"></i>
                                        </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
