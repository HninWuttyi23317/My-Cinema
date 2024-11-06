@extends('layouts.master')

@section('content')
    <h1>Showtime: {{ $showtime->movie->title }} at {{ $showtime->show_time }}</h1>
    <h2>Theater: {{ $showtime->theater->name }}</h2>

    <form action="{{ route('book-seat') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">

        <table class="table">
            <thead>
                <tr>
                    <th>Seat Number</th>
                    <th>Available</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seats as $seat)
                    <tr>
                        <td>{{ $seat->seat_number }}</td>
                        <td>{{ $seat->bookings->contains('showtime_id', $showtime->id) ? 'No' : 'Yes' }}</td>
                        <td>
                            @if (!$seat->bookings->contains('showtime_id', $showtime->id))
                                <input type="radio" name="seat_id" value="{{ $seat->id }}" required>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Book Seat</button>
    </form>
@endsection
