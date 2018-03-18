<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//agregados
use App\Entities\Categoria;
use App\Entities\Proveedor;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProveedoresRequest;
use Illuminate\Support\Collection as Collection;
use DB;

class ProveedorController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return view('Maestros.Proveedor.Index');
        if ($request) {
            $query=trim($request->get('searchText'));
            $proveedores=DB::table('proveedores')->where('razons', 'LIKE', '%'.$query.'%')
            ->orderBy('codprov', 'desc')
            ->paginate(10);
            
            $categorias=DB::table('categorias')->where('id', '=', '1')->get();
            
            return view('maestros.proveedor.index', [
                'proveedores'   =>$proveedores,
                'searchText'    =>$query,
                'categorias'    =>$categorias
                ]
            );
        };
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maestros.proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProveedoresRequest $request)
    {
        $proveedor=new Proveedor;
        $proveedor->codprov     = $request->get('codprov');
        $proveedor->nit         = $request->get('nit');
        $proveedor->razons      = $request->get('razons');
        $proveedor->sigla       = $request->get('sigla');
        $proveedor->direccion   = $request->get('direccion');
        $proveedor->telefono1   = $request->get('telefono1');
        $proveedor->telefono2   = $request->get('telefono2');
        $proveedor->email       = $request->get('email');
        $proveedor->estado      = '1';
        $proveedor->save();
        return back()->with('notification', 'Registro guardado exitosamente.');
        
        // return Redirect::to('proveedor')
        //     ->with('notification', 'Registro guardado exitosamente.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {       
        if ($request->ajax()) {
            $categorias=DB::table('categorias')->where('codprov', '=', $id)
            ->orderBy('codcate', 'asc');
            return response()->json([
                'categorias'    => $categorias,
                'mensaje'       => 'Búsqueda completada',
                ]
            );
        }

        // return view('maestros.proveedor.show', [
        //     'proveedor'=>Proveedor::findOrFail($id)
        //     ]
        // );
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('maestros.proveedor.edit', compact('proveedor'));
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
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->nit         = $request->get('nit');
        $proveedor->razons      = $request->get('razons');
        $proveedor->sigla       = $request->get('sigla');
        $proveedor->direccion   = $request->get('direccion');
        $proveedor->telefono1   = $request->get('telefono1');
        $proveedor->telefono2   = $request->get('telefono2');
        $proveedor->email       = $request->get('email');
        $proveedor->update();
        return Redirect::to('proveedor');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);   
        if ($proveedor->estado == 1) {
            $proveedor->estado = 0;
        } else {
            $proveedor->estado = 1;
        }
        $proveedor->update();        
        return Redirect::to('proveedor');
    }
}
