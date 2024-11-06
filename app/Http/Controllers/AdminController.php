<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Seat;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // Dashboard
    public function adminHome()
    {
        $user = User::where('role','user')->get();
        $booking = Booking::where('status',1)->get(); //1 = Accept
        $seat = Seat::get();
        $normal = Seat::where('price', 3000)->where('status', 0)->get(); //0 = sold
        $upper = Seat::where('price', 4000)->where('status', 0)->get();
        $five = Seat::where('price', 5000)->where('status', 0)->get();

        $normalAva = Seat::where('price', 3000)->where('status', 1)->get(); //1 = available
        $upperAva = Seat::where('price', 4000)->where('status', 1)->get();
        $fiveAva = Seat::where('price', 5000)->where('status', 1)->get();

        return view('admin.layouts.adminDashboard', compact('user','booking','seat','normal','upper','five', 'normalAva','upperAva','fiveAva'));
    }
    //Admin Account PassswordChange
    public function changePassword()
    {
        return view('admin.account.changePw');
    }

    // Changing Password
    public function changing(Request $request)
    {
        $this->passwordValidation($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password; //hash vale
        if (Hash::check($request->oldPassword, $dbHashValue)) {
            $data =  ['password' => Hash::make($request->newPassword)];
            User::where('id', Auth::user()->id)->update($data);
            return redirect()->route('admin#profile')->with(['changeSuccess' => 'Password Changed Success...']);
        }
        return back()->with(['notMatch' => 'The old password not match.Try Again!']);
    }

    // Profile
    public function profile()
    {
        return view('admin.account.details');
    }
    // edit
    public function editProfile()
    {
        return view('admin.account.edit');
    }
    // updade
    public function updateProfile($id, Request $request)
    {
        $this->accountValidation($request);
        $data = $this->getUserData($request);
        //  for image
        if ($request->hasFile('image')) {

            // php artisan storage:link
            // old image name | check(null or exist) => (exist)delete | store(new)

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
        return redirect()->route('admin#profile')->with(['updateSuccess' => 'Admin account updated...']);
    }

    // Admin List
    public function list()
    {

        $admin = User::when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%')
                ->orWhere('phone', 'like', '%' . request('key') . '%')
                ->orWhere('address', 'like', '%' . request('key') . '%')
                ->orWhere('gender', 'like', '%' . request('key') . '%');
        })
            ->where('role', 'admin')->paginate(3);
        return view('admin.account.list', compact('admin'));
    }
    // Admin delete
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Admin account was deleted...']);
    }

    // Change Role
    public function changeRole($id)
    {
        $account = User::where('id', $id)->first();
        return view('admin.account.changeRole', compact('account'));
    }
    public function change($id, Request $request)
    {
        $data = $this->requestUserData($request);
        User::where('id', $id)->update($data);
        return redirect()->route('admin#list');
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
