<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add
use App\Entities\Ingresen;
use App\Entities\Ingresde;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\IngresosRequest;
use Illuminate\Support\Collection as Collection;
use DB;

use Carbon\Carbon;
use Response;

class IngresenController extends Controller
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
            $ingresos=DB::table('ingresen as en')
                ->join('proveedores as pr', 'en.idprov', '=', 'pr.id')
                ->join('periodos as pe', 'en.idper', '=', 'pe.id')
                ->select('en.numdoc, en.estado, en.fecha, en.tcosto, en.tmargen, en.tventa, en.tiva, pr.razons, pe.anoper, pe.mesper, pe.estado')
                ->where('en.numdoc', 'LIKE', '%'.$query.'%')
                ->orderBy('en.id', 'desc')
                ->paginate(10);
            return view('movimientos.ingreso.index', [
                "ingresos"=>$ingresos,
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
    public function create($id)
    {
        $gcodcates = DB::table('articulos as c')
        ->join("proveedores as p", "c.codprov", "=", "p.codprov")
        ->where('c.estado', '=', 1, 'p.id', '=', $id)
        ->select('c.codprov', 'p.razons', 'c.codcate', 'c.nomcate')
        ->orderby('c.codprov', 'ASC')
        ->get();
        
        $proveedores = DB::table('proveedores')
            ->where('estado', '=', 1)
            ->select('codprov', 'razons')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
