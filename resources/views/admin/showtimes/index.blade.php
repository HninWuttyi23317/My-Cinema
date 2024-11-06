@extends('admin.layouts.main')
@section('title', 'Schedules')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content bg-primary-subtle">
        <div class="row">
            @if (session('changeSuccess'))
                <div class="col-6 offset-5">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-cloud-arrow-down me-2"></i>{{ session('changeSuccess') }}
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
                                <h2 class="title-1 text-white">Schedules</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href=" {{route('showtimes#create')}} ">
                                <button class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                    <i class="fa-solid fa-plus"></i>Add Schedules
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
                        <h6 class="text-white"> Search Key : <span class="text-danger"> {{request('key')}}</span> </h6>
                     </div>
                     <div class="col-4 offset-4">
                         <form action="{{route('showtimes#index')}}" method="GET">
                             @csrf
                             <div class="d-flex">
                                 <input type="text" class="form-control" name="key" placeholder="Search..." value="{{request('key')}}"></input>
                                 <button class="btn bg-dark text-white" type="submit" >
                                     <i class="fa-solid fa-magnifying-glass"></i>
                                 </button>
                             </div>
                         </form>
                     </div>
                </div>
                    {{-- total --}}
                    <div class="row pb-3">
                    <div class="col-3">
                        <h5 class="text-white"><i class="fa-solid fa-database"></i> {{$schedules->total()}}</h5>
                    </div>
                </div>

                    @if (count($schedules) != 0)

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th class=" border 1px solid">Id</th>
                                        <th class=" border 1px solid">Movie_Name</th>
                                        <th class=" border 1px solid">Theater_Name</th>
                                        <th class=" border 1px solid">Show_time</th>
                                        <th class=" border 1px solid"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($schedules as $schedule)
                                        <tr class="tr-shadow">

                                            <td class=" border 1px solid">{{$schedule->id}}</td>

                                            <td class=" border 1px solid">{{$schedule->movie_name}}</td>

                                            <td class=" border 1px solid">{{$schedule->theater_name}}</td>

                                            <td class=" border 1px solid">{{\Carbon\Carbon::parse($schedule->show_time)->format('j-M-Y | g:i a')}}</td>
                                            {{-- <td>{{$schedule->show_time}}</td> --}}

                                            {{-- <td>{{$schedule->created_at->format("M j")}}</td> --}}

                                            <td class="border 1px solid">
                                                <div class="table-data-feature justify-content-center me-2">

                                                    <a href="{{route('showtimes#edit',$schedule->id)}}" class="me-3">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{route('showtimes#delete',$schedule->id)}}">
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
                                {{ $schedules->links() }}
                            </div>
                        </div>
                    @else
                        <h2 class="text-secondary text-center mt-4">No schedules</h2>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
