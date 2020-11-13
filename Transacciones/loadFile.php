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




if (isset($_FILES['file'])) {

    //que haga esto??
    $typeReplace = "";

    if (strpos($_FILES['file']['type'], "application/json") !== false) {
        //its type json
        $typeReplace = "json";
    } else if (strpos($_FILES['file']['type'], "text/csv") !== false) {
        //its type csv
        $typeReplace = "csv";
    }

    //subir archivo
    $type = $_FILES['file']['type'];
    $size = $_FILES['file']['size'];
    $name = 'load.' . $typeReplace;
    $tmpname = $_FILES['file']['tmp_name'];
    $success = $utilities->subirArchivo('../tempfiles/', $name, $tmpname, $type, $size);
    //

    //deserializarlo si es csv
    if ($typeReplace === "csv") {

        $mynewarray = array();
        //load file from csv
        $fil = file("../tempfiles/load.csv");
        //foreach array csv
        array_shift($fil);
        foreach ($fil as $stringline) {
            $arrayline = explode(",", $stringline);
            //each line, convert as a new transaccion
            $nuevaTransaccion = new Transaccion();

            $nuevaTransaccion->initializeData(
                $arrayline[0],
                $arrayline[1],
                $arrayline[2],
                $arrayline[3],
            );
            array_push($mynewarray, $nuevaTransaccion);
        }
        var_dump($mynewarray);
        $service->addOutside($mynewarray);

    } else if ($typeReplace === "json") {
        //deserializarlo si es JSON
        $file = fopen("../tempfiles/load.json", "r");
        $contents = fread($file, filesize("../tempfiles/load.json"));
        fclose($file);
        $service->addOutside(json_decode($contents));
    }







    header("Location: ../index.php");
    exit();

}

?>

<?php $layout->printHeader(); ?>

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Cargar Transacciones</h1>
                </div>
                <div class="col-md-12">
                    <form enctype="multipart/form-data" action="loadFile.php" method="POST">
                        <div class="form-group">
                            <label for="file">Cargar Archivo (json o csv)</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Cargar Archivo</button>
                        </div>
                    </form>

                </div>
                <div class="col-md-4">
                    <a href="../index.php" class="btn btn-primary my-2">Volver a Home</a>
                </div>
            </div>
        </div>
    </section>

</main>
<?php $layout->printFooter(); ?>