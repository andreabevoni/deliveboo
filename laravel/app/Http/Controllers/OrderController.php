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

        $userAuth = Auth::user();


        $foods = $userAuth->food;
        // dd($food);

        return view('orders-page', compact('foods'));
    }
}
