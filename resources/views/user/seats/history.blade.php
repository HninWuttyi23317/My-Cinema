@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-8 offset-2 table-responsive mb-5 mt-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Booking_Code</th>
                            <th>Total_Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody class="align-middle">

                        @foreach ($booking as $b)
                            <tr>
                                <input type="hidden" class="userId" value="{{ $b->user_id }}">
                                <input type="hidden" class="movieId" value="{{ $b->movie_id }}">

                                <td>
                                    {{ $b->created_at->format('j-M-Y') }}
                                </td>

                                <td class="align-middle fw-bold" >
                                    <a href="{{ route('user#codeView', $b->booking_code) }}" style="color: #1012a2; cursor: pointer;">
                                        {{ $b->booking_code }}
                                    </a>
                                </td>

                                <td class="align-middle"> {{ $b->total_price }} mmk</td>
                                <td class="align-middle" id="seatName">
                                    @if ($b->status == 0)
                                        <span class=" shadow-sm fs-7 fw-bold" style="color: rgb(246, 248, 128)">
                                            <i class="fa-solid fa-spinner me-2"></i>Pending...
                                        </span>
                                    @elseif ($b->status == 1)
                                        <span class=" shadow-sm fs-7 fw-bold" style="color: #00602fda">
                                            <i class="fa-regular fa-square-check me-2"></i> Confirmed...
                                        </span>
                                    @elseif ($b->status == 2)
                                        <span class=" shadow-sm fs-7 fw-bold" style="color: #891602">
                                            <i class="fa-solid fa-ban me-2"></i>Not available...
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
