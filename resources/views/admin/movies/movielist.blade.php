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
                                <h3 class=" text-white">NowShowing_Movie List</h3>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('movies#create') }}">
                                <button class="au-btn au-btn-icon au-btn--green bg-success au-btn--small">
                                    <i class="fa-solid fa-plus"></i>Now Showing Movies
                                </button>
                            </a>
                            <a href="{{ route('upmovies#list') }}">
                                <button class="au-btn au-btn-icon bg-light fw-bold au-btn--small text-danger">
                                    Go to Upcoming_Movies
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
                            <h6 class="text-white"> Search Key : <span class="text-danger"> {{ request('key') }}</span> </h6>
                        </div>
                        <div class="col-4 offset-4">
                            <form action="{{ route('movies#list') }}" method="GET">
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
                                    <th>Duration</th>
                                    <th>Movie_Genere</th>
                                    <th>Released_Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($movies as $movie)
                                <tr class="tr-shadow">

                                    <td><img src="{{ asset('storage/' . $movie->image) }}" class="shadow-sm img-thumbnail" >
                                    </td>

                                    <td>{{$movie->movie_title}}</td>

                                    <td class="col-2">{{$movie->cast}}</td>

                                    <td>{{$movie->duration}}</td>


                                    <td>{{$movie->genre_name}}</td>

                                    <td>{{\Carbon\Carbon::parse($movie->release_date)->format('M-Y')}}</td>

                                    <td>
                                        <div class="table-data-feature">

                                            <a href="{{route('movies#show',$movie->id)}}" class="me-3">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="View Details">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </a>

                                            <a href="{{route('movies#edit',$movie->id)}}" class="me-3">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </a>

                                            <a href="{{route('movies#delete',$movie->id)}}" class="me-2">
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
