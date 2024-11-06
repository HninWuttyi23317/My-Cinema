@extends('admin.layouts.main')
@section('content')
    {{-- <style>
    .col{
        column-gap: 1em
    }
</style> --}}
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="table-responsive table-responsive-data2">
                    <div class="my-3 fs-5">
                        <a href="{{ route('admin#bookingList') }}">
                            <i class="fa-sharp fa-regular fa-circle-left fa-beat text-white fs-5 ms-5"></i>
                        </a>
                    </div>
                    <div class="" style="display: grid; grid-template-columns: auto auto;">
                        {{-- @foreach ($bookingLists as $bLists) --}}
                            <div class="row ">
                                <div class="card offset-2 col-8">
                                    <div class="card-body">
                                        <h4 class="text-center">
                                            <i class="fa-solid fa-clipboard me-2"></i>Booking Info
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row pb-2">
                                            <div class="col">
                                                <i class="fa-solid fa-user-large me-2"></i>Name
                                            </div>
                                            <div class="col">
                                                {{ strtoupper($bookingLists[0]->user_name) }}
                                            </div>
                                        </div>
                                        <div class="row pb-2">
                                            <div class="col">
                                                <i class="fa-solid fa-envelope me-2"></i>Mail
                                            </div>
                                            <div class="col">
                                                {{ $bookingLists[0]->user_mail }}
                                            </div>
                                        </div>
                                        <div class="row pb-2">
                                            <div class="col">
                                                <i class="fa-solid fa-barcode me-2"></i>Booking Code
                                            </div>
                                            <div class="col fw-bold text-primary">
                                                {{ $bookingLists[0]->booking_code }}
                                            </div>
                                        </div>
                                        <div class="row pb-2">
                                            <div class="col">
                                                <i class="fa-solid fa-calendar-check me-2"></i>Booked_Date
                                            </div>
                                            <div class="col">
                                                {{ $bookingLists[0]->created_at->format('M-j-Y') }}
                                            </div>
                                        </div>
                                        <div class="row pb-2">
                                            <div class="col">
                                                <i class="fa-solid fa-money-check-dollar me-2"></i>Total
                                            </div>
                                            <div class="col">
                                                {{ $booking->total_price }} mmk
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- @endforeach --}}
                    </div>

                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Poster</th>
                                <th>Movie_Name</th>
                                <th>Theater</th>
                                <th>Show_date</th>
                                <th>Show_time</th>
                                <th>Seats</th>
                                {{-- <th>showtime_id</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookingLists as $bList)
                                <tr class="tr-shadow">

                                    <td class="col-2"><img src="{{ asset('storage/' . $bList->movie_image) }}"
                                            class="img-thumbnail"></td>

                                    <td>{{ $bList->movie }}</td>

                                    <td>{{ $bList->theater }}</td>

                                    <td> {{ \Carbon\Carbon::parse($bList->showtime)->format('j-M-Y') }}</td>

                                    <td> {{ \Carbon\Carbon::parse($bList->showtime)->format('g:i a') }}</td>

                                    <td>{{ $bList->seat_name }}</td>
                                    {{-- <td>{{ $bList->show_id }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection



{{-- @extends('admin.layouts.main')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool col-8 offset-2">
                        @foreach ($bookingLists as $bList)
                            <div class="card shadow-lg">

                                <div class="card-header d-flex">
                                    <a href="{{ route('admin#bookingList') }}">
                                        <i class="fa-sharp fa-regular fa-circle-left fa-beat text-dark fs-5 ms-3"></i>
                                    </a>
                                    <h3 class="text-dark ps-4">{{ $bList->booking_code }}</h3>
                                </div>

                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="text-dark me-5 fs-5 fw-bold">User : </p>
                                        <span class="text-danger fw-bold">
                                            {{ $bList->user }}
                                        </span>
                                    </div>
                                    <div class="d-flex">
                                        <p class="text-dark me-5 fs-5 fw-bold">Email : </p>
                                        <span class="text-danger fw-bold">
                                            {{ $bList->user_mail }}
                                        </span>
                                    </div>
                                    <div class="d-flex">
                                        <p class="text-dark me-5 fs-5 fw-bold">Movie : </p>
                                        <span class="text-danger fw-bold">
                                            {{ $bList->movie }}
                                        </span>
                                    </div>
                                    <div class="d-flex">
                                        <p class="text-dark me-5 fs-5 fw-bold">Theater : </p>
                                        <span class="text-danger fw-bold">
                                            {{ $bList->theater }}
                                        </span>
                                    </div>
                                    <div class="d-flex">
                                        <p class="text-dark me-5 fs-5 fw-bold">ShowDate : </p>
                                        <span class="text-danger fw-bold">
                                            {{ \Carbon\Carbon::parse($bList->showtime)->format('j-M-Y') }}
                                        </span>
                                    </div>
                                    <div class="d-flex">
                                        <p class="text-dark me-5 fs-5 fw-bold">ShowTime : </p>
                                        <span class="text-danger fw-bold">
                                            {{ \Carbon\Carbon::parse($bList->showtime)->format('g:i a') }}
                                        </span>
                                    </div>
                                    <div class="d-flex">
                                        <p class="text-dark me-5 fs-5 fw-bold">Seats : </p>
                                        <span class="text-danger fw-bold">
                                            {{ $bList->seat_name }}
                                        </span>
                                    </div>
                                    <div class="d-flex">
                                        <p class="text-dark me-5">ShowTime_Id : </p>
                                        <span class="text-danger">
                                            {{ $bList->show_id }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-footer"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection --}}
