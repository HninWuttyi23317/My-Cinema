@extends('admin.layouts.main')
@section('title', 'Add Movie Theatres')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-6 offset-3">
                    <div class="card">

                        <div class="card-body">
                            <div class="card-title ">

                                <a href="{{ route('theaters#list') }}">
                                    <i class="fa-regular fa-circle-left text-dark" style="font-size: 25px"></i>
                                </a>

                                <h3 class="text-center title-2">Add Movie Theatre</h3>
                            </div>

                            <hr>
                            <form action="{{ route('theaters#creating') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="cc-payment" class="form-label my-2">Name</label>
                                    <input id="cc-pament" name="TName" type="text" value="{{ old('TName') }}"
                                        class="form-control @error('TName') is-invalid  @enderror" aria-required="true"
                                        aria-invalid="false">
                                    @error('TName')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="" class="form-label my-2">Theatre Image</label>
                                    <input type="file" name="TImage"
                                        class="form-control @error('TImage') is-invalid  @enderror">
                                    @error('TImage')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="location" class="form-label my-2">Location</label>
                                    <input type="text" name="location"
                                        class="form-control @error('location') is-invalid  @enderror">
                                    @error('location')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>

                        <div>
                            <button id="payment-button" type="submit" class="btn btn-danger col-6 offset-3">
                                <span id="payment-button-amount">Add</span>
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
