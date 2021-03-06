<?php


namespace App\Http\LogicasDelNegocio;
use App\Models\Read;
use Illuminate\Http\Request;


class LNReads
{
    public function guardarRead($user_id, $device_id, $latitude, $longitude,$type_read, $value, $date){
        //Crear una instancia del modelo vacío
        $read=new Read();
        $read->user_id=$user_id;
        $read->device_id=$device_id;
        $read->latitude=$latitude;
        $read->longitude=$longitude;
        $read->type_read=$type_read;
        $read->value=$value;
        $read->date=$date;

        $read->save();

        if($read){
            return [1,$read];
        }else{
            return [0];
        }
    }

    public function eliminarRead($id){
        $read=Read::find($id);

        if($read){
            $read->delete();
            return 1;
        }else{
            return 0;
        }
    }

    public function obtenerTodosLosReads(){
        $read=Read::all();
    }

    public function obtenerReads($id){
        $read=Read::find($id);

        if($read){
            return [1,$read];
        }else{
            return [0];
        }
    }

    public function actualizarDatosRead($id, Request $request){
        $read=Read::find($id);
        if($read){
            $read->user_id=$request->user_id;
            $read->device_id=$request->device_id;
            $read->latitude=$request->latitude;
            $read->longitude=$request->longitude;
            $read->type_read=$request->type_read;
            $read->value=$request->value;
            $read->date=$request->date;

            $read->save();

            return[1,$read];
        }else{
            return [0];
        }
    }
    /*public function obtenerUltimasReads($nMediciones){
        return Read::latest()->take($nMediciones)->get();
    }*/
}
