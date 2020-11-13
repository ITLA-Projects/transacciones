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
$serializeLog = new SerializationFileHandler("data","log");

//solo actua si existe el id
if (isset($_GET['id'])) {

    $transaccionId = $_GET['id'];

    $element = $service->GetById($transaccionId);


    if (isset($_POST['monto']) && isset($_POST['descripcion'])) {

        $nuevaTransaccion = new Transaccion();
        date_default_timezone_set("America/Santo_Domingo");
        $nuevaTransaccion->initializeData(
            0,
            date("Y/m/d") . "-" . date("h:i:s"),
            $_POST['monto'],
            $_POST['descripcion'],
        );

        $service->Update($transaccionId, $nuevaTransaccion);

        $serializeLog->SaveFile("Se Edito la transaccion con el id: " . $transaccionId . ", la fecha " . date("Y/m/d") . "-" . date("h:i:s")
        . ", con el monto de " . $_POST['monto'] . " y con la Descripcion: " . $_POST['descripcion']);

        header("Location: ../index.php");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}



?>
<?php $layout->printHeader(); ?>



<main role="main">

    <div style="margin-top:2%;" class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <a href="../index.php" class="btn btn-warning">Volver atras</a>
                    Editar esta transaccion
                </div>
                <div class="card-body">

                    <form enctype="multipart/form-data" action="edit.php?id=<?php echo $element->id ?>" method="POST">

                        <div class="form-group">
                            <label for="fecha">Fecha (Cuando actualices se insertara la nueva fecha)</label>
                            <input disabled type="text" class="form-control" id="fecha" name="fecha" value="<?php echo $element->fecha ?>">
                        </div>
                        <div class="form-group">
                            <label for="monto">Monto</label>
                            <input type="text" class="form-control" id="monto" name="monto" value="<?php echo $element->monto ?>">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">descripcion</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $element->descripcion ?>">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>


                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>




</main>


<?php $layout->printFooter(); ?>