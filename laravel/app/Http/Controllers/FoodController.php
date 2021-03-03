<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Food;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    // index
    public function index()
    {

        if (Auth::user()) {
            $userAuth = Auth::user();
            $id = $userAuth->id;

            $foods = Food::orderBy('name', 'ASC')->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id);
            })->get();

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

        $data = $request->all();
        $user = Auth::user();

        $food = Food::make($data);

        $food->user()->associate($user);
        // dd($food);

        $food->save();

        return redirect()->route('food.index');
    }
}
