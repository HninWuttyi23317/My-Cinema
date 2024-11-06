<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Seat;
use App\Models\ShowTimes;
use App\Models\Theaters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeatController extends Controller
{
    public function List()
    {
        $seat = Seat::select('seats.*','theaters.name as theater')
                    ->when(request('key'), function ($query) {
                    $query->orwhere('seats.seat_name', 'like', '%' . request('key') . '%')
                          ->orWhere('seats.showtime_id', 'like', '%' . request('key') . '%');
                    })
                    ->leftJoin('theaters','seats.theater_id','theaters.id')
                    ->leftJoin('show_times','seats.showtime_id','show_times.id')
                    ->orderBy('seats.showtime_id', 'desc')
                    ->paginate(10);

        // $seats->appends(request()->all());

        return view('admin.seats.list', compact('seat'));
    }

    // Create
    public function create(){
        $theaters = Theaters::select('id','name')->get();
        $schedule = ShowTimes::select('id','show_time')->get();
        return view('admin.seats.create',compact('schedule','theaters'));
    }
    public function add(Request $req)
    {
        $this->seatValidation($req);
        $data = $this->requestSeatData($req);
        Seat::create($data);
        return redirect()->route('seat#list')->with(['createSuccess' => 'Created success...']);
    }

        // Delete
        public function delete($id){
            Seat::where('id',$id)->delete();
            return back()->with(['deleteSuccess' => 'delete success...']);
        }
        // Edit
        public function edit($id){
           $seats = Seat::where('id',$id)->first();
           $theaters = Theaters::get();
           $schedule = ShowTimes::get();
            return view('admin.seats.edit',compact('seats','theaters','schedule'));
        }
        // Update
        public function update(Request $req){
            $this->seatValidation($req);
            $data = $this->requestSeatData($req);
            Seat::where('id',$req->seatId)->update($data);
            return redirect()->route('seat#list')->with(['updateSuccess' => 'Update success...']);
        }

        // Change
        public function change(Request $req){
            // logger($req->all());
            Seat::where('id',$req->seatId)->update([
                'status' =>$req->status
            ]);
        }

        // Validation
        private function seatValidation($req)
        {
            Validator::make(
                $req->all(),
                [
                    'seatName' => 'required|unique:seats,seat_name,'.$req->seatId,
                    'Sprice' => 'required',
                    'theaters'=>'required',
                    'showtime'=>'required'
                ]
            )->validate();
        }

        private function requestSeatData($req)
        {
            return [
                'seat_name' => $req->seatName,
                'price' => $req->Sprice,
                'theater_id'=>$req->theaters,
                'showtime_id'=>$req->showtime
            ];
        }
}
