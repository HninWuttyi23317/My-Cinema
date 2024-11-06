<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingList;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingController extends Controller
{
    public function bookingList()
    {
        $booking = Booking::select(
            'bookings.*',
            'movies.movie_title as movie',
            'theaters.name as theater',
            'users.name as user',
            // 'users.email as user_mail',
            'show_times.show_time as showtime'
        )
            ->leftJoin('users', 'bookings.user_id', 'users.id')
            ->leftJoin('movies', 'bookings.movie_id', 'movies.id')
            ->leftJoin('theaters', 'bookings.theater_id', 'theaters.id')
            ->leftJoin('show_times', 'bookings.showtime_id', 'show_times.id')
            ->orderBy('bookings.id', 'desc')
            ->get();
        return view('admin.booking.bookingList', compact('booking'));
    }

    //  Search Accept or reject or pending
    public function searchStatus(Request $request)
    {
        // dd($request->all());
        $booking = Booking::select('bookings.*', 'users.name as user', 'users.email as user_mail')
            ->leftJoin('users', 'bookings.user_id', 'users.id')
            ->orderBy('bookings.id', 'asc')
            ->get();
        if ($request->bStatus == null) {
            $booking = Booking::select('bookings.*', 'users.name as user', 'users.email as user_mail')
                ->leftJoin('users', 'bookings.user_id', 'users.id')
                ->orderBy('bookings.created_at', 'asc')->get();
        } else {
            $booking = Booking::select('bookings.*', 'users.name as user', 'users.email as user_mail')
                ->leftJoin('users', 'bookings.user_id', 'users.id')
                ->orderBy('bookings.created_at', 'asc')->where('status', $request->bStatus)->get();
        }

        return view('admin.booking.bookingList', compact('booking'));
    }

    //Change Accept or reject or pending
    public function changeStatus(Request $request)
    {
        // logger($request->all());
        Booking::where('id', $request->bookingId)->update([
            'status' => $request->status
        ]);
    }

    public function codeView($code)
    {
        $booking = Booking::where('booking_code', $code)->first();

        $bookingLists = BookingList::select( 'booking_lists.*',
            'movies.movie_title as movie', 'movies.image as movie_image',
            'users.name as user_name','users.email as user_mail',
            'theaters.name as theater',
            'show_times.show_time as showtime', 'show_times.id as show_id')
            ->leftJoin('movies', 'booking_lists.movie_id', 'movies.id')
            ->leftJoin('theaters', 'booking_lists.theater_id', 'theaters.id')
            ->leftJoin('show_times', 'booking_lists.showtime_id', 'show_times.id')
            ->leftJoin('users', 'booking_lists.user_id', 'users.id')
            ->where('booking_lists.booking_code', $code)
            ->get();
            // dd($bookingLists->toArray());
        return view('admin.code.codeView', compact('bookingLists' , 'booking'));
    }
}
