@extends('admin.layouts.main')
@section('title', 'Edit Theater')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid ">
                <div class="col-lg-11 offset-1">
                    <div class="card">
                        <div class="card-body">

                            {{-- <div class="card-title">
                                <h3 class="text-center title-2">Update</h3>
                            </div> --}}
                            <div class="ms-5">
                                <a href="{{ route('theaters#list') }}"><i class="fa-solid fa-arrow-left-long"></i></a>
                            </div>

                            <hr>

                            <form action=" {{route('theaters#update')}} " method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                @endif --}}
                                <div class="row">

                                    <div class="col-5 offset-1">

                                        <input type="hidden" name="theaterId" value="{{ $theater->id }}">

                                        <img src="{{ asset('storage/' . $theater->image) }}"
                                            class="img-thumbnail shadow-sm" />


                                        <div class="mt-3">
                                            <button class="btn btn-danger col-12" type="submit">Update</button>
                                        </div>
                                    </div>

                                    <div class="row col-6">

                                        <div class="form-group">
                                            <label class="mb-2 control-label "></label>
                                            <input type="file" name="TImage"
                                                class="form-control @error('TImage') is-invalid @enderror">
                                            @error('TImage')
                                                <div class="is-invalid">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-2 control-label text-danger font-weight-bold">Theater Name</label>
                                            <input type="text" name="TName" value="{{ old('TName', $theater->name) }}"
                                                class="form-control @error('TName') is-invalid @enderror">
                                            @error('TName')
                                                <div class="is-invalid text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-2 control-label text-danger font-weight-bold">Location</label>
                                            <input type="text" name="location"
                                                value="{{ old('location', $theater->location) }}"
                                                class="form-control @error('location') is-invalid @enderror">
                                            @error('location')
                                                <div class="is-invalid text-danger">
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
