@extends('admin.layouts.main')

@section('content')
    <h1>Seats</h1>
    <a href="{{ route('seats#create') }}" class="btn btn-primary">Add Seat</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Theater</th>
                <th>Seat Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($seats as $seat)
                <tr>
                    <td>{{ $seat->id }}</td>
                    <td>{{ $seat->theater->name }}</td>
                    <td>{{ $seat->seat_number }}</td>
                    <td>
                        <a href="#" class="btn btn-warning">Edit</a>
                        {{-- <form action="{{ route('admin.seats.destroy', $seat->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
