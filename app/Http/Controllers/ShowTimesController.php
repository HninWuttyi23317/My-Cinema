<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\ShowTimes;
use App\Models\Theaters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShowTimesController extends Controller
{
    public function index()
    {

        $schedules = ShowTimes::select('show_times.*','theaters.name as theater_name','movies.movie_title as movie_name')
                                ->when(request('key'), function ($query) {
                                   $query->where('movie_id', 'like', '%' . request('key') . '%'); })
                                ->leftJoin('theaters','show_times.theater_id','theaters.id')
                                ->leftJoin('movies','show_times.movie_id','movies.id')
                                ->orderBy('show_times.show_time', 'asc')
                                ->paginate(10);

        $schedules->appends(request()->all());

        return view('admin.showtimes.index', compact('schedules'));
    }

    // Create...............................
    public function create(){
        $theaters = Theaters::select('id','name')->get();
        $movies = Movie::select('id','movie_title')->get();
        return view('admin.showtimes.create',compact('movies','theaters'));
    }
    public function creating(Request $req){
        $this->scheduleValidation($req);
        $data = $this->requestScheduleData($req);
        ShowTimes::create($data);
        return redirect()->route('showtimes#index')->with(['createSuccess' => 'Created success...']);
    }
    // Delete.....................................
    public function delete($id){
        ShowTimes::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete Success']);
    }
    // Edit..................................
    public function edit($id){
        $schedules = ShowTimes::where('id',$id)->first();
        $theaters = Theaters::get();
        $movies = Movie::get();
        return view('admin.showtimes.edit',compact('schedules','movies','theaters'));
    }
    public function update(Request $req){
        $this->scheduleValidation($req);
        $data = $this->requestScheduleData($req);
        ShowTimes::where('id',$req->scheduleId)->update($data);
        return redirect()->route('showtimes#index')->with(['updateSuccess' => 'Update Success']);
    }

    //scheduleValidation .................................
    private function scheduleValidation($req){
        Validator::make(
        $req->all(),[
        'movies'=> 'required',
        'theaters'=>'required',
        'showtime'=>'required'
        ])->validate();
    }

    // requestScheduleData..................................
    private function requestScheduleData($req){
          return [
              'movie_id'=>$req->movies,
              'theater_id'=>$req->theaters,
              'show_time'=>$req->showtime
          ];
    }
}
