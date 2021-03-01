<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    protected function create(Request $request)
    {
        dd($request->all());
    }
}
