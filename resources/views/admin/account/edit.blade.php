@extends('admin.layouts.main')
@section('title', 'Admin Profile')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid ">
                <div class="col-lg-11 offset-1">
                    <div class="card">
                        <div class="card-body bg-success-subtle">

                            <div class="card-title">
                                <a href="{{ route('admin#profile') }}">
                                    <i class="fa-regular fa-circle-left text-dark" style="font-size: 25px"></i>
                                </a>
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>

                            <hr>

                            <form action="{{route('admin#updateProfile',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-5 offset-1">
                                        @if (Auth::user()->image == null)

                                            @if (Auth::user()->gender == 'male')
                                                <img src="{{ asset('image/default.png') }}" class="shadow-sm img-thumbnail"
                                                    style="height: 130px; width: 140px; border-radius:50%;">
                                            @else
                                                <img src="{{ asset('image/femaleDefault.png') }}" class="shadow-sm img-thumbnail"
                                                    style="height: 130px; width: 140px; border-radius:50%;">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                style="height: 130px; width: 140px; border-radius:50%;"
                                                class="img-thumbnail
                                            shadow-sm border-primary" />
                                        @endif

                                        <div class="form-group">
                                            <h5 class=" my-2 mx-3">Change Profile</h5>
                                            <input type="file" name="image" class="form-control">
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-outline-danger col-12" type="submit">Update</button>
                                        </div>

                                    </div>

                                    <div class="row col-6">

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Name</label>
                                            <input type="text" name="name"
                                                value="{{ old('name', Auth::user()->name) }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Email</label>
                                            <input type="email" name="email"
                                                value="{{ old('email', Auth::user()->email) }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Phone</label>
                                            <input type="number" name="phone"
                                                value="{{ old('phone', Auth::user()->phone) }}" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Gender</label>
                                            <select name="gender" class="au-input au-input--full form-control" style="border-radius: 10px; height: 43px;">
                                                <option value="">Choose Your Gender</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif >Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif >Female</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Address</label>
                                            <textarea type="text" name="address" class="form-control">{{ old('address', Auth::user()->address) }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Role</label>
                                            <input type="text" name="role"
                                                value="{{ old('role', Auth::user()->role) }}" class="form-control"
                                                disabled></input>
                                        </div>
                                    </div>
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
