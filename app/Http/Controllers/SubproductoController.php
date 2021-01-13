<?php

namespace App\Http\Controllers;

use App\Models\Subproducto;
use App\Models\Producto;
use App\Models\Departamento;
use Illuminate\Http\Request;

class SubproductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosProd['prod'] = Producto::paginate();
        $subproducto2['subproducto']= Subproducto::paginate();
        $depas['d']= Departamento::paginate();
      //  $productos['prod']= Producto::paginate();
          return view('Subproducto.index',$subproducto2,$depas);

/*
          $datosProd['producto'] = Producto::paginate();
          $departamentos['d']= Departamento::paginate();
          $departamento= Departamento::all();
              return view('Producto.index',$datosProd,$departamentos, compact('departamento'));
   */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       // $datosProd['producto'] = Producto::paginate(); necesito este: producto
        $subproducto2['subproducto']= SubProducto::paginate();
         $producto=Producto::all();
         return view('Subproducto.agregar', compact('producto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $datosSubproducto = request()->except('_token');
        $datosSubproducto['existencia']=0;
        $datosSubproducto['ganancia']=0; //calcular
        Subproducto::insert($datosSubproducto);

       // return response()->json($datosSubproducto);
        return redirect('subproducto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function show(Subproducto $subproducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function edit(Subproducto $subproducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subproducto $subproducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subproducto  $subproducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subproducto $subproducto)
    {
        //
    }
}
