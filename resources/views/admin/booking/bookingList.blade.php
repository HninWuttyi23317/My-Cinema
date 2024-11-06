@extends('admin.layouts.main')
@section('title', 'Booking List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content bg-primary-subtle">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        {{-- total --}}
                        <div class="row pb-3">
                            <div class=" input-group-append">
                                <span class="fs-5 fw-bold input-group-text"><i class="fa-solid fa-database text-secondary me-2"></i>{{ count($booking) }}</span>
                            </div>
                        </div>
                        <form action="{{ route('admin#searchStatus') }}" method="get">
                            @csrf
                            <div class="table-data__tool-left d-flex">
                                {{-- <label for="">Status</label> --}}
                                <select name="bStatus" class="form-control">
                                    <option value="">All</option>
                                    <option value="0" @if (request('bStatus') == '0') selected @endif>Pending</option>
                                    <option value="1" @if (request('bStatus') == '1') selected @endif>Accept</option>
                                    <option value="2" @if (request('bStatus') == '2') selected @endif>Reject</option>
                                </select>
                                <button class="btn btn-sm bg-secondary text-white fw-bold" type="submit">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>

                    @if (count($booking) != 0)

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Booked_date</th>
                                        <th>User</th>
                                        <th>Code</th>
                                        <th>Total</th>
                                        {{-- <th>Contact_mail</th> --}}
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booking as $b)
                                        <tr class="tr-shadow shadow-lg">
                                            <input type="hidden" class="bookingId" value="{{ $b->id }}">

                                            <td>{{ $b->created_at->format('j-M-Y') }}</td>
                                            <td> {{ $b->user }}</td>
                                            <td>
                                                <a href="{{ route('admin#codeView', $b->booking_code) }}"
                                                    class="fw-bold text-decoration-none">
                                                    {{ $b->booking_code }}
                                                </a>
                                            </td>
                                            <td> {{ $b->total_price }} mmk</td>
                                            {{-- <td> {{ $b->user_mail }}</td> --}}
                                            <td>
                                                <select name="status" class="form-control statusChange">
                                                    <option value="0"
                                                        @if ($b->status == 0) selected @endif>Pending</option>
                                                    <option value="1"
                                                        @if ($b->status == 1) selected @endif>Accept</option>
                                                    <option value="2"
                                                        @if ($b->status == 2) selected @endif>Reject</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- <div class="mt-3">
                                {{ $booking->links() }}
                            </div> --}}
                        </div>
                    @else
                        <h2 class="text-secondary text-center mt-4">There is no booking here</h2>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $bookingId = $parentNode.find('.bookingId').val();
                // console.log($bookingId);

                $data = {
                    'status': $currentStatus,
                    'bookingId': $bookingId
                };

                $.ajax({

                    type: 'get',

                    url: 'http://127.0.0.1:8000/admin/booking/ajax/changeStatus',

                    data: $data,

                    dataType: 'json',
                })
                window.location.href = "http://127.0.0.1:8000/admin/booking/bookingList";
            })
        })
    </script>
@endsection
