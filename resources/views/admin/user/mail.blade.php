@extends('admin.layouts.main')
@section('title', 'User_Mail')
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

                    {{-- search --}}
                    {{-- <div class="row py-3">
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
                    {{-- <div class="row pb-3">
                        <div class="col-3">
                            <h5 class="text-secondary"><i class="fa-solid fa-database"></i> {{ $users->total() }}</h5>
                        </div>
                    </div>  --}}

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Posted_Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mails as $m)
                                <tr class="tr-shadow">
                                    <td>{{$m->id}}</td>
                                    <td>{{ $m->name }}</td>

                                    <td>{{ $m->email }}</td>

                                    <td>{{ $m->message }}</td>

                                    <td>{{ $m->created_at->format('j-M-Y') }}</td>

                                    {{-- <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('user#changeRole', $m->id) }}">
                                                <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                    title="Edit"><i class="fa-solid fa-user-minus"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

