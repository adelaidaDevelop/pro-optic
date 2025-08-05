<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Sucursal;
use App\Models\Departamento;
use App\Models\Cliente;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Sucursal_producto;
use Illuminate\Support\Arr;
use Validator, Hash, Auth;
use Illuminate\Auth\Events\Registered;

class LoginClienteController extends Controller
{
    public function __construct(){}

    public function loginCliente()
    {
        $compra = null;
        if (isset($_GET['compra']))
        {$compra = $_GET['compra'];}
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=', 1)->get(['id', 'nombre']);

        if(session()->has('idCliente'))
        {
            if(Auth::check() && !Auth::user()->tipo == 2) {Auth::logout();}

            $idCliente = session('idCliente');
            Auth::loginUsingId($idCliente);
            return redirect('/menu');
        }
        return view('auth.loginCliente', compact('sucursales', 'departamentos', 'compra'));
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
            if (Auth::user()->tipo == 2) {
                $request->session()->regenerate();
                session(['idCliente' => Auth::user()->id]);
                $carritoUsuario = Carrito::where('idUsuario', '=', Auth::user()->id)->get();
                $carrito = [];
                if (count($carritoUsuario) > 0) {
                    foreach ($carritoUsuario as $c) {
                        $p = Producto::find($c->idProducto);
                        $sp = Sucursal_producto::where('idSucursal', '=', session('sucursalEcommerce'))
                            ->where('idProducto', '=', $c->idProducto)->get();
                        if (isset($p) && count($sp) > 0) {
                            if ($sp->first()->existencia == 0) {
                                Carrito::where('idUsuario', '=', Auth::user()->id)
                                    ->where('idProducto', '=', $sp->first()->idProducto)->delete();
                            } else {
                                $producto = [];
                                if ($c->cantidad <= $sp->first()->existencia)
                                    {$producto['cantidad'] = $c->cantidad;}
                                else
                                    {$producto['cantidad'] = $sp->first()->existencia;}
                                $producto['id'] = $p->id;
                                $producto['imagen'] = $p->imagen;
                                $producto['nombre'] = $p->nombre;
                                $producto['precio'] = $sp->first()->precio;
                                $producto['sucursal'] = $c->idSucursal;
                                array_push($carrito, $producto);
                            }
                        }
                    }
                }

                $carritoInvitado = session('carrito');
                if (isset($carritoInvitado) && count($carritoInvitado) > 0) {
                    for ($x = 0; $x < count($carritoInvitado); $x++) {
                        $encontrado = false;
                        for ($i = 0; $i < count($carrito); $i++) {
                            if (
                                $carrito[$i]['sucursal'] == $carritoInvitado[$x]['sucursal'] &&
                                $carrito[$i]['id'] == $carritoInvitado[$x]['id']
                            ) {
                                $encontrado = true;
                                $cantidadCombinada = $carrito[$i]['cantidad'] + $carritoInvitado[$x]['cantidad'];
                                $sp = Sucursal_producto::where('idSucursal', '=', $carrito[$i]['sucursal']) //session('sucursalEcommerce'))
                                    ->where('idProducto', '=', $carrito[$i]['id'])->first();
                                $pCarrito = Carrito::where('idUsuario', '=', Auth::user()->id)
                                    ->where('idProducto', '=', $carrito[$i]['id'])
                                    ->where('idSucursal', '=', $carrito[$i]['sucursal']);
                                $pCarrito->update(['cantidad' => $cantidadCombinada]);
                                $carrito[$i]['cantidad'] = $cantidadCombinada;
                                if ($cantidadCombinada > $sp->existencia) {
                                    $pCarrito->update(['cantidad' => $sp->existencia]);
                                    $carrito[$i]['cantidad'] = $sp->existencia;
                                }
                            }
                        }
                        if ($encontrado === false) {
                            $agregarProductoCarrito = new Carrito;
                            $agregarProductoCarrito->idUsuario = Auth::user()->id;
                            $agregarProductoCarrito->idProducto = $carritoInvitado[$x]['id'];
                            $agregarProductoCarrito->idSucursal = $carritoInvitado[$x]['sucursal'];
                            $agregarProductoCarrito->cantidad = $carritoInvitado[$x]['cantidad'];
                            $agregarProductoCarrito->save();
                            array_push($carrito, $carritoInvitado[$x]);
                        }
                    }
                }
                session(['carrito' => $carrito]);
                if (isset($_GET['compra']))
                   { return redirect('/direccionEnvio');}
                return redirect('/menu'); //->intended('/');
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
        $carrito = [];
        session(['carrito' => $carrito]);
        Auth::logout();
        /*$idCliente = NULL;
        if(session()->has('idCliente'))
        {
            $idCliente = session('idCliente');
        }*/
        $request->session()->regenerate();
        $request->session()->regenerateToken();
        /*if($idCliente != NULL)
        {
            session(['idCliente'])
        }*/
        return redirect('/loginCliente');
    }
    public function register()
    {
        $sucursales = Sucursal::all();
        $departamentos = Departamento::where('ecommerce', '=', 1)->get(['id', 'nombre']);
        if (!Auth::check())
           { return view('auth.registerCliente', compact('sucursales', 'departamentos'));}
        return redirect('/');
    }
    public function registerPost(Request $request)
    {
        $this->validator($request->all())->validate();
        $datosEmpleado = request()->except('_token', 'password_confirmation', 'username', 'password', 'email'); //,'apellidos','contra2','correo');
        $usuario = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'tipo' => 2,
        ]);
        $datosEmpleado = Arr::add($datosEmpleado, 'idUsuario', $usuario->id);
        $datosEmpleado = Arr::add($datosEmpleado, 'tipo', 2);
        $cliente = Cliente::create($datosEmpleado);
        Auth::loginUsingId($usuario->id);
        session(['idCliente' => Auth::user()->id]);
        event(new Registered($usuario));
        return redirect('/menu');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:50'],
            'telefono' => ['required', 'string', 'max:10'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
