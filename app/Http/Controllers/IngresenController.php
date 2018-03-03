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
                ->join('ingresde as de', 'en.id', '=', 'de.idingresen')
                ->select('en.numdoc', 'pr.razons', 'en.idper', 'en.numdoc', 'en.fecha', 'en.fechav', 'en.tcosto', 'en.tmargen', 'en.tventa', 'en.tiva', 'en.estado', 'pe.anoper', 'pe.mesper', 'pe.estado')
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
        $articulos = DB::table('articulos as ar')
        ->where('ar.estado', '=', 1)
        ->select('ar.id', 'ar.codarti', 'ar.nomartic', 'ar.vcosto', 'ar.vneto', 'ar.piva', 'ar.pmargen')
        ->orderby('ar.codprov', 'ASC')
        ->get();
        
        $proveedores = DB::table('proveedores')
        ->select('id', 'codprov', 'razons')
        ->where('estado', '=', 1)
        ->get();

        $periodos = DB::table('periodos')
        ->select('anoper', 'mesper')
        ->where('estado', '=', 1)
        ->first();

        //return Response()->json($articulos);

        return view('movimientos.ingreso.create', [
            "proveedores" => $proveedores,
            "periodos" => $periodos,
            "articulos" => $articulos
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
                $mytime = Carbon::now('America/Bogota');
                $ingreso->fecha     = $mytime->todDateTimeString();
                $ingreso->fechav    = $request->get('fechav');
                $ingreso->tcosto    = $request->get('tcosto');
                $ingreso->tmargen   = $request->get('tmargen');
                $ingreso->tventa    = $request->get('tventa');
                $ingreso->tiva      = $request->get('tiva');
                $ingreso->estado    = 1;
                $ingreso->save();            
                // detalle
                $ingreso->idingresen    = $request->get('idingresen');
                $idbod                  = $request->get('idbod');
                $idarti                 = $request->get('idarti');
                $cantidad               = $request->get('cantidad');
                $vcosto                 = $request->get('vcosto');
                $vneto                  = $request->get('vneto');
                $piva                   = $request->get('piva');
                $vtotal                 = $request->get('vtotal');
                $vtmarg                 = $request->get('vtmarg');
                $cont                   = 0;
                while($cont < count($idarticulo)){
                    //detalle
                    $detalle = new Ingresde();
                    $detalle->idingresen = $ingreso->idingresen;
                    $detalle->idbod      = 1;
                    $detalle->idarti     = $idarti[$cont];
                    $detalle->cantidad   = $cantidad[$cont];
                    $detalle->vcosto     = $vcosto[$cont];
                    $detalle->vneto      = $vneto[$cont];
                    $detalle->piva       = $piva[$cont];
                    $detalle->vtotal     = $vtotal[$cont];
                    $detalle->vtmarg     = $vtmarg[$cont];
                    $detalle->save();
                    //kardex
                    $kardex = 0; //revisa si existe en la tabla
                    $kardex = DB::table('kardex')
                        ->where('idbodega', $idbod[$cont])
                        ->where('idperiodo', $request->get('idper'))
                        ->where('idarticulo', $idarti[$cont])
                        ->count();
                        // si no existe crea el item para el periodo, bidega y artículo.
                    if ($kardex = 0) {
                        $new = new Kardex();
                        $new->idbodega      = $idbod[$cont];
                        $new->idperiodo     = $request->get('idper');
                        $new->idarticulo    = $idarti[$cont];
                        $new->inicial       = 0;
                        $new->entradas      = $cantidad[$cont];
                        $new->salidas       = 0;
                        $new->vcosto        = $vcosto[$cont];
                        $kardex->save();
                        // si ya existe 
                    } else {
                        DB::table('kardex')
                            ->where('idbodega', $idbod[$cont])
                            ->where('idperiodo', $request->get('idper'))
                            ->where('idarticulo', $idarti[$cont])
                            ->increment('entradas', $cantidad[$cont]);
                    }
                    $cont = $cont+1;
                }
            DB::commit();
        }catch(\Exception $e)
        {
            DB::rollback();
        }
        return Redirect::to('movimientos/ingreso/index');
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
