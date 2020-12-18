<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Departamento;
use Illuminate\Http\Request;
//para poder borrar informacion de los registros de la carpeta uploads de storage
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $departamento= Departamento::all();
        $datosProd['producto'] = Producto::paginate();
        $departamentos['d']= Departamento::paginate();
        $departamento= Departamento::all();
       // $producto= Producto::all();
        //return view('Producto.edit', compact('producto', 'departamento'));

       // return view('Producto.index',$departamentos, compact('producto','departamento'));
       // return view('Producto.index',$datosProd,$departamentos, compact('departamento'));
        return view('Producto.form2');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // $departamentos['d']= Departamento::paginate();
        $producto['producto']= Producto::paginate();
       // $producto=Producto::all();
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
        $datosProducto['existencia']=0;
        if($request->hasFile('Imagen')){
            $datosProducto['Imagen']=$request->file('Imagen')->store('uploads','public');
        }
        Producto::insert($datosProducto);

       // return response()->json($datosProducto);
        return redirect('producto');
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
    public function update(Request $request, $id)
    {
        //
        
        $departamento= Departamento::all();
        $datosProducto=request()->except(['_token', '_method']);

        if($request->hasFile('Imagen')){
            $producto=Producto::findOrFail($id);
            //borrar fotografia antigua
            Storage::delete('public/'.$producto->imagen);
            $datosProducto['Imagen']=$request->file('Imagen')->store('uploads','public');
        }

        Producto::where('id', '=',$id)->update($datosProducto);

        $producto=Producto::findOrFail($id);
        return view('producto.edit', compact('producto', 'departamento'));
        
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
        //buscaar todos los datos que corresponden a este id
        $producto= Producto::findOrFail($id);

        if( Storage::delete('public/'.$producto->imagen)){
            Producto::destroy($id);
        }
        return redirect('producto');
    }
}
