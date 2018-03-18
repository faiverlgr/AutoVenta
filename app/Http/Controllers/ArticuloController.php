<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//add
use App\Entities\Proveedor;
use App\Entities\Categoria; 
use App\Entities\Articulo;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ArticulosRequest;
use Illuminate\Support\Collection as Collection;
use DB;

class ArticuloController extends Controller
{
        /**
     * Responde a solicitud ajax para buscar caegorias de un proveedor.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxCate($idprov){
        $Categorias=DB::table('categorias')
        ->select('id', 'codcate', 'nomcate')
        ->where('estado', '=', 1)
        ->where('idprov', '=', $idprov)
        ->orderby('id', 'ASC')
        ->get();
        return Response::json($Categorias);
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
            
            $articulos=DB::table('articulos as a')
                ->join("proveedores as p", "a.idprov", "=", "p.id")
                ->join("categorias as c", "a.idcate", "=", "c.id")
                ->select('c.codcate', 'p.codprov', 'a.*', DB::raw('round(a.vneto + ((a.vneto*a.piva)/100),2) as pventa'), 'a.estado')
                ->where('nomarti', 'LIKE', '%'.$query.'%')
                ->orderBy('idprov', 'desc')
                ->orderBy('idcate', 'desc')
                ->orderBy('codarti', 'desc')
                ->paginate(10);
                //dd($articulos);
                return view('maestros.articulo.index', [
                    "articulos" => $articulos,
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
        
         return view('maestros.articulo.create', [
            "proveedores" => $proveedores
            ]
        );
        /*
        $gcodcates = DB::table('categorias as c')
        ->join("proveedores as p", "c.idprov", "=", "p.id")
        ->where('c.estado', '=', 1)
        ->select('p.id as idprov', 'p.codprov', 'p.razons', 'c.id as idcate', 'c.codcate', 'c.nomcate')
        ->orderby('c.idprov', 'ASC')
        ->get();

        //dd($gcodcates);
        return view('maestros.articulo.create', [
            "gcodcates" => $gcodcates
            ]
        );
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticulosRequest $request)
    {
        $articulo = new articulo;
        $articulo->idprov      = $request->get('idprov');
        $articulo->idcate      = $request->get('idcate');
        $articulo->codarti     = $request->get('codarti');
        $articulo->nomarti     = $request->get('nomarti');
        $articulo->nomartic    = $request->get('nomartic');
        $articulo->vcosto      = $request->get('vcosto');
        $articulo->vneto       = $request->get('vneto');
        $articulo->piva        = $request->get('piva');
        $articulo->pmargen     = $request->get('pmargen');
        $articulo->unidad      = $request->get('unidad');
        $articulo->minimo      = $request->get('minimo');
        $articulo->maximo      = $request->get('maximo');
        $articulo->embalaje    = $request->get('embalaje');
        $articulo->cbarras     = $request->get('cbarras');
        $articulo->estado      = 1;
        $articulo->save();
        //return back()->with('notification', 'Registro guardado exitosamente.');
        return Redirect::to('articulo');
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
        $articulo = Articulo::findOrFail($id);
        $query = DB::table('articulos as a')
            ->join('proveedores as p', 'p.idv', '=', 'a.idprov')
            ->join('categorias as c', [
                ['c.idprov', '=', 'a.idprov'],
                ['c.id', '=', 'a.idcate']])
            ->select('a.*', 'p.razons', 'c.nomcate')
            ->where('a.id', '=', $id)
            ->first();
        //dd($query);
        return view('maestros.articulo.edit', compact(['query', 'articulo']));
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
        $articulo = Articulo::FindOrFail($id);
        $articulo->nomarti  = $request->get('nomarti');
        $articulo->nomartic = $request->get('nomartic');
        $articulo->vcosto   = $request->get('vcosto');
        $articulo->vneto    = $request->get('vneto');
        $articulo->piva     = $request->get('piva');
        $articulo->pmargen  = $request->get('pmargen');
        $articulo->minimo   = $request->get('minimo');
        $articulo->maximo   = $request->get('maximo');
        $articulo->embalaje = $request->get('embalaje');
        $articulo->unidad   = $request->get('unidad');
        $articulo->unidad   = $request->get('unidad');
        $articulo->cbarras  = $request->get('cbarras');
        $articulo->update();
        //return back()->with('notification', 'Registro actualizado exitosamente.');
        //dd($articulo);
        return Redirect::to('articulo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulo::findOrFail($id);   
        if ($articulo->estado == 1) {
            $articulo->estado = 0;
        } else {
            $articulo->estado = 1;
        }
        $articulo->update();        
        return Redirect::to('articulo');
    }
}
