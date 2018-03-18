<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add
use App\Entities\Periodo;
use App\Entities\Ingresen;
use App\Entities\Ingresde;
use App\Entities\Kardex;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\IngresosRequest;
use Illuminate\Support\Collection as Collection;
use DB;

use Carbon\Carbon; //Carbon::now('America/Bogota')->toDateTimeString();
use Response;

class IngresenController extends Controller
{
    /**
     * Responde a solicitud ajax para buscar artículos de un proveedor.
     *
     * @return \Illuminate\Http\Response
     */
    public function selectArt($codprov){
        $articulos=DB::table('articulos')
        ->select('id', 'codcate', 'codarti', 'nomartic', 'vcosto', 'vneto', 'piva', 'pmargen')
        ->where('estado', '=', 1)
        ->where('codprov', '=', $codprov)
        ->orderby('codprov', 'ASC')
        ->get();
        return Response::json($articulos);
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
            $ingresos=DB::table('ingresen as en')
                ->join('proveedores as pr', 'en.idprov', '=', 'pr.id')
                ->select([
                    'pr.razons',
                    'en.id',
                    'en.numdoc',
                    'en.idper',
                    'en.numdoc',
                    'en.fecha',
                    'en.fechav',
                    'en.tcosto',
                    'en.tmargen',
                    'en.tventa',
                    'en.tiva',
                    'en.estado'])
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
    public function create()
    {
        $proveedores = DB::table('proveedores')
        ->select('id', 'codprov', 'razons')
        ->where('estado', '=', 1)
        ->get();

        $periodos = DB::table('periodos')
        ->select('id', 'anoper', 'mesper')
        ->where('estado', '=', 1)
        ->first();

        //return Response()->json($articulos);

        return view('movimientos.ingreso.create', [
            "proveedores" => $proveedores,
            "periodos" => $periodos
            ]
        );
        //dd($proveedores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngresosRequest $request)
    {
        try{
            DB::beginTransaction();
                $ingreso = New Ingresen;
                $ingreso->idper     = $request->get('idper');
                $ingreso->idprov    = $request->get('idprov');
                $ingreso->numdoc    = $request->get('numdoc');
                $ingreso->fecha     = $request->get('fecha');
                $ingreso->fechav    = Carbon::now('America/Bogota')->toDateTimeString();
                $ingreso->tcosto    = $request->get('tcosto');
                $ingreso->tmargen   = $request->get('tmargen');
                $ingreso->tventa    = $request->get('tventa');
                $ingreso->tiva      = $request->get('tiva');
                $ingreso->estado    = 1;
                $ingreso->save();            
                // detalle
                $ingreso->iden   = $request->get('iden');
                $idbod           = $request->get('idbod');
                $idarti          = $request->get('idarti');
                $cantidad        = $request->get('cantidad');
                $vcosto          = $request->get('vcosto');
                $vneto           = $request->get('vneto');
                $piva            = $request->get('piva');
                $vtotal          = $request->get('vtotal');
                $vtmarg          = $request->get('vtmarg');
                // array de articulos
                $idarti                 = $request->get('idarti');
                $cont                   = 0;
                while($cont < count($idarti)){
                    //detalle
                    $detalle = new Ingresde();
                    $detalle->iden      = $ingreso->id;
                    $detalle->idbod     = 1;
                    $detalle->idarti    = $idarti[$cont];
                    $detalle->cantidad  = $cantidad[$cont];
                    $detalle->vcosto    = $vcosto[$cont];
                    $detalle->vneto     = $vneto[$cont];
                    $detalle->piva      = $piva[$cont];
                    $detalle->vtotal    = $vtotal[$cont];
                    $detalle->vtmarg    = $vtmarg[$cont];
                    $detalle->save();
                    //kardex
                    $existe = DB::table('kardex')
                            ->where('idarticulo', '=', $detalle->idarti)
                            ->where('idperiodo', '=', $ingreso->idper)
                            ->where('idbodega', '=', $detalle->idbod)
                            ->first();
                    //valida existencia y crea en kardex caso negativo
                    if ($existe = 0) {
                        $kardex = new Kardex();
                        $kardex->idbodega   =   $detalle->idbod;
                        $kardex->idperiodo  =   $ingreso->idper;
                        $kardex->idarticulo =   $detalle->idarti;
                        $kardex->inicial    =   0;
                        $kardex->entradas   =   0;
                        $kardex->salidas    =   0;
                        $kardex->conteo1    =   0;
                        $kardex->conteo2    =   0;
                        $kardex->conteo3    =   0;
                        $kardex->vcosto     =   0;
                        $kardex->save();
                    }
                    //incrementa el valor con la cantidad
                    DB::table('kardex')
                        ->increment('entradas', $detalle->cantidad)
                        ->where('idarticulo', '=', $detalle->idarti)
                        ->where('idperiodo', '=', $ingreso->idper)
                        ->where('idbodega', '=', $detalle->idbod);
                    $cont = $cont+1;
                }
            DB::commit();
        }catch(\Exception $e)
        {
            DB::rollback();
        }
        return Redirect::to('/ingresen');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingreso=DB::table('ingresen as en')
        ->join('proveedores as pr', 'en.idprov', '=', 'pr.id')
        ->join('periodos as pe', 'en.idper', '=', 'pe.id')
        ->select('en.numdoc', 'pr.razons', 'en.idper', 'en.numdoc', 'en.fecha', 'en.fechav', 'en.tcosto', 'en.tmargen', 'en.tventa', 'en.tiva', 'en.estado', 'pe.anoper', 'pe.mesper', 'pe.estado')
        ->where('en.id', '=', $id)
        ->first();
        //detalle
        $detalle=DB::table('ingresde as de')
        ->join('ingresen as en', 'de.idingresen', '=', 'en.id')
        ->join('articulos as ar', 'de.idarti', '=', 'ar.id')
        ->where('de.idingresen', '=', $id)
        ->select('ar.codprov', 'ar.codcate', 'ar.codarti', 'ar.nomartic', 'de.cantidad', 'de.vcosto', 'de.vneto', 'de.piva', 'de.vtotal' , 'de.vtmargen')
        ->get();
        return view('movimientos.ingreso.show', [
            '$ingreso'   =>$ingreso,
            '$detalle'   =>$detalle
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
        $ingreso = Ingresen::findOrFail($id);   
        if ($ingreso->estado == 1) {
            $ingreso->estado = 0;
        } else {
            $ingreso->estado = 1;
        }
        $ingreso->update();        
        return Redirect::to('ingreso');
    }
}
