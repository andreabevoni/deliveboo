<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Food;
use App\User;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            # code...
            $userAuth = Auth::user();
        } else {
            // dd('No logged user');
            return redirect()->route('home');
        }

        // dd($food);

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
        $mail = $request->email;
        $cart = $request->cart;
        $user = User::with('food')->findOrFail($request->user);

        Mail::to($mail)
            ->send(new OrderMail($cart, $user));

        return response()->json('mail inviata', 200);
    }
}
