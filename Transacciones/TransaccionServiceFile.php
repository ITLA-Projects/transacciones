<?php

class TransaccionServiceFile implements IServiceBase
{
    private $utilities;
    public $filehandler;
    public $directory;
    public $filename;

    public function __construct($outside = false)
    {
        if (!$outside) {
            $this->directory = "data";
        } else {
            $this->directory = "Transacciones/data";
        }

        $this->utilities = new Utilities();

        $this->filename = "transaccion";

        $this->filehandler = new JsonFileHandler($this->directory, $this->filename);
    }

    public function GetList()
    {
        
    
            $listadoDeTransaccionesDecoded = $this->filehandler->ReadFile();
        
        $listadoTransaccionesLimpio = array();

        if ($listadoDeTransaccionesDecoded == false) {
            $this->filehandler->SaveFile($listadoTransaccionesLimpio);
        } else {
            foreach ($listadoDeTransaccionesDecoded as $elementDecode) {
                $element = new Transaccion();
                $element->set($elementDecode);

                array_push($listadoTransaccionesLimpio, $element);
            }
        }

        return $listadoTransaccionesLimpio;
    }

    public function GetById($id)
    {
        $listadoTransaccions = $this->GetList();
        $transaccion = $this->utilities->searchProperty($listadoTransaccions, 'id', $id)[0];
        return $transaccion;
    }

    public function Add($entity)
    {

        $listadoDeTransacciones = $this->GetList();

        $transaccionId = 1;

        if (!empty($listadoDeTransacciones)) {
            $ultimaTransaccion = $this->utilities->getLastElement($listadoDeTransacciones);
            $transaccionId = $ultimaTransaccion->id + 1;
        }

        $entity->id = $transaccionId;

        array_push($listadoDeTransacciones, $entity);

        $this->filehandler->SaveFile($listadoDeTransacciones);
    }

    public function Update($id, $entity)
    {
        $element = $this->GetById($id);
        $listadoDeTransacciones = $this->GetList();

        $elementIndex = $this->utilities->getIndexelement($listadoDeTransacciones, 'id', $id);

        $listadoDeTransacciones[$elementIndex] = $entity;

        $this->filehandler->SaveFile($listadoDeTransacciones);
    }

    public function Delete($id)
    {
        $listadoDeTransacciones = $this->GetList();
        $elementIndex = $this->utilities->getIndexelement($listadoDeTransacciones, 'id', $id);

        unset($listadoDeTransacciones[$elementIndex]);

        $listadoDeTransacciones = array_values($listadoDeTransacciones);

        $this->filehandler->SaveFile($listadoDeTransacciones);
    }

    public function addOutside($element){

        $this->filehandler->SaveFile($element);
    }

    public function getDirtyList(){
         return $this->filehandler->ReadFile();
    }
}
