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
use Response;

class CategoriaController extends Controller
{
    /**
     * Responde a solicitud ajax para buscar categorías de un proveedor.
     *
     * @return \Illuminate\Http\Response
     */
    public function select($idprov){
        $categorias=DB::table('categorias')
        ->select('id','nomcate')
        ->where('idprov', '=', $idprov)
        ->where('estado', '=', 1)
        ->get();
        return Response::json($categorias);
    }

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
            
            $categorias=DB::table('categorias as c')
            ->join('proveedores as p', 'p.id', '=', 'c.idprov')
            ->where('c.nomcate', 'LIKE', '%'.$query.'%')
            ->orderBy('c.idprov', 'asc')
            ->orderBy('c.codcate', 'asc')
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
            ->select('id', 'codprov', 'razons')
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
        $categoria = new categoria;
        $categoria->idprov   = $request->get('idprov');
        $categoria->codcate   = $request->get('codcate');
        $categoria->nomcate  = $request->get('nomcate');
        $categoria->estado   = '1';
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
        retrun('desde show');
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
        $categ = DB::table('categorias as c')
            ->join('proveedores as p', 'p.id', '=', 'c.idprov')
            ->select('c.*', 'p.codprov', 'p.razons')
            ->where('c.id', '=', $id)
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
