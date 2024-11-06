<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Booking;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function toContact()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        return view('user.layouts.master', compact('user', 'ticket', 'booking'));
    }
    public function contact(Request $request)
    {
        $data = $this->getUserData($request);
        Contact::create($data);
        return redirect()->route('user#home');
    }

    //contactForm
    public function contactForm()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        return view('user.contact.contact',compact('user', 'ticket', 'booking'));
    }
    public function contacting(Request $request)
    {
        // dd($request->all());
        $this->contactValidate($request);
        $data = $this->getUserData($request);
        Contact::create($data);
        return back()->with(['sentSuccess' => 'You sent your message...']);
    }

    private function contactValidate($request)
    {
        Validator::make($request->all(), [
            'userName' => 'required',
            'userMail' => 'required',
            'message' => 'required'
        ])->validate();
    }

    // request user data
    private function getUserData($request)
    {
        return [
            'name' => $request->userName,
            'email' => $request->userMail,
            'message' => $request->message
        ];
    }
}
