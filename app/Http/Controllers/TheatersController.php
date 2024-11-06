<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Theaters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TheatersController extends Controller
{
    // Theatres list page
    public function Tlist()
    {
        // $theaters = Theaters::orderBy('id','desc')->get();
        // $theaters = Theaters::orderBy('created_at', 'desc')->paginate(3);

        $theaters = Theaters::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $theaters->appends(request()->all());
        return view('admin.theaters.Tlist', compact('theaters'));
    }
    // createForm
    public function create()
    {
        return view('admin.theaters.create');
    }
    // Creating
    public function createTheater(Request $request)
    {
        $this->theaterValidation($request, "create");
        $data = $this->requestTheaterData($request);

        if ($request->hasFile('TImage')) {
            $fileName = uniqid() . $request->file('TImage')->getClientOriginalName();
            $request->file('TImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        Theaters::create($data);
        return redirect()->route('theaters#list')->with(['createSuccess' => 'Theater created success...']);
    }
    // Delete
    public function delete($id)
    {
        Theaters::where('id', $id)->delete();
        return redirect()->route('theaters#list')->with(['deleteSuccess' => 'Theater delete Success...']);
    }

    // Editing
    public function edit($id){
        $theater = Theaters::where('id',$id)->first();
        return view('admin.theaters.edit',compact('theater'));
    }
    // Update
    public function update(Request $request){
        $this->theaterValidation($request, "update");
        $data = $this->requestTheaterData($request);

        if($request->hasFile('TImage')) {
            $oldImgName = Theaters::where('id',$request->theaterId)->first();
            $oldImgName = $oldImgName->image;
            // dd($oldImgName);

            if($oldImgName != null){
                Storage::delete('public/'.$oldImgName);
            }

            $fileName = uniqid() . $request->file('TImage')->getClientOriginalName();
            $request->file('TImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        Theaters::where('id',$request->theaterId)->update($data);
        return redirect()->route('theaters#list')->with(['updateSuccess' => 'Theater updated Success...']);
    }

    // Validation check
    private function theaterValidation($request, $action)
    {
        $validationRules = [
            'TName' => 'required | unique:theaters,name,'.$request->theaterId,
            // 'TImage' => 'required|image|mimes:png,jpg,jpeg,svg,webp,gif|file',
            'location' => 'required'
        ];
        $validationRules['TImage'] = $action == "create" ? "required|mimes:png,jpg,webp,svg,gif,jpeg|file" : "mimes:png,jpg,webp,svg,gif,jpeg|file";
        Validator::make($request->all(), $validationRules)->validate();
    }

    // Request data | arrange in array
    private function requestTheaterData($request)
    {
        // name in db | form request name
        return [
            'name' => $request->TName,
            'location' => $request->location,
            'updated_at'=>Carbon::now()
        ];
    }
}
