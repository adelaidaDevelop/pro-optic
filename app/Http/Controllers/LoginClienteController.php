<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Arr;
use Validator, Hash, Auth;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginClienteController extends Controller
{
    
    //use AuthenticatesUsers;

    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function loginCliente()
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
    public function register()
    {
        if(!Auth::check())
            return view('auth.registerCliente');
        return redirect('/');
        
    }
    public function registerPost(Request $request)
    {
        $this->validator($request->all())->validate();
        $datosEmpleado = request()->except('_token','password_confirmation','username','password','email');//,'apellidos','contra2','correo');
        $usuario = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'tipo' => 2,
        ]);
        $datosEmpleado = Arr::add($datosEmpleado,'idUsuario',$usuario->id);
        $datosEmpleado = Arr::add($datosEmpleado,'tipo',2);
        //$empleado = new Empleado;
        $cliente = Cliente::create($datosEmpleado);
        return $datosEmpleado;//view('auth.registerCliente');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:50'],
            'domicilio' => ['required', 'string', 'max:50'],
            'telefono' => ['required', 'string', 'max:10'],
            'username' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);    
    }


}
