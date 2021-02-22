<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function darAltaSucursal($id){
        $sucursal = Sucursal::findOrFail($id);
        $dato['status'] = 1;
        $sucursal->update($dato);
        return redirect('puntoVenta/administracion');

    }

    public function sucu_inactivas(){
        $sucursalesInac = Sucursal::where('status', '=', 0)->get();
        return $sucursalesInac;
        //return compact('sucursalesInac');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show($id)//Sucursal $sucursal)
    {
        if($id == 'sucursales')
        {
            $sucursales = Sucursal::all();
            return $sucursales;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal $sucursal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)//, Sucursal $sucursal)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//Sucursal $sucursal)
    {
        $sucursal['status'] =0;
        $suc2 = Sucursal::findOrFail($id);
        $suc2->update($sucursal);
        return redirect('puntoVenta/administracion');
    }
}
