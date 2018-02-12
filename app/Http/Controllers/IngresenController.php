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
    public function create($id)
    {
        $gcodcates = DB::table('articulos as c')
        ->join("proveedorews as p", "c.codprov", "=", "p.codprov")
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
            $ingreso->idingresen = $request->get('idingresen');
            $idbod      = $request->get('idbod');
            $idarti     = $request->get('idarti');
            $cantidad   = $request->get('cantidad');
            $vcosto     = $request->get('vcosto');
            $vneto      = $request->get('vneto');
            $piva       = $request->get('piva');
            $vtotal     = $request->get('vtotal');
            $vtmarg     = $request->get('vtmarg');

            $cont = 0;

            while($cont < count($idarticulo)){
                $detalle = new Ingresde();
                $detalle->idingresen = $ingreso->idingresen;
                $detalle->idbod      = $idbod[$cont];
                $detalle->idarti     = $idarti[$cont];
                $detalle->cantidad   = $cantidad[$cont];
                $detalle->vcosto     = $vcosto[$cont];
                $detalle->vneto      = $vneto[$cont];
                $detalle->piva       = $piva[$cont];
                $detalle->vtotal     = $vtotal[$cont];
                $detalle->vtmarg     = $vtmarg[$cont];
                $detalle->save();
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
        
        $ingreso=DB::table('ingresde as de')
        ->join('articulos as ar', 'de.idarti', '=', 'ar.id')
        ->where('de.idingresen', '=', $id)
        ->select('de.codprov', 'de.codcate', 'de.codarrti', 'de.nomartic', 'de.cantidad', 'de.vcosto', 'de.vneto', 'de.piva', 'de.vtotal' , 'de.vtmargen')
        ->first();

        // revisar nombre de campos tabla detalle y revisar si debe contener columna valor unitario de venta

        return Redirect::to('movimientos/ingreso/show');
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
