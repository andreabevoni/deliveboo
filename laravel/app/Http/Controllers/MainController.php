<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Typology;

class MainController extends Controller
{
  public function index() {
    $typologies = Typology::all();
    return view('welcome', compact('typologies'));
  }

  public function search($id) {
    $typology = Typology::findOrFail($id);
    $users = $typology -> users;
    return response () -> json($users, 200);
  }

  public function restaurantShow($id) {
    $user = User::findOrFail($id);
    // debug
    return redirect('home', compact('user'));
  }
}
