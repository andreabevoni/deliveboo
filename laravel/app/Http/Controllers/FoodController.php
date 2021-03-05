<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    // index
    public function index()
    {

        if (Auth::user()) {

            $foods = Auth::user()->food;
            // dd($foods)

            return view('foods-page', compact('foods'));
        } else {
            // dd('No logged user');
            return redirect()->route('home');
        }
    }

    // create
    public function create()
    {
        $foods = Food::all();
        return view('food-create', compact('foods'));
    }

    // store
    public function store(Request $request)
    {

        // dd($request -> all());

        $validatedData = $request->validate([
            'name' => 'required|min:3|max:50',
            'price' => 'required|min:1',
            'description' => 'min:5',
            'visible' => 'required', 'integer',
            'category' => 'required'
        ]);

        // $data = $request->all();
        $user = Auth::user();

        $food = Food::make($validatedData);

        $food->user()->associate($user);

        $food->save();
        // dd($food->visible);

        return redirect()->route('food.index');
    }

    public function edit($id)
    {
        $foods = Food::all();
        $food = Food::findOrFail($id);
        // dd($food);


        return view('food-edit', compact('food', 'foods'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:50',
            'price' => 'required|min:1',
            'description' => 'min:5',
            'visible' => 'required',
            'category' => 'required'
        ]);


        $food = Food::findOrFail($id);


        $food->update($validatedData);
        // dd($food);


        return redirect()->route('food.index');
    }

    public function destroy($id)
    {

        Food::destroy($id);

        return redirect()->route('food.index');
    }

    public function goToRestore()
    {
        if (Auth::user()) {

            $userAuth = Auth::user();

            $id = $userAuth->id;

            $deletedFood = DB::table('food')

                ->whereNotNull('deleted_at')

                ->where(function ($query) use ($id) {
                    $query->where('user_id', '=', $id);
                })
                ->get();

            // dd($deletedFood);
            return view('pages.food-restore', compact('deletedFood'));
        } else {
            // dd('No logged user');
            return redirect()->route('home');
        }
    }

    public function restore(Request $request)
    {
        $data = $request->all();
        $id = $data['name'];
        // dd($id);

        Food::where('id', $id)->restore();
        return redirect()->route('food.index');
    }


    /* public function uploadFood(Request $request)
    { */
    //prima mi creo la cartella del singolo food

    /* if (!File::exists(public_path() . "storage/app/public/")) {
            File::makeDirectory(public_path() . "storage/app/public/");
        } */
    // dd($folder);

    //validation che sia file e ci sia
    /*  $request->validate([
            'icon' => 'required|file'
        ]); */


    //devo chiamare la funzione che elimina l img
    /* $this->deleteImg(); */

    //validation che sia un file e che ci sia


    /* $image = $request->file('icon');

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

        // dd($user); */

    /* return redirect()->back(); */
    //}
    /*     public function clearImg()
    {
        $this->deleteImg();
        $user = Auth::user();
        $user->image = null;
        $user->save();

        return redirect()->back();
    } */

    /* public function deleteImg()
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
    } */
}
