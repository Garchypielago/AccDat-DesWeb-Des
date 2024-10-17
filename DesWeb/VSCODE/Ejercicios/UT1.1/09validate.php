<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .titulo {
            background-color: grey !important;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <h1>Ej09 - PIZZA</h1>
    </header>

        <?php

        $error = false;
        $errorMessages = [];

        include_once "09validate_func.php";

        if (!filter_input(INPUT_POST, 'tipomasa', FILTER_CALLBACK, array('options' => 'valMasa'))) {
            $error = true;
            array_push($errorMessages, 'El parámetro "tipomasa" no existe o no es un número entero válido');
        } else {
            $TipoMasa = $_POST['tipomasa'];
        }

        // Validar tamaño (entero)
        if (!filter_input(INPUT_POST, 'tamaño', FILTER_CALLBACK, array('options' => 'valTamano'))) {
            $error = true;
            array_push($errorMessages, 'El parámetro "tamaño" no existe o no es un número entero válido');
        } else {
            $Tamano = $_POST['tamaño'];
        }

        // Validar base (texto)
        if (!filter_input(INPUT_POST, 'base', FILTER_CALLBACK, array('options' => 'valBase'))) {
            $error = true;
            array_push($errorMessages, 'El parámetro "base" no existe o no es una cadena válida');
        } else {
            $Base = $_POST['base'];
        }

        // Validar nombre (texto)
        if (empty($_POST['nombre']) || !is_string($_POST['nombre'])) {
            $error = true;
            array_push($errorMessages, 'El parámetro "nombre" no existe o no es una cadena válida');
        } else {
            $Nombre = $_POST['nombre'];
        }

        // Validar dirección (texto)
        if (empty($_POST['direccion']) || !is_string($_POST['direccion'])) {
            $error = true;
            array_push($errorMessages, 'El parámetro "dirección" no existe o no es una cadena válida');
        } else {
            $Direccion = $_POST['direccion'];
        }

        // Validar teléfono (número entero)
        if (!filter_input(INPUT_POST, 'telefono', FILTER_CALLBACK, array('options' => 'valTelefono'))) {
            $error = true;
            array_push($errorMessages, 'El parámetro "telefono" no existe o no es un número entero válido');
        } else {
            $Telefono = $_POST['telefono'];
        }

        // Validar pago (texto)
        if (!filter_input(INPUT_POST, 'pago', FILTER_CALLBACK, array('options' => 'valPago'))) {
            $error = true;
            array_push($errorMessages, 'El parámetro "pago" no existe o no es una cadena válida');
        } else {
            $Pago = $_POST['pago'];
        }

        // Validar apellidos (texto)
        $Apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;

        // Validar observaciones (texto, opcional)
        $Observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;

        // Validar extras (texto, opcional)
        $Extras = isset($_POST['extras']) ? $_POST['extras'] : null;

        if ($error) {
            // Manejo de los errores
            foreach ($errorMessages as $message) {
                echo $message . "<br>";
            }
        } else {
            
        ?>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th rowspan="1" class="titulo">Pedido nº001</th>
                        <td class="titulo"></td>
                    </tr>
                    <tr>
                        <th>Tipo de masa</th>
                        <td><?php echo $TipoMasa ?></td>
                    </tr>
                    <tr>
                        <th>Tamaño</th>
                        <td><?php echo $Tamano ?></td>
                    </tr>
                    <tr>
                        <th>Base</th>
                        <td><?php echo $Base ?></td>
                    </tr>
                    <tr>
                        <th>Extras</th>
                        <td><?php
                            foreach ($Extras as $extras) {
                                echo "{$extras}   ";
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <th>Observaciones</th>
                        <td><?php echo $Observaciones ?></td>
                    </tr>
                    <tr>
                        <th rowspan="1" class="titulo">Datos cliente</th>
                        <td class="titulo"></td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <td><?php echo $Nombre ?></td>
                    </tr>
                    <tr>
                        <th>Apellidos</th>
                        <td><?php echo $Apellidos ?></td>
                    </tr>
                    <tr>
                        <th>Direccion</th>
                        <td><?php echo $Direccion ?></td>
                    </tr>
                    <tr>
                        <th>Telefono</th>
                        <td><?php echo $Telefono ?></td>
                    </tr>
                    <tr>
                        <th>Método de pago</th>
                        <td><?php echo $Pago ?></td>
                    </tr>
                </tbody>
            </table>
        <?php

        }

        ?>



</body>

</html>