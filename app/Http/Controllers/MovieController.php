<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Theaters;
use App\Models\MovieGenres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    //Movie List page..................................................
    public function list()
    {
        $movies = Movie::select('movies.*', 'movie_genres.name as genre_name')
            ->when(request('key'), function ($query) {
                $query->where('movies.movie_title', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('movie_genres', 'movies.genre_id', 'movie_genres.id')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $movies->appends(request()->all());
        return view('admin.movies.movielist', compact('movies'));
    }

    // Movie Create..................................................
    public function create()
    {
        $genres = MovieGenres::select('id', 'name')->get();
        return view('admin.movies.create', compact('genres'));
    }
    public function createMovie(Request $req)
    {
        $this->movieValidate($req, "create");

        $data = $this->requestMovieData($req);

        if ($req->hasFile('moviePoster')) {
            $fileName = uniqid() . $req->file('moviePoster')->getClientOriginalName();
            $req->file('moviePoster')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        if ($req->hasFile('movieTrailer')) {
            $path = uniqid() . $req->file('movieTrailer')->getClientOriginalExtension();
            $req->file('movieTrailer')->storeAs('public', $path);
            // $req->file('movieTrailer')->store('videos', ['disk' =>'my_files']);
            $data['trailer'] = $path;
           }

        Movie::create($data);
        return redirect()->route('movies#list')->with(['createSuccess' => ' Create Success...']);
    }

    // Delete..................................................................
    public function delete($id)
    {
        Movie::where('id', $id)->delete();
        return redirect()->route('movies#list')->with(['deleteSuccess' => ' delete Success...']);
    }

    // Edit....................................................................
    public function edit($id)
    {
        $movie = Movie::where('id', $id)->first();
        $genres = MovieGenres::get();
        return view('admin.movies.edit', compact('movie', 'genres'));
    }
    public function update(Request $req)
    {
        $this->movieValidate($req, "update");
        $data = $this->requestMovieData($req);

        if ($req->hasFile('moviePoster')) {
    // old image name | check(null or exist) => (exist)delete | store(new)
            $oldImgName = Movie::where('id', $req->movieId)->first();
            $oldImgName = $oldImgName->image;
            // dd($oldImgName);
            if ($oldImgName != null) {
                Storage::delete('public/' . $oldImgName);
            }

            $fileName = uniqid() . $req->file('moviePoster')->getClientOriginalName();
            $req->file('moviePoster')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        if ($req->hasFile('movieTrailer')) {
            $oldTrailerName = Movie::where('id', $req->movieId)->first();
            $oldTrailerName = $oldTrailerName->trailer;

            if ($oldTrailerName != null) {
                Storage::delete('public/' . $oldTrailerName);
            }

            $path = uniqid() . $req->file('movieTrailer')->getClientOriginalExtension();
            $req->file('movieTrailer')->storeAs('public', $path);
            $data['trailer'] = $path;
        }

        Movie::where('id', $req->movieId)->update($data);
        return redirect()->route('movies#list')->with(['updateSuccess' => 'Update Success']);
    }

    // View Detail
    public function showDetail($id)
    {
        $movie = Movie::select('movies.*','movie_genres.name as genre_name')
                        ->leftJoin('movie_genres','movies.genre_id','movie_genres.id')
                        ->where('movies.id', $id)->first();
        return  view('admin.movies.movieDetail', compact('movie'));
    }

    // movieValidate...............................................................
    private function movieValidate($req, $action)
    {
        $validationRules = [
            'movieName' => 'required|unique:movies,movie_title,' . $req->movieId,

            'actor' => 'required',
            'movieDirector' => 'required',
            'genre' => 'required',
            'releaseDate' => 'required',
            'movieDuration' => 'required',
            'movieDescription' => 'required'
        ];

        $validationRules['moviePoster'] = $action == "create" ? "required|mimes:png,jpg,webp,svg,gif,jpeg|file" : "mimes:png,jpg,webp,svg,gif,jpeg|file";
        $validationRules['movieTrailer'] = $action == "create" ? "required|mimes:video,mp4,mkv,x-m4v,video/mp4|file" : "mimes:video,mp4,mkv,x-m4v,video/mp4|file";
        Validator::make($req->all(), $validationRules)->validate();
    }

    // Request data......................................................................
    private function requestMovieData($req)
    {
        return [

            'movie_title' => $req->movieName,
            // 'image'=>$req->,
            'duration' => $req->movieDuration,
            'cast' => $req->actor,
            'director' => $req->movieDirector,
            'genre_id' => $req->genre,
            // 'theater_id'=>$req->showTheater,
            'description' => $req->movieDescription,

            'trailer' => $req->movieTrailer,
            'release_date' => $req->releaseDate
        ];
    }
}
