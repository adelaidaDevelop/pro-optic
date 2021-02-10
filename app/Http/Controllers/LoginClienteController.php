<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator, Hash, Auth;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginClienteController extends Controller
{
    
    //use AuthenticatesUsers;

    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function login()
    {
        //$this->middleware('isCliente');
        if(!Auth::check())
            return view('auth.loginCliente');
        return redirect('/');
    }

    public function loginPost(Request $request)
    {
        /*$rules = [
            'email' =>'required|email',
            'password' => 'required|min:8'
        ];
        $mesages = [
            'email.required' => 'Su correo electronico es requerido',
            'email.email' => 'El formato de su correo electronico es invalido',
            'password.required' => 'Por favor escriba su contrseña',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        ]
        $validator = Validator::make($request->all(), $rules, $mesages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with(
                'typealert','danger');
        endif;*/
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if(Auth::user()->tipo == 2)
            {
                $request->session()->regenerate();
                session(['idCliente' => Auth::user()->id]);
                return redirect('/');//->intended('/');
            }
            Auth::logout();
        }

        return redirect('loginCliente')->withErrors([
            'email' => 'El email y/o la contraseña son incorrectos',
        ]);
    }

    public function logout(Request $request)
    {
        session()->forget('idCliente');
        Auth::logout();
        /*$idCliente = NULL;
        if(session()->has('idCliente'))
        {
            $idCliente = session('idCliente');
        }*/
        //$request->session()->invalidate();
        $request->session()->regenerate();

        $request->session()->regenerateToken();
        /*if($idCliente != NULL)
        {
            session(['idCliente'])
        }*/
        
        return redirect('/loginCliente');
        //return 'Tambien entra a esta funcion';
    }
}
