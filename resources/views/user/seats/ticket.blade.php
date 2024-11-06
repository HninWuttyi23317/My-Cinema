@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-10 offset-1 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Poster</th>
                            <th>Movie_Name</th>
                            <th>Theater</th>
                            <th>Show_Time</th>
                            <th>Seats</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody class="align-middle">

                        @foreach ($ticketList as $tl)
                            <tr>
                                <input type="hidden" class="theaterId" value="{{ $tl->theater_id }}">
                                <input type="hidden" class="userId" value="{{ $tl->user_id }}">
                                <input type="hidden" class="movieId" value="{{ $tl->movie_id }}">
                                <input type="hidden" class="showtimeId" value="{{ $tl->showtime_id }}">
                                <td>
                                    {{ $tl->created_at->format('j-M-Y') }}
                                </td>

                                <td>
                                    <img class="img-fluid" src="{{ asset('storage/' . $tl->poster) }}"
                                        style="height: 80px;">
                                </td>

                                <td class="align-middle">
                                    {{ $tl->movie }}
                                </td>

                                <td class="align-middle"> {{ $tl->theater }} </td>
                                <td class="align-middle"> {{ $tl->showtime }} </td>
                                <td class="align-middle" id="seatName"> {{ $tl->seat_name }} </td>
                                <td class="align-middle" id="total"> {{ $tl->seat_price }} mmk </td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-danger btnRemove">
                                        <i class="fa fa-times me-1"></i> Cancel
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex offset-8 col-4" style="background-color:rgb(66, 66, 62);color:black; ">
                    <h5 id="totalPrice" class="px-4">Total : {{ $totalPrice }} mmk</h5>
                </div>
                <div class="offset-8 col-4">
                    <button class="btn btn-block font-weight-bold py-2"
                        style="width: 100%; background-color:blue;color:aliceblue;" id="checkout">
                        Booking
                    </button>
                </div>
            </div>
            {{--  --}}
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('script')
    <script>
        $('#checkout').click(function() {
            // console.log("order....");
            $orderList = [];
            $random = Math.floor(Math.random() * 1000000001);
            // console.log($random)
            $('#dataTable tbody tr').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('.userId').val(),
                    'movie_id': $(row).find('.movieId').val(),
                    'theater_id': $(row).find('.theaterId').val(),
                    'showtime_id': $(row).find('.showtimeId').val(),
                    'seat_name': $(row).find('#seatName').text(),
                    'total_price': $(row).find('#total').text().replace('mmk', '') * 1,
                    'booking_code': 'BCODE' + $random
                });
            });
            // console.log($orderList)
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/bookingList',
                data: Object.assign({}, $orderList),
                dataType: 'json',
                success: function(response) {
                    // console.log(response)
                    if (response.status == "true") {
                        window.location.href = "http://127.0.0.1:8000/user/mainPage";
                    }
                }
            })
        });

        $('.btnRemove').click(function() {
            $parentNode = $(this).parents("tr");
            $movieId = $parentNode.find(".movieId").val();
            $theaterId = $parentNode.find(".theaterId").val();
            $showtimeId = $parentNode.find(".showtimeId").val();
            $total = $parentNode.find("#total").text().replace('mmk', '');

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/remove',
                data: {
                    'movieId': $movieId,
                    'theaterId': $theaterId,
                    'showtimeId': $showtimeId,
                    'total': $total
                },
                dataType: 'json',
            })
            $parentNode.remove();
            $totalPrice = 0;
            $('#dataTable tbody tr').each(function(index, row) {
                $totalPrice += Number($(row).find('#total').text().replace("mmk", ""));
            });
            $("#totalPrice").html(`${$totalPrice} mmk`);
        })
    </script>
@endsection
