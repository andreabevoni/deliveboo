<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    // index
    public function index()
    {

        if (Auth::user()) {
            // $userAuth = Auth::user();
            // $id = $userAuth->id;

            $foods = Auth::user()->food;
            // dd($foods);

            /*  
            $foods = Food::orderBy('name', 'ASC')->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id);
            })->get(); */

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

    public function edit($id)
    {
        $food = Food::findOrFail($id);
        // dd($food);


        return view('food-edit', compact('food'));
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();

        $food = Food::findOrFail($id);

        $food->update($data);

        return redirect()->route('food.index');
    }

    public function destroy($id)
    {

        Food::destroy($id);

        return redirect()->route('food.index');
    }

    public function goToRestore()
    {
        if (Auth::user()) {
            $userAuth = Auth::user();
            $id = $userAuth->id;


            $deletedFood = DB::table('food')
                ->whereNotNull('deleted_at')
                ->where(function ($query) use ($id) {
                    $query->where('user_id', '=', $id);
                })
                ->get();
            // dd($deletedFood);



            /*  $foods = Food::orderBy('name', 'ASC')->where(function ($query) use ($id) {
                $query->where('user_id', '=', $id);
                //->where('deleted_at', '>', '');
            })

                ->get(); */
            return view('pages.food-restore', compact('deletedFood'));
        } else {
            // dd('No logged user');
            return redirect()->route('home');
        }
    }

    public function restore(Request $request)
    {
        $data = $request->all();
        $id = $data['name'];
        // dd($id);

        Food::where('id', $id)->restore();
        return redirect()->route('food.index');
    }
}
