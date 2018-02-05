<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//add

use App\Entities\Categoria; 
use App\Entities\Proveedor;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriasRequest;
use Illuminate\Support\Collection as Collection;
use DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return view('Maestros.categoria.Index');
        if ($request) {
            $query=trim($request->get('searchText'));
            
            $categorias=DB::table('categorias')->where('nomcate', 'LIKE', '%'.$query.'%')
            ->orderBy('codprov', 'asc')
            ->orderBy('codcate', 'asc')
            ->paginate(10);
            return view('maestros.categoria.index', [
                "categorias" => $categorias,
                "searchText" => $query
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
        $proveedores = DB::table('proveedores')
            ->where('estado', '=', 1)
            ->select('codprov', 'razons')
            ->get();
    
        // dd($proveedores);
        
         return view('maestros.categoria.create', [
            "proveedores" => $proveedores
            ]
        );
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriasRequest $request)
    {
/*
        $input = request()->validate([
            'validaCate' => [
                'required',
                new valCate()]
            ]
        );       
*/
        $categoria = new categoria;
        $categoria->codprov     = $request->get('codprov');
        $categoria->codcate     = $request->get('codcate');
        $categoria->nomcate      = $request->get('nombre');
        $categoria->estado      = '1';
        $categoria->save();
        return back()->with('notification', 'Registro guardado exitosamente.');
        //return Redirect::to('categoria');


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
        $categoria = Categoria::findOrFail($id);
        $categ = DB::table('categorias')
            ->join('proveedores', 'categorias.codprov', '=', 'proveedores.codprov')
            ->select('categorias.*', 'proveedores.razons')
            ->where('categorias.id', '=', $id)
            ->first();
        
        //dd($categ);
        return view('maestros.categoria.edit', compact(['categ', 'categoria']));
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
        $categoria = Categoria::FindOrFail($id);
        $categoria->nombre = $request->get('nombre');
        $categoria->update();
        return back()->with('notification', 'Registro actualizado exitosamente.');
        //dd($categoria);
        //return Redirect::to('categoria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);   
        if ($categoria->estado == 1) {
            $categoria->estado = 0;
        } else {
            $categoria->estado = 1;
        }
        $categoria->update();        
        return Redirect::to('categoria');
    }
}
