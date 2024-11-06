@extends('layouts.master')

{{-- title --}}
@section('title', 'Register Page')

@section('content')

    <div class="signup">
        <div class="box">
            <form action="{{ route('register') }}" method="post">

                @csrf
                @error('terms')
                    <small class="text-danger  pt-1">{{ $message }}</small>
                @enderror

                <h2>Sign Up</h2>

                <div class="d-flex">
                    <div class="inputBox me-3">
                        <input type="text" placeholder="Enter Your Name" name="name" class="text-white ">
                        @error('name')
                            <small class="text-danger fs-6">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="inputBox">
                        <input type="email" placeholder="Enter Your Email" name="email" class="text-white">
                        @error('email')
                            <small class="text-danger fs-6 ">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="d-flex">
                    <div class="inputBox me-3">
                        <input type="number" name="phone" placeholder="09-xxxxxxxxx" class="text-white">
                        @error('phone')
                            <small class="text-danger fs-6">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="inputBox text-white">
                        <input type= "text-area" name="address" placeholder="Address" class="text-white">
                        @error('address')
                            <small class="text-danger fs-6">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="d-flex">
                    <div class="inputBox me-3">
                        <input type="password" name="password" placeholder="Password" class="text-white">
                        @error('password')
                            <small class="text-danger fs-6">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="inputBox text-white">
                        <input type="password" placeholder="Enter Your password" name="password_confirmation"
                            class="text-white">
                        @error('password_confirmation')
                            <small class="text-danger fs-6">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="inputBox ">
                    <select name="gender" id="" class="text-white">
                        <option value="">Choose Gender</option>
                        <option value="male" class="text-dark">Male</option>
                        <option value="female" class="text-dark">Female</option>
                    </select>
                    @error('gender')
                    <small class="text-danger fs-6">{{ $message }}</small>
                @enderror
                </div>

                <div>
                    <button type="submit">Sign Up</button>
                </div>


                <div class="icon  text-white pt-3 d-flex">
                    <span class="fb"><i class="fa-brands fa-facebook"></i></span>
                    <span class="ig"><i class="fa-brands fa-square-instagram"></i></span>
                    <span class="sk"><i class="fa-brands fa-skype"></i></span>
                </div>
                <div class=" text-center pt-3">
                    <p class="text-white-50 fs-12">
                        Already have account?
                        <a href="{{ route('auth#loginPage') }}" class=" text-decoration-none"
                        style="font-size: 18px; font-weight:bold">Sign In</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
