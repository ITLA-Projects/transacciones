<?php
require_once '../helpers/utilities.php';
require_once 'Transaccion.php';
require_once '../service/IServiceBase.php';
require_once 'TransaccionServiceFile.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';

$service = new TransaccionServiceFile();

//load array
$array = $service->getDirtyList();
array_unshift($array,array_keys((array) $array[0]));

//create directory if doesnt exists
if (!file_exists("../Downloads")) {
    mkdir("../Downloads",0777, true);
}

$file = fopen("../Downloads/dump.csv","w");
foreach ($array as $element) {
    fputcsv($file,(array) $element);
}
fclose($file);

// We'll be outputting a csv
header('Content-type: text/csv');

// It will be called downloaded.csv
header('Content-Disposition: attachment; filename="downloaded.csv"');

// The CSV source is in original.pdf
readfile('../Downloads/dump.csv');

?>