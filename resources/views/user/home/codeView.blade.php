@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div style="display: grid; grid-template-columns: auto auto; margin-left:5%" class="my-3">
                @foreach ($list as $l)
                    <div class="row ">
                        <div class="card col-8">
                            <div class="card-header">
                                <a href="{{ route('user#history') }}">
                                    <i class="fa-sharp fa-regular fa-circle-left fa-beat text-dark fs-5  pe-2"></i>
                                </a>
                                <h4 class="text-center text-dark">
                                    <i class="fa-solid fa-clipboard ms-4 me-2"></i>Booking Info
                                </h4>
                            </div>
                            <div class="card-body">
                                @foreach ($booking as $b)
                                    @if ($b->status == 0)
                                        <span class=" shadow-sm fs-7 fw-bold" style="color: rgb(93, 0, 255)">
                                            <i class="fa-solid fa-triangle-exclamation me-2 text-danger"></i>Pending....
                                        </span>
                                    @elseif ($b->status == 1)
                                        <span class=" shadow-sm fs-7 fw-bold" style="color: #018842ea">
                                            <i class="fa-solid fa-triangle-exclamation me-2 text-danger"></i>Accept!
                                        </span>
                                    @elseif ($b->status == 2)
                                        <span class=" shadow-sm  fw-bold" style="color: #891602">
                                            <i class="fa-solid fa-triangle-exclamation me-2 text-danger"></i>Some of the seats you selected are already taken.Choose again!
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                            <div class="card-body">
                                <div class="row pb-2">
                                    <div class="col">
                                        <i class="fa-solid fa-clapperboard me-3"></i>Movie_name
                                    </div>
                                    <div class="col">
                                        {{ $l->movie }}
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col">
                                        <i class="fa-solid fa-building-circle-check me-3"></i>Theater
                                    </div>
                                    <div class="col">
                                        {{ $l->theater }}
                                    </div>
                                </div>

                                <div class="row pb-2">
                                    <div class="col">
                                        <i class="fa-solid fa-barcode me-2 me-3"></i>Booking_Code
                                    </div>
                                    <div class="col fw-bold">
                                        {{ $l->booking_code }}
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col">
                                        <i class="fa-regular fa-calendar-check me-3"></i>Show_Date
                                    </div>
                                    <div class="col">
                                        {{ \Carbon\Carbon::parse($l->showtime)->format('j-M-Y') }}
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col">
                                        <i class="fa-solid fa-bell me-3"></i>Show_Time
                                    </div>
                                    <div class="col">
                                        {{ \Carbon\Carbon::parse($l->showtime)->format('g:i a') }}
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col">
                                        <i class="fa-solid fa-chair me-3"></i>Seats
                                    </div>
                                    <div class="col">
                                        {{ $l->seat_name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
