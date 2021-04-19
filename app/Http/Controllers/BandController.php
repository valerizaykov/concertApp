<?php

namespace App\Http\Controllers;
use Image;
use App\userBand;
use App\User;
use Illuminate\Http\Request;

class BandController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('bandCreate',['users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'band_name' => 'required|unique:user_bands|max:255',
            'band_photo' => 'required|mimes:jpeg,jpg,png,gif',
        ]);
        if($request->hasFile('band_photo')) {
            //get file extension
            $extension = $request->file('band_photo')->getClientOriginalExtension();

            $bandName = $request->band_name;
            //filename to store
            $filenametostore = $bandName . '_' . time() . '.' . $extension;
            //store the image
            $request->file('band_photo')->storeAs('public/band_photo', $filenametostore);
            $request->file('band_photo')->storeAs('public/band_photo/thumbnail', $filenametostore);
            $thumbnailpath = public_path('storage/band_photo/thumbnail/' . $filenametostore);
            $this->createThumbnail($thumbnailpath, 150, 93);
            //store to db
            $userband = new userBand;
            $userband->band_name = $bandName;
            $userband->band_thumb_url = 'storage/band_photo/thumbnail/'.$filenametostore;
            $userband->user_id = $request->user;
            $userband->save();
            return redirect('/events/create');
        }
    }
    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

}
