<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//agregados
use App\Entities\Red;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RedesRequest;
use Illuminate\Support\Collection as Collection;
use DB;

class RedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query=trim($request->get('searchText'));
            $data=DB::table('redes')
            ->where('desred', 'LIKE', '%'.$query.'%')
            ->orderBy('codred', 'desc')
            ->paginate(10);
            
            return view('parametros.red.index', [
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
        Return view ('parametros.red.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RedesRequest $request)
    {
        $data = new Red;
        $data->codred = $request->get('codred');
        $data->desred = $request->get('desred');
        $data->estado = '1';
        $data->save();
        return Redirect::to('red')->with('notification', 'Registro guardado exitosamente.');
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
        $data = Red::findOrFail($id);
        return view('parametros.red.edit', compact('data'));
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
        $data = Red::FindOrFail($id);
        $data->desred = $request->get('desred');
        $data->update();
        return Redirect::to('red')->with('notification', 'Registro actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Red::findOrFail($id);   
        if ($data->estado == 1) {
            $data->estado = 0;
        } else {
            $data->estado = 1;
        }
        $data->update();        
        return Redirect::to('red');
    }
}
