@extends('admin.layouts.main')
@section('title', 'Seat List')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content bg-primary-subtle">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-12">
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
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1 text-white">Seat List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('seat#create') }}">
                                <button class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                    <i class="fa-solid fa-plus"></i>Add Seats
                                </button>
                            </a>
                            {{-- <button class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                CSV download
                            </button> --}}
                        </div>
                    </div>
                   {{-- search --}}
                   <div class="row py-3">
                    <div class="col-4">
                        <h6 class=" text-white"> Search Key : <span class="text-danger"> {{request('key')}}</span> </h6>
                     </div>
                     <div class="col-4 offset-4">
                         <form action="{{route('seat#list')}}" method="GET">
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
                            <h5 class="text-white"><i class="fa-solid fa-database"></i> {{$seat->total()}}</h5>
                        </div>
                    </div>

                    @if (count($seat) != 0)

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Theater</th>
                                    <th>ShowTime</th>
                                    <th>Sratus</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($seat as $s)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="seatId" value="{{ $s->id }}">
                                        <td>{{ $s->id }}</td>

                                        <td>
                                            {{ $s->seat_name }}
                                        </td>

                                        <td>
                                            {{ $s->price }}
                                        </td>
                                        <td>
                                            {{ $s->theater}}
                                        </td>
                                        <td>
                                            {{ $s->showtime_id }}
                                        </td>

                                        <td>
                                            <select name="status" class="form-control statusChange">
                                                <option value="0"
                                                    @if ($s->status == 0) selected @endif>selected</option>
                                                <option value="1"
                                                    @if ($s->status == 1) selected @endif>available</option>
                                            </select>
                                        </td>

                                        <td>
                                            <div class="table-data-feature">

                                                <a href="{{route('seat#edit',$s->id)}}" class="me-3">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>

                                                <a href="{{route('seat#delete',$s->id)}}" class="px-2">
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
                            {{ $seat->links() }}
                        </div>
                    </div>
                @else
                    <h2 class="text-secondary text-center mt-4">There is no seat_map here</h2>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $seatId = $parentNode.find('.seatId').val();
                // console.log($seatId);

                $data = {
                    'status' : $currentStatus ,
                    'seatId' : $seatId
                };

                $.ajax({

                    type: 'get',

                    url: 'http://127.0.0.1:8000/admin/seats/ajax/changeStatus' ,

                    data: $data ,

                    dataType: 'json' ,
                })
                // window.location.href = "http://127.0.0.1:8000/admin/seats/seat";
            })
        })
    </script>
@endsection
