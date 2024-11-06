@extends('admin.layouts.main')
@section('title', 'Movie List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content bg-primary-subtle">
        <div class="row">
            @if (session('updateSuccess'))
                <div class="col-6 offset-5">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-cloud-arrow-down me-2"></i>{{ session('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h3 class=" text-white">Upcoming_Movie List</h3>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('upmovies#create') }}">
                                <button class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                    <i class="fa-solid fa-plus"></i>Add Upcoming_Movies
                                </button>
                            </a>
                            <a href="{{route('movies#list')}}">
                                <button class="au-btn au-btn-icon text-danger fw-bold bg-light au-btn--small">
                                    Go to NowShowing_Movie
                                </button>
                            </a>
                        </div>
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

                    {{-- search --}}
                    <div class="row py-3">
                        <div class="col-4">
                            <h6 class="text-secondary"> Search Key : <span class="text-white"> {{ request('key') }}</span> </h6>
                        </div>
                        <div class="col-4 offset-4">
                            <form action="{{ route('upmovies#list') }}" method="GET">
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
                            <h5 class="text-white"><i class="fa-solid fa-database"></i> {{ $movies->total() }}</h5>
                        </div>
                    </div>

                    @if (count($movies) != 0)

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Poster</th>
                                    <th>Movie_Name</th>
                                    <th>Cast</th>
                                    <th>Movie_Genere</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($movies as $movie)
                                <tr class="tr-shadow">

                                    <td class="col-2"><img src="{{ asset('storage/' . $movie->image) }}" class="shadow-sm img-thumbnail" style="height: 120px; width:120px">
                                    </td>

                                    <td>{{$movie->movie_title}}</td>

                                    <td>{{$movie->cast}}</td>

                                    <td>{{$movie->genre_name}}</td>

                                    <td class="col-2">
                                        <div class="table-data-feature">
                                            <a href="{{route('upmovies#edit',$movie->id)}}" class="me-3">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </a>

                                            <a href="{{route('upmovies#delete',$movie->id)}}" class="me-2">
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
                                {{ $movies->links() }}
                            </div>
                    </div>
                    @else
                        <h2 class="text-secondary text-center mt-4">There is no movie here</h2>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
