@extends('admin.layouts.main')
@section('title', 'User_List')
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
                                <h2 class="text-secondary">User Lists</h2>
                            </div>
                        </div>
                    </div>

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
                            <h6 class=" text-light"> Search Key : <span class="text-secondary"> {{ request('key') }}</span>
                            </h6>
                        </div>
                        <div class="col-4 offset-4">
                            <form action="{{ route('user#list') }}" method="GET">
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
                            <h5 class="text-secondary"><i class="fa-solid fa-database"></i> {{ $users->total() }}</h5>
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

                                @foreach ($users as $u)
                                    <tr class="tr-shadow">

                                        <td>
                                            @if ($u->image == null)
                                                @if ($u->gender == 'male')
                                                    <img src="{{ asset('image/default.png') }}"
                                                        class="shadow-sm img-thumbnail" style="width: 80px; height:80px;">
                                                @else
                                                    <img src="{{ asset('image/femaleDefault.png') }}"
                                                        class="shadow-sm img-thumbnail" style="width: 80px; height:80px;">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $u->image) }}"
                                                    class="shadow-sm img-thumbnail" style="width: 80px; height:80px;">
                                            @endif
                                        </td>

                                        <input type="hidden" id="userId" value="{{ $u->id }}">

                                        <td>{{ $u->name }}</td>

                                        <td>{{ $u->email }}</td>

                                        <td>{{ $u->gender }}</td>

                                        <td>{{ $u->phone }}</td>

                                        <td>{{ $u->address }}</td>

                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('user#changeRole', $u->id) }}">
                                                    <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                        title="Edit"><i class="fa-solid fa-user-minus"></i>
                                                    </button>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

