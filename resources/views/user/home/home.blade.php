@extends('user/layouts.master')
@section('content')
    <!-- Home Start -->

    <div id="header-carousel" class="container-fluid p-0 carousel slide wow fadeIn" data-bs-ride="carousel"
        data-wow-delay="0.6s">

        <div class="carousel-inner">

            <div class="carousel-item row">

                <img src="{{ asset('user/img/bg3.jpg') }}" class="">

                <div class="home-text pb-5">

                    <h2>
                        <i class="fa-brands fa-monero M"></i><i class="fa-brands fa-yoast Y"></i><i
                            class="fa-regular fa-copyright C"></i>INEMA
                    </h2>

                    <h3 class="py-3">ShowTime :</h3>

                    <div class="dateBtn">
                        <div>
                            <button><span>| Sun |</span></button>
                            <button><span>| Mon |</span></button>
                            <button><span>| Tues |</span></button>
                            <button><span>| Wed |</span></button>
                        </div>
                        <div>
                            <button><span>| Thu |</span></button>
                            <button><span>| Fri |</span></button>
                            <button><span>| Sat |</span></button>
                        </div>
                    </div>

                    <div class="time mt-3">9:30 | 12:30 | 3:00 | 5:30 </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Home End -->
@endsection
