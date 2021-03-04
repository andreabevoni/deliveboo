<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
