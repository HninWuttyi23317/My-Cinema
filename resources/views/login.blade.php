@extends('layouts.master')

{{-- title --}}
@section('title', 'Login Page')

@section('content')

    @if (session('changeSuccess'))
        <div class="col-12">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-cloud-arrow-down me-2"></i>{{ session('changeSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="signin">
        <div class="box">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h2>Sign In</h2>
                <div class="inputBox ms-4">
                    <input type="email" name="email" placeholder="Email" class="text-white">
                    @error('email')
                    <small class="text-danger fs-6">{{ $message }}</small>
                @enderror
                </div>

                <div class="inputBox ms-4 mb-3">
                    <input type="password" name="password" placeholder="Password" class="text-white">
                    @error('password')
                    <small class="text-danger fs-6">{{ $message }}</small>
                @enderror
                </div>

                <div>
                    <button type="submit">Sign In</button>
                </div>

                <div class="links">
                    <a href="" class="text-white">Forgot Password?</a>
                    <a href="{{ route('auth#registerPage') }}">SignUp</a>
                </div>

                <div class="text-white fw-bold text-center">OR</div>

                <div class="text-white-50 text-center pt-2">Sign In with</div>

                <div class="icon  text-white pt-3 d-flex">
                    <span class="fb"><i class="fa-brands fa-facebook"></i></span>
                    <span class="ig"><i class="fa-brands fa-square-instagram"></i></span>
                    <span class="sk"><i class="fa-brands fa-skype"></i></span>
                </div>
            </form>
        </div>
    </div>
@endsection
