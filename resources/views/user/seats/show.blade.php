@extends('user.layouts.master')
@section('content')
    <style>
        .seat-container {
            perspective: 1000px;
            margin-bottom: 30px;
            background-color: #242333;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 60vh;
        }

        .screen {
            background-color: #fff;
            height: 80px;
            width: 300px;
            margin: 15px 0;
            transform: rotateX(-45deg);
            box-shadow: 0 3px 10px rgb(255, 255, 255, 0.7);
        }

        .seatRow {
            display: grid;
            grid-column-gap: 5px;
            grid-template-columns: repeat(10, auto);
            cursor: pointer;
        }

        .seatBtn {
            background-color: #4940fa;
            height: 30px;
            width: 40px;
            margin-top: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            color: #170101;
        }

        .seatBtn.selected {
            background-color: rgb(6, 235, 90);
        }

        .seatBtn.sold {
            cursor: not-allowed;
            background-color: #d51010;
        }

        .showcase .seatBtn:not(.sold):hover {
            cursor: pointer;
            transform: scale(1.1);
        }

        .showcase {
            background: rgba(0, 0, 0, 0.1);
            padding: 5px 10px;
            border-radius: 5px;
            color: #777;
            list-style-type: none;
            display: flex;
            justify-content: space-around;
        }

        .showcase li {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
        }

        .showcase li small {
            margin-left: 2px;
        }

        .checkout-button {
            background-color: #dd0404;
            color: #ffff;
            padding: 10px 15px 10px 15px;
            border-radius: 20px;
            transition: 0.6s;
        }

        .checkout-button:hover {
            transform: scale(1.1);
            filter: brightness(1);
            background-color: #7d0808;
        }
    </style>

    <div class="col-8 offset-2 bg-light my-3" style="height: 150vh">
        <a href="{{ route('userMovie#detail',$schedule->movie_id) }}">
            <i class="fa-sharp fa-regular fa-circle-left fa-beat text-dark fs-5 ms-3 pt-3"></i>
        </a>
        <ul class="showcase" id="showcase">
            <li>
                <button class="seatBtn available"></button>
                <small class="text-dark">Available</small>
            </li>
            <li>
                <button class="seatBtn selected"></button>
                <small class="text-dark">Selected</small>
            </li>
            <li>
                <button class="seatBtn sold"></button>
                <small class="text-dark">Sold</small>
            </li>
        </ul>

        <div class="seat-container" id="parentNode">

            <div class="screen">

            </div>

            <div class="seatRow" id="seatRow">

                <input type="hidden" value="{{ Auth::user()->id }}" id="userId">
                <input type="hidden" value="{{ $schedule->movie_id }}" id="movieId">
                <input type="hidden" value="{{ $schedule->theater_id }}" id="theaterId">
                <input type="hidden" value="{{ $schedule->id }}" id="showtimeId">

                @foreach ($seats as $seat)
                    <button class="seatBtn text-dark @if ($seat->status == '0') sold @endif" id="seatId"
                        type="button" value="{{ $seat->price }}">
                        {{ $seat->seat_name }}
                    </button>
                @endforeach
            </div>
            <ul id="bookingCount" class="d-flex justify-content-evenly" style="list-style: none">

            </ul>
            <b>Total Price: </b><span id="total">

            </span>
        </div>

        <div class="col-6 offset-3">
            <div class="d-flex">
                <b class="me-2 text-warning fs-5">Name :</b>
                <span class="text-dark fs-6">{{ $schedule->movie_name }}</span>
            </div>
            <div class="my-3 d-flex">
                <b class="me-2 text-warning fs-5">Cast :</b>
                <span class="text-dark fs-6">{{ $schedule->actor }}</span>
            </div>
            <div class="my-3 d-flex">
                <b class="me-2 text-warning fs-5">Theater :</b>
                <span class="text-dark fs-6">{{ $schedule->theater_name }}</span>
            </div>
            <div class="my-3 d-flex">
                <b class="me-2 text-warning fs-5">Show Time :</b>
                <span class="text-dark fs-6">{{ \Carbon\Carbon::parse($schedule->show_time)->format('g:i a') }}</span>
            </div>
            <div class="my-3 d-flex">
                <b class="me-2 text-warning fs-5">Show Date :</b>
                <span class="text-dark fs-6">{{ \Carbon\Carbon::parse($schedule->show_time)->format('j-F-Y') }}</span>
            </div>
            <button type="button" class="checkout-button" id="bookingBtn">Continue to Booking</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let selectedSeats = [];
            let totalPrice = 0;
            $('.seatBtn').click(function() {
                if (!$(this).hasClass('sold')) {
                    const seatPrice = parseFloat($(this).val());
                    const seatNumber = $(this).text();

                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                        selectedSeats = selectedSeats.filter(seat => seat.number !== seatNumber);
                        totalPrice -= seatPrice;
                    }
                    else
                    {
                        if (selectedSeats.length < 6) {
                            $(this).addClass('selected');
                            selectedSeats.push({
                                number: seatNumber,
                                price: seatPrice,
                            });
                            totalPrice += seatPrice;
                        } else {
                            alert('You can select maximum of 6 seats.');
                        }
                    }
                    updateBookingInfo();
                }
            });
            function updateBookingInfo() {
                $('#bookingCount').empty();
                selectedSeats.forEach(seat => {
                    $('#bookingCount').append(`<li>${seat.number}</li>`+',');
                });
                $('#total').text(totalPrice.toFixed(2));
            }
            $('#bookingBtn').click(function() {
                const seatNamesArray = selectedSeats.map(seat => seat.number);
                const seatNamesString = seatNamesArray.join(',');
                const data = {
                    userId: $('#userId').val(),
                    movieId: $('#movieId').val(),
                    theaterId: $('#theaterId').val(),
                    showtimeId: $('#showtimeId').val(),
                    seatNames: seatNamesString,
                    totalPrice: totalPrice.toFixed(2)
                };
                // console.log(data);
                $.ajax
                ({
                    type: 'GET',
                    url: 'http://127.0.0.1:8000/user/ajax/add/ToCart',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            alert("You selected this seat! Confirm it in your History");
                            window.location.href = "http://127.0.0.1:8000/user/mainPage";
                        }
                    }
                });
            });
        });
    </script>
@endsection
