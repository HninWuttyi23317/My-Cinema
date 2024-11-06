<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Seat;
use App\Models\User;
use App\Models\Movie;
use App\Models\Booking;
use App\Models\ShowTimes;
use App\Models\MovieGenres;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\UpcomingMovie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        $movie = Movie::orderBy('created_at', 'asc')->get();
        $genre = MovieGenres::get();
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.home.home', compact('movie', 'genre', 'ticket', 'booking', 'user'));
    }

    // UserList
    public function userList()
    {
        $users = User::when(request('key'), function ($query) {
            $query->orwhere('users.name', 'like', '%' . request('key') . '%')
                ->orWhere('users.email', 'like', '%' . request('key') . '%');
        })
            ->where('role', 'user')
            ->paginate(5);
        return view('admin.user.list', compact('users'));
    }

    // userChangeRole
    public function changeRole($id){
        $account = User::where('id', $id)->first();
        return view('admin.user.changeRole', compact('account'));
    }
    public function changing($id, Request $request){
        $data = $this->requestUserData($request);
        User::where('id', $id)->update($data);
        return redirect()->route('user#list');
    }
    // UserMail
    public function mailList(){
        $mails = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.user.mail', compact('mails'));
    }

    // Movie_Details
    public function detail($id){
        $movies = Movie::select('movies.*', 'movie_genres.name as genre_name')
            ->leftJoin('movie_genres', 'movies.genre_id', 'movie_genres.id')
            ->where('movies.id', $id)->first();
        $showTime = ShowTimes::where('movie_id', $id)->get();
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.home.detail', compact('movies', 'showTime', 'ticket', 'booking', 'user'));
    }

    // Movie_Trailers
    public function trailer($id){
        $trailer = Movie::where('movies.id', $id)->first();
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.home.trailer', compact('trailer', 'ticket', 'booking', 'user'));
    }

    // ShowTime
    public function showTime($id)
    {
        $schedule = ShowTimes::select('show_times.*', 'movies.movie_title as movie_name', 'movies.cast as actor', 'theaters.name as theater_name')
            ->leftJoin('movies', 'show_times.movie_id', 'movies.id')
            ->leftJoin('theaters', 'show_times.theater_id', 'theaters.id')
            ->where('show_times.id', $id)->first();
        // $seats = Seat::get();
        $seats = Seat::where('showtime_id', $id)->get();
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.seats.show', compact('schedule', 'seats', 'ticket', 'booking', 'user'));
    }
    // cartList
    public function ticketList()
    {
        $ticketList = Cart::select(
            'carts.*',
            'movies.movie_title as movie',
            'movies.image as poster',
            'theaters.name as theater',
            'show_times.show_time as showtime'
        )
            ->leftJoin('movies', 'movies.id', 'carts.movie_id')
            ->leftJoin('theaters', 'theaters.id', 'carts.theater_id')
            ->leftJoin('show_times', 'show_times.id', 'carts.showtime_id')
            ->where('user_id', Auth::user()->id)
            ->get();
        $totalPrice = 0;
        foreach ($ticketList as $ticket) {
            $totalPrice += $ticket->seat_price;
        }
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.seats.ticket', compact('ticketList', 'totalPrice', 'ticket', 'booking', 'user'));
    }

    // History
    public function history()
    {
        $booking = Booking::select('bookings.*', 'movies.movie_title as movie_name')
            ->leftJoin('movies', 'bookings.movie_id', 'movies.id')
            ->where('bookings.user_id', Auth::user()->id)
            ->get();
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        // $booking = Booking::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.seats.history', compact('booking', 'ticket', 'booking', 'user'));
    }
    // Now&Up
    public function movie()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $movie = Movie::orderBy('created_at', 'asc')->get();
        $upmovie = UpcomingMovie::orderBy('created_at', 'desc')->get();
        $genre = MovieGenres::get();
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        return view('user.home.movie', compact('user', 'movie', 'upmovie', 'genre', 'ticket', 'booking'));
    }

    // changePassword
    public function changePassword(){
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.account.pwChange',compact('ticket','booking','user'));
    }

    // Changing Password
    public function change(Request $request)
    {

        $this->passwordValidation($request);

        $currentUserId = Auth::user()->id;

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password; //hash vale

        if (Hash::check($request->oldPassword, $dbHashValue)) {
            $data =  ['password' => Hash::make($request->newPassword)];

            User::where('id', Auth::user()->id)->update($data);

            return back()->with(['changeSuccess' => 'Password Changed Success...']);
        }
        return back()->with(['notMatch' => 'The Old Password not Match.Try Again!']);
    }

    public function profile(){
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.account.details',compact('ticket','booking','user'));
    }

    // Change Profile
    public function changeProfile(){
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.account.accountUpdate',compact('ticket','booking','user'));
    }
    // Update Profie
    public function update($id, Request $request)
    {
        $this->accountValidation($request);
        $data = $this->getUserData($request);

        //  for image

        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            // dd($dbImage);

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            // dd($fileName);
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return back()->with(['updateSuccess' => 'User account updated...']);
    }

    // Password Validation
    private function passwordValidation($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }

    // accountValidation
    private function accountValidation($request)
    {
        Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'image' => 'image|mimes:png,jpg,jpeg,svg,gif,webp|file|max:2048',
                'gender' => 'required',
                'address' => 'required'
            ]
        )->validate();
    }
    // request user data
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }
    // requestUserData
    private function requestUserData($request)
    {
        return [
            'role' => $request->role
        ];
    }
}
