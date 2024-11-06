@extends('user.layouts.master')
@section('content')
    <!-- Password Change-->
    <div class="container-fluid col-5 offset-4">
        <div class="card">
            <div class="card-body bg-body-tertiary">
                <div class="card-title">
                    <a href="{{ route('user#home') }}">
                        <i class="fa-regular fa-circle-left text-dark me-5" style="font-size: 25px"></i>
                    </a>
                    <h3 class="text-center title-2 text-dark">Change Your Password</h3>
                </div>

                @if (session('changeSuccess'))
                    <div class="col-12">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert" style="border-radius: 10px; background-color:rgb(123, 221, 123);">
                            <i class="fa-solid fa-cloud-arrow-down me-2"></i>{{ session('changeSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if (session('notMatch'))
                    <div class="col-12" >
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px;">
                            <i class="fa-solid fa-cloud-arrow-down me-2"></i>{{ session('notMatch') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <hr>

                <form action="{{ route('user#change') }}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Old Password</label>
                        <input id="cc-pament" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror"
                        style="border-radius: 10px; height: 43px;" placeholder="Enter Old Password...">
                        @error('oldPassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">New Password</label>
                        <input id="cc-pament" name="newPassword" type="password" value=""
                            class="form-control
                                @error('newPassword')
                                    is-invalid
                                @enderror"
                        style="border-radius: 10px; height: 43px;" placeholder="Enter New Password...">

                        @error('newPassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                        <input id="cc-pament" name="confirmPassword" type="password" value=""
                            class="form-control

                                @error('confirmPassword')
                                    is-invalid
                                @enderror"
                        style="border-radius: 10px; height: 43px;" placeholder="Confirm Password...">

                        @error('confirmPassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div>
                        <button style="border-radius: 10px; height: 43px;" type="submit" class="btn btn-lg btn-dark text-white my-3">
                            Change Password <i class="fa-solid fa-circle-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Password Change-->
@endsection
