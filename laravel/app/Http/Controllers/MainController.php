<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Typology;

class MainController extends Controller
{
  // homepage
  public function index() {
    $typologies = Typology::all();
    return view('welcome', compact('typologies'));
  }

  // funzione per ricerca dinamica dei ristoranti in homepage
  public function search($id) {
    $typology = Typology::findOrFail($id);
    $users = $typology -> users;
    return response () -> json($users, 200);
  }

  // funzione show per i ristoranti
  public function restaurantShow($id) {
    $user = User::findOrFail($id);
    return view('test', compact('user'));
  }
}
