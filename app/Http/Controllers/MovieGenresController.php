<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Carbon\Carbon;
use App\Models\MovieGenres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieGenresController extends Controller
{
    public function list()
    {
        $generes = MovieGenres::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $generes->appends(request()->all());
        return view('admin.movieGenres.list', compact('generes'));
    }

    // Create
    public function add(Request $req)
    {
        $this->genereValidation($req);
        $data = $this->requestGenereData($req);
        MovieGenres::create($data);
        return back()->with(['createSuccess' => 'Created success...']);
    }

    // Delete
    public function delete($id){
        MovieGenres::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'delete success...']);
    }
    // Edit
    public function edit($id){
       $genere = MovieGenres::where('id',$id)->first();
        return view('admin.movieGenres.edit',compact('genere'));
    }
    // Update
    public function update(Request $req){
        $this->genereValidation($req);
        $data = $this->requestGenereData($req);
        MovieGenres::where('id',$req->genereId)->update($data);
        return redirect()->route('movieGeneres#list')->with(['updateSuccess' => 'update success...']);
    }

    // Validation
    private function genereValidation($req)
    {
        Validator::make(
            $req->all(),
            [
                'generesName' => 'required|unique:movie_genres,name,'.$req->genereId,
            ]
        )->validate();
    }

    private function requestGenereData($req)
    {
        return [
            'name' => $req->generesName,
            'updated_at' => Carbon::now()
        ];
    }
}
