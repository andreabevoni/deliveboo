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
    $typologies = Typology::orderBy('name')->get();
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
  public function testShow($id) {
    $user = User::with('food')->findOrFail($id);
    return view('pages.testCart', compact('user'));
  }

  public function checkout($id) {
    $user = User::with('food')->findOrFail($id);
    return view('pages.checkout', compact('user'));
  }
}
