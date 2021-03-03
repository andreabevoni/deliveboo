<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Food;

class OrderController extends Controller
{
    public function index()
    {
        // $userAuth = Auth::user();

        $foods = Food::all();

        // dd($food);
        return view('orders-page', compact('foods'));
    }
}
