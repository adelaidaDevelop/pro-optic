<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Departamento;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosProd['productos'] = Producto::paginate();
        return view('Producto.index',$datosProd);

      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamento= Departamento::all();
        return view('Producto.create', compact('departamento'));
        //return view('Producto.create', $departamento);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datosProducto = request()->all();
        $datosProducto = request()->except('_token');
        if($request->hasFile('Imagen')){
            $datosProducto['Imagen']=$request->file('Imagen')->store('uploads','public');
        }
        Producto::insert($datosProducto);

        return response()->json($datosProducto);

      //  return redirect('producto');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $departamento= Departamento::all();
        $producto= Producto::findOrFail($id);
        return view('Producto.edit', compact('producto', 'departamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Producto $producto)
    public function destroy($id)
    {
        //
        Producto::destroy($id);

        return redirect('producto');
    }
}
