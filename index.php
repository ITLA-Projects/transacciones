<?php
require_once 'layout/layout.php';
require_once 'helpers/utilities.php';
require_once 'Transacciones/Transaccion.php';
require_once 'service/IServiceBase.php';
require_once 'Transacciones/TransaccionServiceFile.php';
require_once 'helpers/FileHandler/IFileHandler.php';
require_once 'helpers/FileHandler/JsonFileHandler.php';
require_once 'helpers/FileHandler/SerializationFileHandler.php';


$layout = new Layout(false);
$utilities = new Utilities();
$service = new TransaccionServiceFile(true);

$listadoTransaccions = $service->GetList();


?>
<?php $layout->printHeader(); ?>

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Listado de Transacciones</h1>
                </div>
                <div class="col-md-4">
                    <a href="Transacciones/add.php" class="btn btn-primary my-2">Agregar Transaccion</a>
                    <form enctype="multipart/form-data" action="loadFile.php" method="POST">
                        <div class="form-group">
                            <label for="File">Cargar Archivo</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Cargar Archivo</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">


            <div class="row">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listadoTransaccions as $transaccion) : ?>
                            <tr>
                                <th scope="row"><?php echo $transaccion->id; ?></th>
                                <th><?php echo $transaccion->fecha; ?></th>
                                <th><?php echo $transaccion->monto; ?></th>
                                <th><?php echo $transaccion->descripcion; ?></th>
                                <th>
                                    <a href="Transacciones/edit.php?id=<?php echo $transaccion->id; ?>" class="btn btn-warning">Editar</a>
                                    <a href="Transacciones/delete.php?id=<?php echo $transaccion->id; ?>" class="btn btn-danger">Eliminar</a>
                                </th>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>
<script src="assets\js\Sections\Index\index.js"></script>
<?php $layout->printFooter(); ?>