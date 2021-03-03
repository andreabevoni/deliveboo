<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Typology;
use Illuminate\Database\Eloquent\Builder;

class MainController extends Controller
{
  // homepage
  public function index() {
    $typologies = Typology::all();
    return view('pages.homepage', compact('typologies'));
  }

  // funzione per ricerca dinamica dei ristoranti in homepage
  public function search(Request $request) {
    $filters = $request -> filters;
    $users = User::with('typologies')->orderBy('restaurant_name');
    foreach ($filters as $filter) {
      $users->whereHas('typologies', function ($query) use ($filter) {
                $query->where('name', $filter);
             });
    }
    return response () -> json($users->get(), 200);
  }

  // test per carrello
  public function testShop() {
    return view('test-shop');
  }

  public function testCart() {
    return view('test-cart');
  }
}
