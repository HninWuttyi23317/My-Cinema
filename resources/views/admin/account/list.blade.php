@extends('admin.layouts.main')
@section('title', 'Admin List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="text-secondary">Admin List</h2>
                            </div>
                        </div>
                    </div>
                    {{-- Create Alert --}}
                    @if (session('createSuccess'))
                        <div class="col-6 offset-6">
                            <div class="alert alert-success alert-dismissible fade show " role="alert">
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

                    {{-- Password Change Success alert --}}
                    @if (session('changeSuccess'))
                        <div class="col-12">
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-cloud-arrow-down me-2"></i>{{ session('changeSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- search --}}
                    <div class="row py-3">
                        <div class="col-4">
                            <h6 class=" text-light"> Search Key : <span class="text-secondary"> {{ request('key') }}</span> </h6>
                        </div>
                        <div class="col-4 offset-4">
                            <form action="{{ route('admin#list') }}" method="GET">
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
                            <h5 class="text-secondary"><i class="fa-solid fa-database"></i> {{ $admin->total() }}</h5>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">

                                        <td col="2">
                                            @if ($a->image == null)
                                                @if ($a->gender == 'male')
                                                    <img src="{{ asset('image/default.png') }}"
                                                        class="shadow-sm img-thumbnail" style="width: 100px; height:100px;">
                                                @else
                                                    <img src="{{ asset('image/femaleDefault.png') }}"
                                                        class="shadow-sm img-thumbnail" style="width: 100px; height:100px;">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}"
                                                    class="shadow-sm img-thumbnail" style="width: 100px; height:100px;">
                                            @endif
                                        </td>

                                        <td>{{ $a->name }}</td>

                                        <td>{{ $a->email }}</td>

                                        <td>{{ $a->gender }}</td>

                                        <td>{{ $a->phone }}</td>

                                        <td>{{ $a->address }}</td>

                                        <td>
                                            <div class="table-data-feature">

                                                @if (Auth::user()->id == $a->id)

                                                @else
                                                    <a href="{{route('admin#changeRole',$a->id)}}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Edit"><i class="fa-solid fa-user-minus"></i>
                                                        </button>
                                                    </a>
                                                    <a href=" {{ route('admin#delete', $a->id) }} ">

                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>

                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $admin->links() }}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
