<?php
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'Transaccion.php';
require_once '../service/IServiceBase.php';
require_once 'TransaccionServiceFile.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';


$layout = new Layout(true);
$utilities = new Utilities();
$service = new TransaccionServiceFile();

if (isset($_POST['archivo'])) {

    $listadoTransaccions = $service->GetList(true,$_POST['archivo']['tmp_name']);

    header("Location: ../index.php");
    exit();
}

?>