<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add
use App\Entities\Localidad;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\LocalidadesRequest;
use Illuminate\Support\Collection as Collection;
use DB;
use Response;

class LocalidadController extends Controller
{
    /**
     * Busca zonas activas para la red seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function traeZonas($red)
    {
        $data = DB::table('zonas as z')
        ->select('z.id', 'z.codzon', 'z.nomzon')
        ->where('idred', '=', $red)
        ->where('estado', '=', 1)
        ->get();
        return Response::json($data);
    }
    /**
     * Valida existencia de localidad
     *
     * @return \Illuminate\Http\Response
     */
    public function validaEx($red, $zona, $loca)
    {
        $data = DB::table('localidades')
        ->where('idred', '=', $red)
        ->where('idzon', '=', $zona)
        ->where('codloc', '=', $loca)
        ->get();
        return Response::json($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query=trim($request->get('searchText'));
            $data=DB::table('localidades as l')
            ->join('redes as r', 'l.idred', '=', 'r.id')
            ->join('zonas as z', 'l.idzon', '=', 'z.id')
            ->select('l.*', 'r.codred', 'r.desred', 'z.codzon', 'z.nomzon')
            ->where('nomloc', 'LIKE', '%'.$query.'%')
            ->orderBy('codloc', 'asc')
            ->paginate(10);
            
            return view('parametros.localidad.index', [
                'data'       => $data,
                'searchText' => $query
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
        //busca redes activas
        $redes = DB::table('redes')
        ->select('id', 'codred', 'desred')
        ->where('estado', '=', 1)
        ->orderBy('codred', 'asc')
        ->get();

        //busca el id del primer registro activo
        $param = $redes->first();

        //busca la zona del primer id activo
        $zonas = DB::table('zonas as z')
        ->select('z.id', 'z.codzon', 'z.nomzon')
        ->where('idred', '=', $param->id)
        ->where('estado', '=', 1)
        ->get();

        return view('parametros.localidad.create', [
            'redes' => $redes,
            'zonas' => $zonas
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocalidadesRequest $request)
    {
        $data = new Localidad;
        $data->idred = $request->get('idred');
        $data->idzon = $request->get('idzon');
        $data->codloc = $request->get('codloc');
        $data->nomloc = $request->get('nomloc');
        $data->desloc = $request->get('desloc');    
        $data->estado = 1;
        $data->save();
        return Redirect::to('localidad')->with('notification', 'Registro guardado exitosamente.');
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
        $data = DB::table('localidades as l')
            ->join('redes as r', 'l.idred', '=', 'r.id')
            ->join('zonas as z', 'l.idzon', '=', 'z.id')
            ->select('l.*', 'r.desred', 'z.nomzon')
            ->where('l.id', '=', $id)
            ->first();
            //dd($data);
        return view('parametros.localidad.edit', compact('data'));
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
        $data = Localidad::FindOrFail($id);
        $data->nomloc = $request->get('nomloc');
        $data->desloc = $request->get('desloc');
        $data->update();
        return Redirect::to('localidad')->with('notification', 'Registro actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Zona::findOrFail($id);   
        if ($data->estado == 1) {
            $data->estado = 0;
        } else {
            $data->estado = 1;
        }
        $data->update();        
        return Redirect::to('localidad');
    }
}