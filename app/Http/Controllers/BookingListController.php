<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Booking;
use App\Models\BookingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingListController extends Controller
{
    // user#codeView
    public function codeView($codeView)
    {
        $list = BookingList::select('booking_lists.*',
            'movies.movie_title as movie',
            'theaters.name as theater',
            'show_times.show_time as showtime' )
            ->leftJoin('movies', 'booking_lists.movie_id', 'movies.id')
            ->leftJoin('theaters', 'booking_lists.theater_id', 'theaters.id')
            ->leftJoin('show_times', 'booking_lists.showtime_id', 'show_times.id')
            ->where('booking_lists.booking_code', $codeView)
            ->get();

        $ticket = Cart::where('user_id', Auth::user()->id)->get();

        $booking = Booking::where('booking_code', $codeView)->get();

        $user = User::where('id', Auth::user()->id)->first();

        return view('user.home.codeView', compact('list', 'ticket', 'booking', 'user'));
    }
}
