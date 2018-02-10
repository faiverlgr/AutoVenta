<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add
use App\Entities\Agencia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AgenciasRequest;
use Illuminate\Support\Collection as Collection;
use DB;

class AgenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return view('Maestros.Proveedor.Index');
        if ($request) {
            $query=trim($request->get('searchText'));
            $agencias=DB::table('agencias')->where('nombre', 'LIKE', '%'.$query.'%')
            ->orderBy('codage', 'desc')
            ->paginate(10);
            return view('parametros.agencia.index', [
                "agencias"=>$agencias,
                "searchText"=>$query
                ]
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parametros.agencia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgenciasRequest $request)
    {
        $agencia=new Agencia;
        $agencia->codage     = $request->get('codage');
        $agencia->nitage     = $request->get('nitage');
        $agencia->nombre     = $request->get('nombre');
        $agencia->nomrepre   = $request->get('nomrepre');
        $agencia->docrepre   = $request->get('docrepre');
        $agencia->direccion  = $request->get('direccion');
        $agencia->barrio     = $request->get('barrio');
        $agencia->telefono1  = $request->get('telefono1');
        $agencia->telefono2  = $request->get('telefono2');
        $agencia->email      = $request->get('email');
        $agencia->estado     = '1';
        $agencia->save();
        return back()->with('notification', 'Registro guardado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agencia = Agencia::findOrFail($id);
        return view('parametros.agencia.edit', compact('agencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agencia = Agencia::findOrFail($id);
        $agencia->codage     = $request->get('codage');
        $agencia->nitage     = $request->get('nitage');
        $agencia->nombre     = $request->get('nombre');
        $agencia->nomrepre   = $request->get('nomrepre');
        $agencia->docrepre   = $request->get('docrepre');
        $agencia->direccion  = $request->get('direccion');
        $agencia->barrio     = $request->get('barrio');
        $agencia->telefono1  = $request->get('telefono1');
        $agencia->telefono2  = $request->get('telefono2');
        $agencia->email      = $request->get('email');
        $agencia->update();
        return Redirect::to('agencia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agencia = Agencia::findOrFail($id);   
        if ($agencia->estado == 1) {
            $agencia->estado = 0;
        } else {
            $agencia->estado = 1;
        }
        $agencia->update();        
        return Redirect::to('agencia');
    }
}
