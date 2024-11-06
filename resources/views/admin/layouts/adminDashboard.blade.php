@extends('admin.layouts.main')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row m-t-25">
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="fa-solid fa-user-check"></i>
                                    </div>
                                    <div class="text">
                                        <h3>{{count($user)}}</h3>
                                        <span>Total Users</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <canvas id="widgetChart1"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c2">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="fa-solid fa-clipboard-check"></i>
                                    </div>
                                    <div class="text">
                                        <h3>{{count($booking)}}</h3>
                                        <span>Bookings</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <canvas id="widgetChart2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c5">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="fa-solid fa-chair"></i>
                                    </div>
                                    <div class="text">
                                        <h3>{{count($seat)}}</h3>
                                        <span>Total Seats</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <canvas id="widgetChart5"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c3">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="text">
                                        <h3>{{count($normal)}} <i class="fa-solid fa-ban mx-1 fs-10"></i>(sold)</h3>
                                        <span>Available = {{count($normalAva)}} (3000mmk)</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <canvas id="widgetChart3"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 4000 --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c4">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="text">
                                        <h3>{{count($upper)}} <i class="fa-solid fa-ban mx-1 fs-10"></i>(sold)</h3>
                                        <span>Available = {{count($upperAva)}} (4000mmk)</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <canvas id="widgetChart4"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 5000 --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c6">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="text">
                                        <h3>{{count($five)}} <i class="fa-solid fa-ban mx-1 fs-10"></i>(sold)</h3>
                                        <span>Available = {{count($fiveAva)}} (5000mmk)</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <canvas id="widgetChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
