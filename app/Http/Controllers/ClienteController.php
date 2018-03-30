<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add
use App\Http\Requests\ClientesRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection as Collection;
use DB;
use Carbon\Carbon; //Carbon::now('America/Bogota')->toDateTimeString();
use Response;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
        if ($request) {
            $query=trim($request->get('searchText'));
            $clientes=DB::table('clientes')
            ->where('razons', 'LIKE', '%'.$query.'%')
            ->where('nombres', 'LIKE', '%'.$query.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);
            
            $clientes=DB::table('clientes')->where('id', '=', '1')->get();
            
            return view('maestros.cliente.index', [
                'clientes'   =>$clientes,
                'searchText' =>$query,
                ]
            );
        };
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maestros.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CienteRequest $request)
    {
        $cliente=new Cliente;
        $cliente->tipdoc     = $request->get('tipdoc');
        $cliente->documento  = $request->get('documento');
        $cliente->nombres    = $request->get('nombres');
        $cliente->apellidos  = $request->get('apellidos');
        $cliente->razons     = $request->get('razons');
        $cliente->direccion  = $request->get('direccion');
        $cliente->idpto      = $request->get('idpto');
        $cliente->idciudad   = $request->get('idciudad');
        $cliente->telefonos  = $request->get('telefonos');
        $cliente->email      = $request->get('email');
        $cliente->estado     = 1;
        $cliente->save();
        return Redirect::to('cliente')
          ->with('notification', 'Registro guardado exitosamente.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
