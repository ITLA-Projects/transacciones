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

if (isset($_POST['monto']) && isset($_POST['descripcion'])) {

    $nuevaTransaccion = new Transaccion();

    $nuevaTransaccion->initializeData(
        0,
        date("Y/m/d") . "-" . date("h:i:s"),
        $_POST['monto'],
        $_POST['descripcion'],
    );

    $service->Add($nuevaTransaccion);


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
                    Crear nueva Transaccion
                </div>
                <div class="card-body">

                    <form enctype="multipart/form-data" action="add.php" method="POST">
                        <div class="form-group">
                            <label for="fecha">La Fecha se Generara automaticamente al crear la Transaccion</label>

                        </div>
                        <div class="form-group">
                            <label for="monto">Monto</label>
                            <input type="text" class="form-control" id="monto" name="monto">
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion"/>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Agregar Transaccion</button>
                        </div>


                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>




</main>


<?php $layout->printFooter(); ?>