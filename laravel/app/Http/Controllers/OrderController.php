<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Food;
use App\User;
use App\Order;
use Illuminate\Support\Carbon as SupportCarbon;

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
                ->where('food.user_id', "=", $userAuth->id)
                ->select('orders.id')
                ->groupBy('orders.id')
                ->get()
                ->toArray();

            // trasformo questo array di oggetti in array normale
            $ids = [];
            foreach ($userOrders as $order) {
                $ids[] = $order->id;
            }

            // recupero tutti gli ordini effettuati con le loro informazioni
            $orders = Order::with('food')
                                ->orderByDesc('id')
                                ->find($ids);

            // creo un array contenente gli anni in cui il ristorante ha ricevuto ordini
            $years = Order::orderByDesc('date')
                           ->find($ids)
                           ->groupBy([function ($d) {
                              return Carbon::parse($d->date)->format('Y');
                            }])
                           ->toArray();
            $years = array_keys($years);

            return view('pages.orders2', compact('userAuth', 'orders', 'years'));
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


    public function chartMonths()
    {
        if (Auth::user()) {
            $userAuth = Auth::user();

            // ottengo un array di oggetti contenente gli ID di tutti gli ordini effettuati al ristoratore connesso
            $userOrders = DB::table('orders')
                ->join('food_order', 'orders.id', '=', 'food_order.order_id')
                ->join('food', 'food_order.food_id', '=', 'food.id')
                ->where('food.user_id', "=", $userAuth->id)
                ->select('orders.id')
                ->groupBy('orders.id')
                ->get()
                ->toArray();

            // trasformo questo array di oggetti in array normale
            $ids = [];
            foreach ($userOrders as $order) {
                $ids[] = $order->id;
            }

            //==================================


            $orders = Order::with('food')
                ->find($ids)
                ->groupBy(
                    function ($d) {
                        return Carbon::parse($d->date)->format('Y');
                    }

                );

            $output = null;

            foreach ($orders as $key => $order) {
                foreach ($order as $item) {
                    //get each item in the group
                    // dd($item);
                }
                $output[$key] = $order->count();
            }




            dd($output);
            // =================================================




            /*           //creo array mesi vuoto
            $months = [];

            //creo i mesi usando gli indici
            for ($i = 0; $i < 12; $i++) {
                $months[] = $i + 1;
            }

            //creo array ordini vuoto
            $order = [];

            //per ogni ordine faccio la count di ogni mese passando il valore dell array month
            foreach ($months as $key => $value) {
                // dd($months);
                $order[] =
                    Order::with('food')
                    ->whereMonth('created_at', $value)
                    // ->whereYear('date', year)
                    ->find($ids)
                    // ->groupBy('date')
                    ->count();
            } */
            // dd($order);
            return view('pages.chart-months')->with('order', json_encode($order))->with('months', json_encode($months));
        } else {
            return redirect()->route('home');
        }
    }

    //chart per anni

    public function chartYears()
    {
        if (Auth::user()) {
            $userAuth = Auth::user();

            // ottengo un array di oggetti contenente gli ID di tutti gli ordini effettuati al ristoratore connesso
            $userOrders = DB::table('orders')
                ->join('food_order', 'orders.id', '=', 'food_order.order_id')
                ->join('food', 'food_order.food_id', '=', 'food.id')
                ->where('food.user_id', "=", $userAuth->id)
                ->select('orders.id')
                ->groupBy('orders.id')
                ->get()
                ->toArray();

            // trasformo questo array di oggetti in array normale
            $ids = [];
            foreach ($userOrders as $order) {
                $ids[] = $order->id;
            }

            // recupero tutti gli ordini effettuati con le loro informazioni
            $date = Order::with('food')
                ->find($ids)
                ->pluck('date');

            $years = [];

            foreach ($date as $key => $value) {

                $year = Carbon::createFromFormat('Y-m-d', $value)->year;


                $years[] = $year;
            }
            $uniqueYear =  array_values(array_unique($years, SORT_REGULAR));


            // dd($date);

            //creo array ordini vuoto
            $order = [];

            //per ogni ordine faccio la count di ogni mese passando il valore dell array month
            foreach ($uniqueYear as $key => $value) {
                // dd($months);
                $order[] =
                    Order::with('food')
                    ->whereYear('date', $value)
                    ->find($ids)
                    ->count();
            }
            // dd($order);

            return view('pages.chart-years')->with('order', json_encode($order))->with('uniqueYear', json_encode($uniqueYear));
        } else {
            return redirect()->route('home');
        }
    }
}
