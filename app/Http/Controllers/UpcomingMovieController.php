<?php

namespace App\Http\Controllers;
use App\Models\MovieGenres;
use Illuminate\Http\Request;
use App\Models\UpcomingMovie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UpcomingMovieController extends Controller
{
     //UpcomingMovie List page..................................................
    public function list()
    {
        $movies = UpcomingMovie::select('upcoming_movies.*', 'movie_genres.name as genre_name')

            ->when(request('key'), function ($query) {
                $query->where('upcoming_movies.movie_title', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('movie_genres', 'upcoming_movies.genre_id', 'movie_genres.id')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $movies->appends(request()->all());
        return view('admin.upcoming.movielist', compact('movies'));
    }

    // UpcomingMovie Create..................................................
    public function create()
    {
        $genres = MovieGenres::select('id', 'name')->get();
        return view('admin.upcoming.create', compact('genres'));
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

        UpcomingMovie::create($data);
        return redirect()->route('upmovies#list')->with(['createSuccess' => ' Create Success...']);
    }

    // Delete..................................................................
    public function delete($id)
    {
        UpcomingMovie::where('id', $id)->delete();
        return redirect()->route('upmovies#list')->with(['deleteSuccess' => ' delete Success...']);
    }

    // Edit....................................................................
    public function edit($id)
    {
        $movie = UpcomingMovie::where('id', $id)->first();
        $genres = MovieGenres::get();
        return view('admin.upcoming.edit', compact('movie', 'genres'));
    }
    public function update(Request $req)
    {
        $this->movieValidate($req, "update");
        $data = $this->requestMovieData($req);

        if ($req->hasFile('moviePoster')) {
    // old image name | check(null or exist) => (exist)delete | store(new)
            $oldImgName = UpcomingMovie::where('id', $req->movieId)->first();
            $oldImgName = $oldImgName->image;
            // dd($oldImgName);
            if ($oldImgName != null) {
                Storage::delete('public/' . $oldImgName);
            }

            $fileName = uniqid() . $req->file('moviePoster')->getClientOriginalName();
            $req->file('moviePoster')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        UpcomingMovie::where('id', $req->movieId)->update($data);
        return redirect()->route('upmovies#list')->with(['updateSuccess' => 'Update Success']);
    }

    // movieValidate...............................................................
    private function movieValidate($req, $action)
    {
        $validationRules = [
            'movieName' => 'required|unique:upcoming_movies,movie_title,' . $req->movieId,
            'actor' => 'required',
            'movieDirector' => 'required',
            'genre' => 'required',
        ];

        $validationRules['moviePoster'] = $action == "create" ? "required|mimes:png,jpg,webp,svg,gif,jpeg|file" : "mimes:png,jpg,webp,svg,gif,jpeg|file";
        Validator::make($req->all(), $validationRules)->validate();
    }

    // Request data......................................................................
    private function requestMovieData($req)
    {
        return [
            'movie_title' => $req->movieName,
            'cast' => $req->actor,
            'director' => $req->movieDirector,
            'genre_id' => $req->genre
        ];
    }
}
