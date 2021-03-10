<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\DB;

use App\Food;
use App\User;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $userAuth = Auth::user();

            // ottengo un array di oggetti contenente gli ID di tutti gli ordini effettuati al ristoratore connesso
            $userOrders = DB::table('orders')
                        ->join('food_order', 'orders.id', '=', 'food_order.order_id')
                        ->join('food', 'food_order.food_id', '=', 'food.id')
                        ->where('food.user_id', "=", $userAuth -> id)
                        ->select('orders.id')
                        ->groupBy('orders.id')
                        ->get()
                        ->toArray();

            // trasformo questo array di oggetti in array normale
            $ids = [];
            foreach ($userOrders as $order) {
              $ids[]= $order -> id;
            }

            // recupero tutti gli ordini effettuati con le loro informazioni
            $orders = Order::with('food')
                           ->find($ids)
                           ->sortKeysDesc();
<<<<<<< HEAD
=======
            //                ->reverse();

            // $orders = Order::with('food')
            //                ->whereIn('id', $ids)
            //                ->orderBy('date', 'desc')
            //                ->get();
>>>>>>> 99a143fc644b1df5171a589d8d09b5bac8a5106a

            return view('pages.orders', compact('userAuth', 'orders'));

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
