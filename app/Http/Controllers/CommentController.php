<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Booking;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
     // Movie_Comments
     public function comment(){
        $comments = Comment::select('comments.*','users.name as user_name')
                            ->leftJoin('users','comments.user_id','users.id')
                            ->orderBy('created_at','desc')
                            ->paginate(4);
        $comments->appends(request()->all());
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.home.comment',compact('comments','ticket', 'booking', 'user'));
    }
    public function post(Request $request){
    //    dd($request->all());
    $data = [
        'user_id' => $request->userId ,
        'description' => $request->postDescription,
        'address' => $request->userAddress
    ];

    $validationRules = [
        'postDescription'=>'required'
    ];

    Validator::make($request->all() , $validationRules)->validate();
    // dd($data);
    Comment::create($data);
    return back()->with(['insertSuccess'=>'မှတ်ချက်ပေးခြင်းအောင်မြင်ပါသည်']);
    }

    // post delete
    public function delete($id) {
        // first way
        Comment::where('id' , $id)->delete();
        return back()->with(['deleteSuccess'=>'သင့်မှတ်ချက်ကိုဖျက်ပြီးပါပြီ']);
        // return redirect()->route('post#createPage');
    }
    // Edit page
    public function edit($id) {
        $comment = Comment::where('id',$id)->first();
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.home.cmtEdit',compact('comment','ticket', 'booking', 'user'));
    }
    // rewrite update post
    public function update(Request $request) {
        $data = [
            'description' => $request->postDescription,
        ];
        $id = $request->cmtId;
        // dd($data);
        Comment::where('id',$id)->update($data);
        return redirect()->route('user#comments')->with(['updateSuccess'=>'Updateလုပ်ခြင်းအောင်မြင်ပါသည်']);
     }
    //  View
    public function view($id){
        $comment = Comment::select('comments.*','users.name as user_name')
                         ->leftJoin('users','comments.user_id','users.id')
                         ->where('comments.id',$id)->first();
        $ticket = Cart::where('user_id', Auth::user()->id)->get();
        $booking = Booking::where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.home.cmtView',compact('comment','ticket', 'booking', 'user'));
    }
}
