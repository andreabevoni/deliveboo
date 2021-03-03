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
  public function search($id) {
    $typology = Typology::findOrFail($id);
    $users = $typology -> users;
    return response () -> json($users, 200);
  }

  // funzione test
  // public function testSearch() {
  //   $users = User::with(['typologies' => function ($query) {
  //     $query->where('name', 'like', 'consequatur');
  //   }])->get();
  //   return response () -> json($users, 200);
  // }

  public function testSearch() {
    $filters = ['consequatur', 'provident'];

    $users = User::with('typologies');

    foreach ($filters as $filter) {
      $users->whereHas('typologies', function ($query) use ($filter) {
                $query->where('name', $filter);
             });
    }

    return response () -> json($users->get(), 200);
  }



  // funzione show per i ristoranti
  public function restaurantShow($id) {
    $user = User::findOrFail($id);
    return view('test', compact('user'));
  }



  // test per carrello
  public function testShop() {
    return view('test-shop');
  }

  public function testCart() {
    return view('test-cart');
  }
}
