<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

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

    public function mailSend(Request $request)
    {
	    $mail = $request -> email;
      $cart = $request -> cart;
      $user = User::with('food')->findOrFail($request -> user);

	    Mail::to($mail)
	        ->send(new OrderMail($cart, $user));

      return response () -> json('mail inviata', 200);
    }
}
