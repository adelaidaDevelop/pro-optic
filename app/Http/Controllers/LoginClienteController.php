<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginClienteController extends Controller
{
    public function login()
    {
        return view('auth.loginCliente');
    }
}
