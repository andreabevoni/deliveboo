<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class FoodController extends Controller
{
    // index
    public function index()
    {

        if (Auth::user()) {

            $foods = Auth::user()->food;

            return view('foods-page', compact('foods'));
        } else {

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

        $request->validate([
            'name' => 'required|min:3|max:50',
            'price' => 'required|min:1',
            'description' => 'min:5',
            'visible' => 'required', 'integer',
            'category' => 'required',
            'image' => 'file'
        ]);


        $user = Auth::user();

        if ($request->has('image')) {

            $image = $request->file('image');

            //salvo ext file
            $ext = $image->getClientOriginalExtension();

            //creo nome img sempre diverso
            $name = rand(100000, 999999) . '_' . time();
            //creo destination file
            $destFile = $name . '.' . $ext;

            //copio file all upload
            $file = $image->storeAs('food_images', $destFile, 'public');

            $food = Food::make([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'visible' => $request->visible,
                'category' => $request->category,
                'image' => $destFile,
            ]);

            $food->user()->associate($user);

            $food->save();
        } else {

            $food = Food::make([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'visible' => $request->visible,
                'category' => $request->category,
            ]);


            $food->user()->associate($user);

            $food->save();
        }

        return redirect()->route('food.index');
    }

    public function edit($id)
    {
        $foods = Food::all();
        $food = Food::findOrFail($id);

        return view('food-edit', compact('food', 'foods'));
    }

    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id);

        $request->validate([
            'name' => 'required|min:3|max:50',
            'price' => 'required|min:1',
            'description' => 'min:5',
            'visible' => 'required',
            'category' => 'required',
            'image' => 'file'
        ]);


        if ($request->has('image')) {

            //delete del file precedente creato
            $fileName = $food->image;

            $file = storage_path('app/public/food_images/' . $fileName);
            File::delete($file);

            $image = $request->file('image');
            //salvo ext file
            $ext = $image->getClientOriginalExtension();

            //creo nome img sempre diverso
            $name = rand(100000, 999999) . '_' . time();

            //creo destination file
            $destFile = $name . '.' . $ext;

            // dd($destFile);

            //copio file all upload
            $file = $image->storeAs('food_images', $destFile, 'public');
            $food->update(
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'description' => $request->description,
                    'visible' => $request->visible,
                    'category' => $request->category,
                    'image' => $destFile,
                ]
            );
        } else {

            $food->update(
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'description' => $request->description,
                    'visible' => $request->visible,
                    'category' => $request->category,

                ]
            );
        }

        $food->save();
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
        Food::where('id', $id)->restore();
        return redirect()->route('food.index');
    }

    public function clearImg($id)
    {
        $food = Food::findOrFail($id);
        $food->image = null;
        $food->save();
        return back();
    }
}
