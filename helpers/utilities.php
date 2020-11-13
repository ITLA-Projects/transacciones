<?php

class utilities{

    public $carrera = [1=>"Redes",2=>"Software",3=>"Multimedia",4=>"Mecatronica",5=>"Seguridad Informatica"];

    public function getLastElement($list){
        $countList = count($list);
    
        $lastElement = $list[$countList -1];
    
        return $lastElement;
    }
       
    public function searchProperty($list,$property,$value){
        $filter = [];
    
        foreach ($list as $item) {
            if($item->$property == $value){
                array_push($filter,$item);
            }
        }
        return $filter;
    }
    
    public function getIndexElement($list,$property,$value){
        $index = 0;
    
        foreach ($list as $key => $item) {
            if($item->$property == $value){
                $index = $key;
            }
        }
        return $index;
    }

    public function GetCookieTime(){
        return time() + 60*60*24*30;
    }

    public function subirFoto($directory,$name,$tmpFile,$type,$size){
        $isSuccess = false;

        if($type == "image/gif"
        || $type == "image/jpeg" 
        || $type == "image/png" 
        || $type == "image/JPG" 
        || $type == "image/jpg"
        || $type == "image/pjpeg" && $size < 1000000){


            if(!file_exists($directory)){
                mkdir($directory,0777,true);

                if(file_exists($directory)){

                    $this->uploadFile($directory . $name,$tmpFile);
                    $isSuccess = true;
                }
            }else{
                $this->uploadFile($directory . $name,$tmpFile);
                $isSuccess = true;
            }
        }else{
            $isSuccess=false;
        }
        return $isSuccess;
    }

    private function uploadFile($name,$tmpFile){
        if(file_exists($name)){
            unlink($name);
        }

        move_uploaded_file($tmpFile,$name);
    }
}



?>