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
    public function articulosIngreso($codprov){
        $articulos=DB::table('articulos as a')
        ->join('proveedores as p', 'a.idprov', 'p.id')
        ->join('categorias as c', 'a.idcate', 'c.id')
        ->select('a.id', 'c.codcate', 'a.codarti', 'a.nomartic', 'a.vcosto', 'a.vneto', 'a.piva', 'a.pmargen')
        ->where('a.estado', '=', 1)
        ->where('a.idprov', '=', $codprov)
        ->orderby('a.idprov', 'ASC')
        ->get();
        return Response::json($articulos);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
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
    public function create(){
        $proveedores = DB::table('proveedores')
        ->select('id', 'codprov', 'razons')
        ->where('estado', '=', 1)
        ->get();

        $periodos = DB::table('periodos')
        ->select('id', 'anoper', 'mesper')
        ->where('estado', '=', 1)
        ->first();

        //return Response()->json($articulos);

        //busca el id del primer  proveedor activo
        $idProvActivo = DB::table('proveedores')
        ->select('id')
        ->take(1)
        ->where('estado', '=', 1)
        ->first();
        
        $param = $idProvActivo->id;

        //selecciona por defecto los items del proveedor activo cargado
        $articulos=DB::table('articulos as a')
        ->join('proveedores as p' , 'p.id', 'a.idprov')
        ->join('categorias as c', 'c.id', 'a.idcate')
        ->select('a.id', 'c.codcate', 'a.codarti', 'a.nomartic', 'a.vcosto', 'a.vneto', 'a.piva', 'a.pmargen')
        ->where('a.estado', '=', 1)
        ->where('a.idprov', '=', $param)
        ->orderby('c.codcate', 'ASC')
        ->orderby('a.codarti', 'ASC')
        ->get();

        return view('movimientos.ingreso.create', [
            "proveedores"   => $proveedores,
            "periodos"      => $periodos,
            "articulos"     => $articulos
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
    public function store(IngresosRequest $request){
        try{
            DB::beginTransaction();
                $ingreso = New Ingresen;
                $ingreso->idper   = (int)$request->get('idper');
                $ingreso->idprov  = (int)$request->get('idprov');
                $ingreso->numdoc  = $request->get('numdoc');
                $ingreso->fecha   = $request->get('fecha');
                $ingreso->fechav  = Carbon::now('America/Bogota')->toDateTimeString();
                $ingreso->tcosto  = $request->get('tcosto');
                $ingreso->tmargen = $request->get('tmargen');
                $ingreso->tventa  = $request->get('tventa');
                $ingreso->tiva    = $request->get('tiva');
                $ingreso->estado  = 1;
                $ingreso->save();            
                // detalle
                $ingreso->iden = (int)$request->get('iden');
                $idbod         = $request->get('idbod');
                $idarti        = $request->get('idarti');
                $cantidad      = $request->get('cantidad');
                $vcosto        = $request->get('vcosto');
                $vneto         = $request->get('vneto');
                $piva          = $request->get('piva');
                $vtotal        = $request->get('vtotal');
                $vtmarg        = $request->get('vtmarg');
                // array de articulos
                $cont          = 0;
                $nItemsArray = count($idarti);
                while($cont < $nItemsArray){
                    //detalle
                    $detalle = new Ingresde();
                    $detalle->iden     = $ingreso->id;
                    $detalle->idbod    = 1;
                    $detalle->idarti   = (int)$idarti[$cont];
                    $detalle->cantidad = (int)$cantidad[$cont];
                    $detalle->vcosto   = $vcosto[$cont];
                    $detalle->vneto    = $vneto[$cont];
                    $detalle->piva     = $piva[$cont];
                    $detalle->vtotal   = $vtotal[$cont];
                    $detalle->vtmarg   = $vtmarg[$cont];
                    $detalle->save();
                    //kardex
                    $existe = DB::table('kardex')
                        ->where('idarticulo', '=', $detalle->idarti)
                        ->where('idperiodo', '=', $ingreso->idper)
                        ->where('idbodega', '=', $detalle->idbod)
                        ->first();
                    //valida existencia y crea en kardex caso negativo
                    if (empty($existe)) {
                        $kardex = new Kardex();
                        $kardex->idbodega   = $detalle->idbod;
                        $kardex->idperiodo  = $ingreso->idper;
                        $kardex->idarticulo = $detalle->idarti;
                        $kardex->inicial    = 0;
                        $kardex->entradas   = $detalle->cantidad;
                        $kardex->salidas    = 0;
                        $kardex->conteo1    = 0;
                        $kardex->conteo2    = 0;
                        $kardex->conteo3    = 0;
                        $kardex->vcosto     = 0;
                        $kardex->save();
                    }
                    else{
                        //incrementa el valor con la cantidad
                        DB::table('kardex')
                        ->where('idarticulo', '=', $detalle->idarti)
                        ->where('idperiodo', '=', $ingreso->idper)
                        ->where('idbodega', '=', $detalle->idbod)
                        ->increment('entradas', $detalle->cantidad);
                    }
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
        ->join('proveedores as p', 'p.id', '=', 'en.idprov')
        ->join('periodos as pe', 'pe.id', '=', 'en.idper')
        ->select('en.numdoc', 'p.razons', 'en.numdoc', 'en.fecha', 'en.fechav', 'en.tcosto', 'en.tventa', DB::raw('(en.tventa - en.tiva) as tneto'), 'en.tiva', 'en.estado', 'pe.anoper', 'pe.mesper')
        ->where('en.id', '=', $id)
        ->first();
        //detalle
        $detalle=DB::table('ingresde as de')
        ->join('ingresen as en', 'en.id', '=', 'de.iden')
        ->join('articulos as a', 'a.id', '=', 'de.idarti')
        ->join('categorias as c', 'c.id', '=', 'a.idcate')
        ->join('proveedores as p', 'p.id', '=', 'a.idprov')
        ->where('de.iden', '=', $id)
        ->select('p.codprov', 'c.codcate', 'a.codarti', 'a.nomartic', 'de.cantidad', 'de.vcosto', 'de.vneto', 'de.piva', 'de.vtotal', DB::raw('(de.vneto * de.cantidad) as vtneto'))
        ->get();
        
        
        //dd($detalle);
        
        return view('movimientos.ingreso.show', [
            'ingreso' => $ingreso,
            'detalle' => $detalle
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
    public function update(Request $request, $id){
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
