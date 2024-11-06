@extends('admin.layouts.main')
@section('title', 'Movie_Generes List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content bg-primary-subtle">
        <div class="row">
            @if (session('updateSuccess'))
                <div class="col-6 offset-5">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-cloud-arrow-down me-2"></i>{{ session('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>

        {{-- Create Alert  --}}
        @if (session('createSuccess'))
        <div class="col-6 offset-6">
            <div class="alert alert-info alert-dismissible fade show " role="alert">
                <i class="fa-regular fa-circle-check"></i>{{ session('createSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif

    {{-- Delete Alert --}}
    @if (session('deleteSuccess'))
        <div class="col-6 offset-6">
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <i class="fa-regular fa-circle-check"></i>{{ session('deleteSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1 text-white">Generes List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">

                            <form action="{{route('moviesGeneres#add')}}" method="post" novalidate="novalidate" class="d-flex">
                                @csrf
                                <div class="form-group">
                                    <input id="cc-pament" name="generesName" type="text" value="{{ old('generesName') }}"
                                        class="form-control me-3 @error('generesName') is-invalid  @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter name">
                                    @error('generesName')
                                        <div class="invalid-feedback fw-bold" style="color: rgb(255, 126, 114);">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button id="payment-button" type="submit" class="btn btn-primary ms-2" style="height: 40px;">
                                    <span id="payment-button-amount">Add</span>
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>


                    {{-- search --}}
                    <div class="row py-3">
                        <div class="col-4">
                            <h6 class="text-white"> Search Key : <span class="text-danger"> {{ request('key') }}</span> </h6>
                        </div>
                        <div class="col-4 offset-4">
                            <form action="{{ route('movieGeneres#list') }}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" class="form-control" name="key" placeholder="Search..."
                                        value="{{ request('key') }}"></input>
                                    <button class="btn bg-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- total --}}
                    <div class="row pb-3">
                        <div class="col-3">
                            <h5 class="text-white"><i class="fa-solid fa-database"></i> {{ $generes->total() }}</h5>
                        </div>
                    </div>

                    @if (count($generes) != 0)

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($generes as $genere)
                                        <tr class="tr-shadow">

                                            <td>{{ $genere->id }}</td>

                                            <td>{{ $genere->name }}</td>

                                            <td>
                                                <div class="table-data-feature">

                                                    <a href="{{route('moviesGeneres#edit',$genere->id)}}" class="me-3">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{route('moviesGeneres#delete',$genere->id)}}" class="px-2">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $generes->links() }}
                            </div>
                        </div>
                    @else
                        <h2 class="text-secondary text-center mt-4">There is no theatre here</h2>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
