<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add
use App\Entities\Negocio;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\NegociosRequest;
use Illuminate\Support\Collection as Collection;
use DB;
use Response;

class NegocioController extends Controller
{
    /**
     * Busca negocios para un cliente
     *
     * @return \Illuminate\Http\Response
     */
    public function traeNegocios($cliente)
    {
        $data = DB::table('negocios as n')
        ->join('redes as r', 'n.idred', '=', 'r.id')
        ->join('zonas as z', 'n.idzon', '=', 'z.id')
        ->join('localidades as l', 'n.idloc', '=', 'l.id')
        ->join('clientes as c', 'n.idcli', '=', 'c.id')
        ->select('n.*', 'r.codred', 'r.desred', 'z.codzon', 'z.nomzon', 'l.codloc', 'l.nomloc', 'c.nrodoc', 'c.razons')
        ->where('idcli', '=', $cliente)
        ->where('n.estado', '=', 1)
        ->get();
        return Response::json($data);
    }
    /**
     * Busca zonas activas para la red seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function traeZonas($red)
    {
        $data = DB::table('zonas')
        ->select('id', 'codzon', 'nomzon')
        ->where('idred', '=', $red)
        ->where('estado', '=', 1)
        ->get();
        return Response::json($data);
    }
    /**
     * Busca localidades activas para la zona seleccionada
     *
     * @return \Illuminate\Http\Response
     */
    public function traeLocalidades($zon)
    {
        $data = DB::table('localidades')
        ->select('id', 'codloc', 'nomloc')
        ->where('idzon', '=', $zon)
        ->where('estado', '=', 1)
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
        
            $negocios = DB::table('negocios as n')
            ->join('redes as r', 'n.idred', '=', 'r.id')
            ->join('zonas as z', 'n.idzon', '=', 'z.id')
            ->join('localidades as l', 'n.idloc', '=', 'l.id')
            ->join('clientes as c', 'n.idcli', '=', 'c.id')
            ->select('n.*', 'r.codred', 'z.codzon', 'l.codloc', 'c.nrodoc')
            ->where([
                ['nomneg', 'LIKE', '%'.$query.'%'],
                ['n.estado', '=', 1]
            ])
            ->orderBy('id', 'desc')
            ->paginate(10);
            
            return view('maestros.negocio.index', [
                'negocios'   => $negocios,
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
    public function crearneg($cliente)
    {
        $cli = DB::table('clientes')
        ->select('id', 'nrodoc', 'razons')
        ->where('id', '=', $cliente)
        ->first();

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

        //busca el id del primer registro    activo
        $param = $zonas->first();

        //busca la zona del primer id activo
        $localidades = DB::table('localidades')
        ->select('id', 'codloc', 'nomloc')
        ->where('idzon', '=', $param->id)
        ->where('estado', '=', 1)
        ->get();

        return view('maestros.negocio.create', [
            'redes'         => $redes,
            'zonas'         => $zonas,
            'localidades'   => $localidades,
            'cli'           => $cli
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NegociosRequest $request)
    {
        $data = new Negocio;
        $data->idcli        = $request->get('idcli');
        $data->idred        = $request->get('idred');
        $data->idzon        = $request->get('idzon');
        $data->idloc        = $request->get('idloc');
        $data->nomneg       = $request->get('nomneg');
        $data->direccion    = $request->get('direccion');
        $data->idciudad     = $request->get('idciudad');
        $data->telefono     = $request->get('telefono');
        $data->email        = $request->get('email');
        $data->tipneg       = $request->get('tipneg');
        $data->estado       = 1;
        $data->save();
        return Redirect::back()->with('notification', 'Registro guardado exitosamente.');
        //return Redirect::to('negocio')->with('notification', 'Registro guardado exitosamente.');
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
        $data = DB::table('negocios as n')
            ->join('clientes as c', 'n.idred', '=', 'c.id')
            ->join('redes as r', 'n.idred', '=', 'r.id')
            ->join('zonas as z', 'n.idzon', '=', 'z.id')
            ->join('localicades as l', 'n.idloc', '=', 'l.id')
            ->select('n.*', 'r.desred', 'z.nomzon', 'z.nomloc', 'c.nrodoc', 'c.razons')
            ->where('n.id', '=', $id)
            ->first();
        return view('parametros.negocio.edit', compact('data'));
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
        $data = Negocio::FindOrFail($id);
        $data->nomneg     = $request->get('nomneg');
        $data->direccion  = $request->get('direccion');
        $data->idciudad   = $request->get('idciudad');
        $data->telefono   = $request->get('telefono');
        $data->email      = $request->get('email');
        $data->tipneg     = $request->get('tipneg');
        $data->update();
        return Redirect::to('negocio')->with('notification', 'Registro actualizado exitosamente.');
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
        return Redirect::to('negocio');
    }
}
