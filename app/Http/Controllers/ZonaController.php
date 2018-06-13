<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//agregados
use App\Entities\Zona;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ZonasRequest;
use Illuminate\Support\Collection as Collection;
use DB;
use Response;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validaEx($red, $zona)
    {
        $data = DB::table('zonas')
        ->where('idred', '=', $red)
        ->where('codzon', '=', $zona)
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
            $data=DB::table('zonas as z')
            ->join('redes as r', 'z.idred', '=', 'r.id')
            ->select('z.*', 'r.codred')
            ->where('z.nomzon', 'LIKE', '%'.$query.'%')
            ->orderByRaw('r.codred, z.codzon')
            ->paginate(10);
            
            return view('parametros.zona.index', [
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
        $redes = DB::table('redes')
            ->select('id', 'codred', 'desred')
            ->where('estado', '=', 1)
            ->orderBy('codred', 'asc')
            ->get();
        Return view('parametros.zona.create', compact('redes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZonasRequest $request)
    {
        $data = new Zona;
        $data->idred = $request->get('codred');
        $data->codzon = $request->get('codzon');
        $data->nomzon = $request->get('nomzon');
        $data->deszon = $request->get('deszon');
        $data->estado = '1';
        $data->save();
        return Redirect::to('zona')->with('notification', 'Registro guardado exitosamente.');
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
        $data = DB::table('zonas as z')
            ->join('redes as r', 'z.idred', '=', 'r.id')
            ->select('z.*', 'r.desred') 
            ->where('z.id', '=', $id)
            ->first();
            //dd($data);
        return view('parametros.zona.edit', compact('data'));
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
        $data = Zona::FindOrFail($id);
        $data->nomzon = $request->get('nomzon');
        $data->deszon = $request->get('deszon');
        $data->update();
        return Redirect::to('zona')->with('notification', 'Registro actualizado exitosamente.');
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
        return Redirect::to('zona');
    }
}
