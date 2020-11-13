<?php 

class TransaccionServiceCookies implements IServiceBase{
    private $utilities;
    private $cookieName;

    public function __construct(){
        $this->utilities = new Utilities();
        $this->cookieName = "transacciones";
    }

    public function GetList(){
        $listadoTransaccions = array();

        if(isset($_COOKIE[$this->cookieName])){

            $listadoTransaccionsDecode = json_decode($_COOKIE[$this->cookieName],false);

            foreach ($listadoTransaccionsDecode as $elementDecode) {
                $element = new Transaccion();
                $element->set($elementDecode);

                array_push($listadoTransaccions,$element);
            }

        }else{
            setcookie($this->cookieName,json_encode($listadoTransaccions),$this->utilities->GetCookieTime(),"/");
        }

        return $listadoTransaccions;
    }

    public function GetById($id){
        $listadoTransaccions = $this->GetList();
        $transaccion = $this->utilities->searchProperty($listadoTransaccions,'id',$id)[0];
        return $transaccion;
    }

    public function Add($entity){

        $listadoTransaccions = $this->GetList();

        $transaccionId = 1;

        if(!empty($listadoTransaccions)){
            $ultimoTransaccion = $this->utilities->getLastElement($listadoTransaccions);
            $transaccionId = $ultimoTransaccion->id + 1;
        }

        $entity->id = $transaccionId;
        $entity->foto = "";

        if(isset($_FILES['foto'])){

                $typeReplace = str_replace("image/","",$_FILES['foto']['type']);
                $type = $_FILES['foto']['type'];
                $size = $_FILES['foto']['size'];
                $name = $transaccionId . '.' . $typeReplace;
                $tmpname = $_FILES['foto']['tmp_name'];
                $success = $this->utilities->subirFoto('../assets/images/transacciones/',$name,$tmpname,$type,$size);

                if($success){
                    $entity->foto = $name;
                }

            


        }

        array_push($listadoTransaccions,$entity);

        setcookie($this->cookieName,json_encode($listadoTransaccions),$this->utilities->GetCookieTime(),"/");
    }

    public function Update($id,$entity){
        $element = $this->GetById($id);
        $listadoTransaccions = $this->GetList();

        $elementIndex = $this->utilities->getIndexelement($listadoTransaccions,'id',$id);

        //foto
        if(isset($_FILES['foto'])){

            $photoFile = $_FILES['foto'];

            if($photoFile['error'] == 4){
                $entity->foto = $element->foto;
            }else{
                $typeReplace = str_replace("image/","",$photoFile['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $name = $id . '.' . $typeReplace;
                $tmpname = $photoFile['tmp_name'];
    
                $success = $this->utilities->subirFoto('../assets/images/transacciones/',$name,$tmpname,$type,$size);
    
                if($success){
                    $entity->foto = $name;
                }
            }


        }

        //fin foto

        $listadoTransaccions[$elementIndex] = $entity;

        setcookie($this->cookieName,json_encode($listadoTransaccions),$this->utilities->GetCookieTime(),"/");

    }

    public function Delete($id){
        $listadoTransaccions = $this->GetList();
        $elementIndex = $this->utilities->getIndexelement($listadoTransaccions,'id',$id);

        unset($listadoTransaccions[$elementIndex]);

        $listadoTransaccions = array_values($listadoTransaccions);

        setcookie($this->cookieName,json_encode($listadoTransaccions),$this->utilities->GetCookieTime(),"/");
    }
}

?>