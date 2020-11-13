<?php

class Transaccion{


    public $id;
    public $fecha;
    public $monto;
    public $descripcion;

    public function __construct(){
    }

    public function initializeData($id,$fecha,$monto,$descripcion){
        $this->id = $id;
        $this->fecha = $fecha;
        $this->monto = $monto;
        $this->descripcion = $descripcion;
    }

    public function set($data){
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

}

?>