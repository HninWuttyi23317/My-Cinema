@extends('admin.layouts.main')
@section('title', 'Movie Details')
@section('content')
<!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid ">
                <div class="col-lg-11 offset-1">
                    <div class="card shadow-lg">
                        <div class="card-body">

                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left-long" onclick="history.back()"></i>
                            </div>

                            <div class="card-title">
                                <h3 class="text-center title-2">Movie Details</h3>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="offset-1 col-5">

                                    <div>
                                        <img class="col-12" style="height:200px; width:250px" src="{{ asset('storage/' . $movie->image) }}" class="shadow-sm img-thumbnail" />
                                    </div>

                                    <div class="mt-3">
                                        <div class="d-flex">
                                            <b class="me-2 text-danger">Name :</b>{{ $movie->movie_title }}
                                        </div>

                                        <div class="my-3 d-flex">
                                            <b class="me-2 text-danger">Cast:</b> {{ $movie->cast }}
                                        </div>

                                        <div class="my-3 d-flex">
                                            <b class="me-2 text-danger">Duration :</b> {{ $movie->duration }}
                                        </div>

                                        <div class="my-3 d-flex">
                                            <b class="me-2 text-danger">Movie_genre :</b> {{ $movie->genre_name }}
                                        </div>

                                        <div class="my-3 d-flex">
                                            <b class="me-2 text-danger">Director :</b> {{ $movie->director }}
                                        </div>

                                        <div class="my-3 d-flex">
                                            <b class="me-2 text-danger">Release_Date :</b>
                                            {{ \Carbon\Carbon::parse($movie->release_date)->format('M-Y') }}
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6">

                                    <div class=" card-header">
                                        <video class="col-12" controls="controls" autoplay>
                                            <source src="{{ asset('storage/' . $movie->trailer) }}" type="video/mp4" />
                                        </video>
                                    </div>

                                    <div class="shadow-sm card-body">
                                        <div class="fs-5 bold text-danger"> <i class="fa-solid fa-file-lines me-2"></i> :</div>
                                        <div class="">{{ $movie->description }}</div>
                                    </div>
                                </div>
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
@section('scriptSource')
<script>

</script>
@endsection
