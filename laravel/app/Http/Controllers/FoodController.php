<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Food;

class FoodController extends Controller
{
    // index
    public function index() {
        // $userAuth = Auth::user();

        $foods = Food::all();

        // dd($food);
        return view('foods-page', compact('foods'));
    }

    // create
    public function create() {
        $foods = Food::all();
        return view('food-create', compact('foods'));
    }

    // store
    public function store(Request $request) {

        dd($request -> all());

        return redirect() -> route('index-food');
    }
}
