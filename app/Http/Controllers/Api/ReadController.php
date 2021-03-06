<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\LogicasDelNegocio\LNReads;
use App\Http\Requests\StoreRead;
use Illuminate\Http\Request;
use App\Http\LogicasDelNegocio\LNMediciones;

class ReadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $LNMediciones = new LNMediciones();

        return response([
            'mediciones'=>$LNMediciones->obtenerTodasLasMediciones(),
            'success' => 1
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $LNMediciones = new LNReads();

        $medicionCreada = $LNMediciones->guardarRead($request->user_id,$request->device_id,$request->latitude,$request->longitude,$request->type_read, $request->value,$request->date);

        if ($medicionCreada){
            return response([
                'message' => 'Medicion creada correctamente!',
                'medicion' => $medicionCreada[1],
                'success' => 1
            ]);
        }else{
            return response([
                'message' => 'Error! No se ha podido crear la medición',
                'success' => 0
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $LNMediciones = new LNReads();
        $medicion = $LNMediciones->obtenerReads($id);

        if($medicion[0]){
            return response([
               'medicion' => $medicion[1],
                'success'=> 1
            ]);
        }else{
            return response([
                'message' => 'Error! No se ha encontrado la medicion.',
                'success' => 0
            ]);
        }
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
        $LNMediciones = new LNReads();

        $medicionActualizada = $LNMediciones->actualizarDatosRead($id,$request);

        if($medicionActualizada[0]){
            return response([
                'message'=>'Se ha actualizado la medicion correctamente',
                'success' => 1
            ]);
        }else{
            return response([
                'message' => 'Se ha producido un error y no se ha podido actualizar la medición',
                'success'=>0
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $LNMediciones = new LNReads();

        $medicionEliminada = $LNMediciones->eliminarRead($id);

        if($medicionEliminada){
            return response([
                'message' => 'Se ha eliminado correctamente la medicion',
                'success' => 1
            ]);
        }else{
            return response([
                'message' => 'Error! No se ha podido eliminar la medicion',
                'success' => 0
            ]);
        }
    }

    /*public function obtenerUltimasMediciones($nMediciones){
        $LNMediciones = new LNReads();
        return response([
            'mediciones' => $LNMediciones->obtenerUltimasReads($nMediciones),
            'success' => 1
        ]);
    }*/
}
