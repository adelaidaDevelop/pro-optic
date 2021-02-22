<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
        //$this->middleware('isEmpleado');
    }

    public function login()
    {
        if(session()->has('idEmpleado'))
        {
            if(Auth::check())
            {
                if(Auth::user()->tipo == 0)
                {
                    if(Auth::user()->id == 1)
                        return redirect('/puntoVenta/home');
                    $id = Auth::user()->id;
                    $empleado = Empleado::where('idUsuario','=',$id)->get()->first();
                    $sucursalEmpleado = Sucursal_empleado::where('idSucursal','=',session('sucursal'))
                    ->where('idEmpleado','=',$empleado->id)->get()->first();
                    if($sucursalEmpleado->count() && $sucursalEmpleado->status == 'alta')
                        return redirect('/puntoVenta/home');
                    
                }
                Auth::logout();
            }
            $idEmpleado = session('idEmpleado');
            Auth::loginUsingId($idEmpleado);
            return redirect('/puntoVenta/home');
            
        }     
        return view('auth.login');
        //
        //return 'Si entra aqui';
    }
    public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if(Auth::user()->tipo == 0)
            {
                if(Auth::user()->id == 1)
                    return redirect('/puntoVenta/home');
                $id = Auth::user()->id;
                $empleado = Empleado::where('idUsuario','=',$id)->get()->first();
                $sucursalEmpleado = Sucursal_empleado::where('idSucursal','=',session('sucursal'))
                ->where('idEmpleado','=',$empleado->id)->get()->first();
                if($sucursalEmpleado->count() && $sucursalEmpleado->status == 'alta')
//                    return redirect('/puntoVenta/home');
                $request->session()->regenerate();
                session(['idEmpleado' => Auth::user()->id]);
                session(['sucursal' => $request->input('opcionSucursal')]);
                return redirect('/puntoVenta/venta');//->intended('/');
            }
            Auth::logout();
        }

        return redirect('puntoVenta/login')->withErrors([
            'email' => 'El email y/o la contraseña son incorrectos',
        ]);
    }

    public function logout(Request $request)
    {
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
        session()->forget('idEmpleado');
        return redirect('puntoVenta/login');
        //return 'Tambien entra a esta funcion';
    }
}