<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Food;
use App\User;

class OrderController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            # code...
            $userAuth = Auth::user();


            $foods = $userAuth->food;
            return view('orders-page', compact('foods'));
        } else {
            // dd('No logged user');
            return redirect()->route('home');
        }

        // dd($food);

    }
}
