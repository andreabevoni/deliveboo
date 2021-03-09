<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

use App\Food;
use App\User;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $userAuth = Auth::user();
            return view('pages.orders', compact('userAuth'));




        } else {
            return redirect()->route('home');
        }

    }
    
    public function store(Request $request)
    {

        $order = new Order;
        $order->date = date("Y-m-d");
        $order->email = $request->email;
        $order->total = $request->total;
        $order->name = $request->name;
        $order->lastname = $request->lastname;
        $order->phone_number = $request->phone_number;
        $order->address = $request->address;

        $order->save();
        $cartItems = [];
        $quantityItems = [];
        foreach ($request->cart as $item) {
            $cartItems[] = $item['id'];
            $quantityItems[] = $item['quantity'];
        }
        $sync_data = [];
        for ($i = 0; $i < count($cartItems); $i++) {
            $sync_data[$cartItems[$i]] = ['quantity' => $quantityItems[$i]];
        }

        $order->food()->sync($sync_data);

        $mail = $request->email;
        $cart = $request->cart;
        $user = User::with('food')->findOrFail($request->user);
        Mail::to($mail)
            ->send(new OrderMail($cart, $user));


        return response()->json('ok', 200);
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
