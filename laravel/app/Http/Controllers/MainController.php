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
}
