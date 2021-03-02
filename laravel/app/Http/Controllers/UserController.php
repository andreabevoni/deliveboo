<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function uploadAvatar(Request $request)
    {

        //validation che sia file e ci sia
        $request->validate([
            'icon' => 'required|file'
        ]);


        //devo chiamare la funzione che elimina l img
        $this->deleteImg();

        //validation che sia un file e che ci sia


        $image = $request->file('icon');

        //salvo ext file
        $ext = $image->getClientOriginalExtension();

        //creo nome img sempre diverso
        $name = rand(100000, 999999) . '_' . time();

        //creo destination file
        $destFile = $name . '.' . $ext;

        //copio file all upload
        $file = $image->storeAs('icon', $destFile, 'public');

        //prendo l user loggato
        $user = Auth::user();

        $user->image = $destFile;

        $user->save();

        // dd($user);

        return redirect()->back();
    }

    public function indexUser() {
    $users = User::all();
    return view('pages.indexUser', compact('users'));
    }


    public function showUser($id) {
    $user = User::findOrFail($id);
    return view('pages.showUser', compact('user'));
  }



    public function clearImg()
    {
        $this->deleteImg();
        $user = Auth::user();
        $user->image = null;
        $user->save();

        return redirect()->back();
    }

    public function deleteImg()
    {
        $user =  Auth::user();

        try {
            $fileName = $user->image;

            $file = storage_path('app/public/icon/' . $fileName);
            File::delete($file);
            // dd($fileName);
            return redirect()->back();
        } catch (\Exception $e) {
        }
    }
}
