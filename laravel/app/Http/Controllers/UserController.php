<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{
    protected function create(Request $request)
    {
        dd($request->all());
    }

    public function indexUser() {
    $users = User::all();
    return view('pages.indexUser', compact('users'));
    }

    public function showUser($id) {
    $user = User::findOrFail($id);
    return view('pages.showUser', compact('user'));
  }


}
