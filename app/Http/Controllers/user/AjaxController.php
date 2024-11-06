<?php

namespace App\Http\Controllers\user;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Booking;
use App\Models\BookingList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //add to cart
    public function addToCart(Request $request){
        // logger($request->all());
        $data = $this->getOrderData($request);

        Cart::create($data);
        $response = [
            'message' => 'Add To Cart Complete',
            'status' => 'success'
        ];
        return response()->json($response,200);
    }

    // Remove Current Booking
    public function remove(Request $request){
        // logger($request->all());
        Cart::where('user_id',Auth::user()->id)
              ->where('movie_id',$request->movieId)
              ->where('theater_id',$request->theaterId)
              ->where('showtime_id',$request->showtimeId)
              ->where('seat_price',$request->total)
              ->delete();
    }

     // BookingList............................................................
     public function bookingList(Request $request){
        $total = 0;
        // logger($request->all());
        foreach($request->all() as $item){

          $data =  BookingList::create ([
                'user_id' => $item['user_id'],
                'movie_id' => $item['movie_id'],
                'theater_id' => $item['theater_id'],
                'showtime_id' => $item['showtime_id'],
                'seat_name' => $item['seat_name'],
                'total_price' => $item['total_price'],
                'booking_code' => $item['booking_code'],
            ]);

            $total += $data->total_price;
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Booking::create([
            'user_id' => Auth::user()->id,
            'movie_id' => $data->movie_id,
            'theater_id' => $data->theater_id,
            'showtime_id' => $data->showtime_id,
            'seat_name' => $data->seat_name,
            'booking_code' => $data->booking_code,
            'total_price' => $total
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order complete'
        ],200);
    }

    // get order data.........................................................
    private function getOrderData($request){
        //Db name | re$request->name
        return [
                'user_id' => $request->userId,
                'movie_id' => $request->movieId,
                'theater_id' => $request->theaterId,
                'showtime_id' => $request->showtimeId,
                'seat_price' => $request->totalPrice,
                'seat_name' => $request->seatNames,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
}
