<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add
use App\Entities\Periodo;
use App\Entities\Ajusten;
use App\Entities\Ajustde;
use App\Entities\TipoAjuste;
use App\Entities\Conceptos;
use App\Entities\Kardex;
use App\Http\Requests\AjustesRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection as Collection;
use DB;
use Carbon\Carbon; //Carbon::now('America/Bogota')->toDateTimeString();
use Response;

class AjustenController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selconcepto($item)
    {
        //busca conceptos activos para el tipo
        $query = DB::table('conceptos as co')
        ->join('tipoajustes as ta', 'co.id', 'ta.id')
        ->select('co.id', 'co.nombre')
        ->where('co.tipo', '=', $item)
        ->get();
        return Response::json($query);
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
            $ajustes=DB::table('ajusten as en')
                ->join('conceptos as co', 'en.idconcepto', '=', 'co.id')
                ->join('tipoajustes as ta', 'co.tipo', '=', 'ta.id')
                ->select([
                    'en.id',
                    'ta.nombre as nomtipo',
                    'co.nombre',
                    'en.fecha',
                    'en.tcosto',
                    'en.tventa',
                    'en.tiva',
                    'en.estado'])
                ->where('co.nombre', 'LIKE', '%'.$query.'%')
                ->orderBy('en.id', 'desc')
                ->paginate(10);
            return view('movimientos.ajuste.index', [
                "ajustes"=>$ajustes,
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
    public function create()
    {
        $tipo = DB::table('tipoajustes as ta')
        ->select('id', 'nombre')
        ->where('ta.estado', '=', 1)
        ->get();

        //busca el primer tipo activo para con base en ese buscar la lista de conceptos a cargar con la pantalla
        $tip_act = $tipo->first();

        //busca conceptos activos para el tipo
        $conceptos = DB::table('conceptos as co')
        ->join('tipoajustes as ta', 'co.id', 'ta.id')
        ->select('co.id', 'co.nombre')
        ->where('co.tipo', '=', $tip_act->id)
        ->where('co.estado', '=', 1)
        ->get();

        //busca período actual
        $periodo = DB::table('periodos as pe')
        ->select('id', 'anoper', 'mesper')
        ->where('pe.estado', '=', 1)
        ->first();

        $articulos = DB::table('articulos as a')
        ->join('proveedores as p' , 'p.id', 'a.idprov')
        ->join('categorias as c', 'c.id', 'a.idcate')
        ->leftjoin('kardex as k', 'a.id', 'k.idarticulo')
        ->select('a.id', 'p.codprov', 'c.codcate', 'a.codarti', 'a.nomartic', 'a.vcosto', 'a.vneto', 'a.piva', DB::raw('k.inicial + k.entradas - k.salidas as stock'))
        ->where('a.estado', '=', 1)
        ->orderby('p.codprov', 'ASC')
        ->orderby('c.codcate', 'ASC')
        ->orderby('a.codarti', 'ASC')
        ->get();
        //dd($articulos);
        return view('movimientos.ajuste.create',[
            'tipo'      => $tipo,
            'conceptos' => $conceptos,
            'periodo'   => $periodo,
            'articulos' => $articulos
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AjustesRequest $request)
    {
        try{
            DB::beginTransaction();
                $encabezado = New Ajusten;
                $encabezado->idper      = (int)$request->get('idper');
                $encabezado->idtipo     = (int)$request->get('idtipo');
                $encabezado->idconcepto = (int)$request->get('idconcepto');
                $encabezado->fecha      = $request->get('fecha');
                $encabezado->tcosto     = $request->get('tcosto');
                $encabezado->tventa     = $request->get('tventa');
                $encabezado->tiva       = $request->get('tiva');
                $encabezado->estado     = 1;
                $encabezado->save();
                // detalle
                //$encabezado->idajen = (int)$request->get('idajen');
                $idbod              = $request->get('idbod');
                $idarti             = $request->get('idarti');
                $cantidad           = $request->get('cantidad');
                $vcosto             = $request->get('vcosto');
                $vneto              = $request->get('vneto');
                $piva               = $request->get('piva');
                $vtotal             = $request->get('vtotal');
                // array de articulos
                $cont          = 0;
                $nItemsArray = count($idarti);
                while($cont < $nItemsArray){
                    //detalle
                    $detalle = new Ajustde();
                    $detalle->idajen   = $encabezado->id;
                    $detalle->idbod    = 1;
                    $detalle->idarti   = (int)$idarti[$cont];
                    $detalle->cantidad = (int)$cantidad[$cont];
                    $detalle->vcosto   = $vcosto[$cont];
                    $detalle->vneto    = $vneto[$cont];
                    $detalle->piva     = $piva[$cont];
                    $detalle->vtotal   = $vtotal[$cont];
                    $detalle->save();
                    //kardex
                    $existe = DB::table('kardex')
                        ->where('idarticulo', '=', $detalle->idarti)
                        ->where('idperiodo', '=', $encabezado->idper)
                        ->where('idbodega', '=', $detalle->idbod)
                        ->first();
                    //valida existencia y crea en kardex caso negativo
                    if (empty($existe)) {
                        $kardex = new Kardex();
                        $kardex->idbodega   = $detalle->idbod;
                        $kardex->idperiodo  = $encabezado->idper;
                        $kardex->idarticulo = $detalle->idarti;
                        $kardex->inicial    = 0;
                        // si es entrada o salida
                        if ($encabezado->idtipo = 1) {
                            $kardex->entradas   = $detalle->cantidad;
                            $kardex->salidas = 0;
                        } else {
                            $kardex->salidas    = $detalle->cantidad;
                            $kardex->entradas = 0;
                        }
                        $kardex->conteo1    = 0;
                        $kardex->conteo2    = 0;
                        $kardex->conteo3    = 0;
                        $kardex->vcosto     = 0;
                        $kardex->save();
                    }
                    else{
                        //incrementa el valor con la cantidad
                        // si es entrada o salida
                        if ($encabezado->tipo = 1) {
                            DB::table('kardex')
                            ->where('idarticulo', '=', $detalle->idarti)
                            ->where('idperiodo', '=', $encabezado->idper)
                            ->where('idbodega', '=', $detalle->idbod)
                            ->increment('entradas', $detalle->cantidad);
                        } else {
                            DB::table('kardex')
                            ->where('idarticulo', '=', $detalle->idarti)
                            ->where('idperiodo', '=', $encabezado->idper)
                            ->where('idbodega', '=', $detalle->idbod)
                            ->increment('salidas', $detalle->cantidad);
                        }
                    }
                    $cont = $cont+1;
                }
            DB::commit();
        }catch(\Exception $e)
        {
            DB::rollback();
                    }
        return Redirect::to('/ajusten');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $encabezado=DB::table('ajusten as en')
        ->join('tipoajustes as ta', 'en.tipo', '=', 'ta.id')
        ->join('periodos as pe', 'en.idper', '=', 'pe.id')
        ->join('conceptos as co', 'en.idconcepto', '=', 'co.id')
        ->select('ta.nombre as nomtipo', 'co.nombre as concepto', 'en.fecha', 'pe.anoper', 'pe.mesper', 'en.tcosto', DB::raw('(en.tventa - en.tiva) as tneto'), 'en.tiva', 'en.tventa', 'en.estado')
        ->where('en.id', '=', $id)
        ->first();
        //detalle
        $detalle=DB::table('ajustde as de')
        ->join('ajusten as en', 'de.idajen', '=', 'en.id')
        ->join('articulos as a', 'de.idarti', '=', 'en.idarti')
        ->join('proveedores as p', 'a.idprov', '=', 'p.id')
        ->join('categorias as c', 'a.idcate', '=', 'c.id')
        ->where('de.idajen', '=', $id)
        ->select('p.codprov', 'c.codcate', 'a.codarti', 'a.nomartic', 'de.cantidad', 'de.vcosto', 'de.vneto', 'de.piva', 'de.vtotal', DB::raw('(de.vneto * de.cantidad) as vtneto'))
        ->get();
        //dd($detalle);
        
        return view('movimientos.ingreso.show', [
            'encabizado' => encabezado,
            'detalle'    => $detalle
            ]
        );
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
