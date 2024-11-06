@extends('admin.layouts.main')
@section('title', 'Changing Role')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid ">
                <div class="col-lg-11 offset-1">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-title">
                                <a href="{{ route('admin#list') }}">
                                    <i class="fa-regular fa-circle-left text-dark" style="font-size: 25px"></i>
                                </a>
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>

                            <hr>

                            <form action="{{ route('admin#change', $account->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-4 offset-1">
                                        @if ($account->image == null)

                                            @if ($account->gender == 'male')
                                                <img src="{{ asset('image/default.png') }}" class="shadow-sm img-thumbnail" style="width: 220px;height:220px;">
                                            @else
                                                <img src="{{ asset('image/femaleDefault.png') }}" class="shadow-sm img-thumbnail" style="width: 220px;height:220px;">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}" class="img-thumbnail  shadow-sm border-primary" style="width: 220px;height:220px;" />
                                        @endif

                                        <div class="mt-3">
                                            <button class="btn btn-danger col-10" type="submit">Change</button>
                                        </div>

                                    </div>

                                    <div class="row col-6">

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Name</label>
                                            <input type="text" name="name" disabled
                                                value="{{ old('name', $account->name) }}"
                                                class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                                <div class="is-invalid">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-1 control-label">Role</label>
                                             <select name="role" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                                                <option value="user" @if ($account->role == 'user') selected @endif>User</option>
                                             </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Email</label>
                                            <input type="email" name="email" disabled
                                                value="{{ old('email', $account->email) }}"
                                                class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                                <div class="is-invalid">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Phone</label>
                                            <input type="number" name="phone" disabled
                                                value="{{ old('phone', $account->phone) }}"
                                                class="form-control @error('phone') is-invalid @enderror">
                                            @error('phone')
                                                <div class="is-invalid">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Gender</label>
                                            <select name="gender" class="au-input au-input--full form-control" disabled
                                                style="border-radius: 10px; height: 43px;">
                                                <option value="">Choose Your Gender</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mb-1 control-label">Address</label>
                                            <textarea type="text" name="address" disabled class="form-control @error('address') is-invalid @enderror">{{ old('address', Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="is-invalid">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
