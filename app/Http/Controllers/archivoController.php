<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Archivo;

use Laracasts\Flash\Flash;

use Auth;

use DB;

use Response;


class archivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function subidos(){
        $subidos = DB::table('archivo')
                        ->where('id_autor_fk', Auth::user()->indicador)
                        ->get();
        return view('empleado.archivos.subidos')->with('subidos', $subidos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

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
    public function destroy($id){
        $archivo = Archivo::find($id);
      $nombre = $archivo->nombre_original;
      $archivo->delete();

      if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Archivo "'.$nombre.'" eliminado');
        
            return redirect()->route('publico.index');
    }

    public function descargar($url){
        return Response::download('librerias/archivos/'.$url);
    }
}
