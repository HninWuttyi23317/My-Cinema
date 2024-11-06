@extends('admin.layouts.main')
@section('title', 'Edit')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid ">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-title row">
                                <a href="{{ route('movieGeneres#list') }}"><i
                                        class="fa-solid fa-arrow-left-long text-dark"></i></a>
                                <h3 class="text-center title-2">Update</h3>
                            </div>


                            <hr>

                            <form action=" {{ route('moviesGeneres#update') }} " method="POST">
                                @csrf
                                <div class="form-group">

                                    <input type="hidden" name="genereId" value="{{ $genere->id }}">

                                    <label class="mb-2 control-label text-danger font-weight-bold">Name</label>
                                    <input type="text" name="generesName" value="{{ old('generesName', $genere->name) }}"
                                        class="form-control @error('generesName') is-invalid @enderror">
                                    @error('generesName')
                                        <div class="is-invalid text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-dark col-12">
                                    <span id="payment-button-amount">Update</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
