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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query=trim($request->get('searchText'));
            
            $articulos=DB::table('articulos')
                ->select('articulos.*', DB::raw('round(vneto + ((vneto*piva)/100),2) as pventa'), 'estado')
                ->where('nomarti', 'LIKE', '%'.$query.'%')
                ->orderBy('codprov', 'desc')
                ->orderBy('codcate', 'desc')
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
        $gcodcates = DB::table('categorias as c')
        ->join("proveedores as p", "c.codprov", "=", "p.codprov")
        ->where('c.estado', '=', 1)
        ->select('c.codprov', 'p.razons', 'c.codcate', 'c.nomcate')
        ->orderby('c.codprov', 'ASC')
        ->get();

        //dd($gcodcates);
        return view('maestros.articulo.create', [
            "gcodcates" => $gcodcates
            ]
        );
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
        $articulo->codprov     = $request->get('codprov');
        $articulo->codcate     = $request->get('codcate');
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
        $articulo = Articulo::findOrFail($id);
        $query = DB::table('articulos')
            ->join('proveedores', 'proveedores.codprov', '=', 'articulos.codprov')
            ->join('categorias', [['categorias.codprov', '=', 'articulos.codprov'], ['categorias.codcate', '=', 'articulos.codcate']])
            ->select('articulos.*', 'proveedores.razons', 'categorias.nomcate')
            ->where('articulos.id', '=', $id)
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
        return back()->with('notification', 'Registro actualizado exitosamente.');
        //dd($articulo);
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
