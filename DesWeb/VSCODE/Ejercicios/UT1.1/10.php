<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>Ej10 - Fichero</h1>
    </header>

    <?php

    $error = false;
    $errorMessages = [];

    include_once "10validate_func.php";

    if (!filter_input(INPUT_POST, 'nombre', FILTER_CALLBACK, array('options' => 'valNomApe'))) {
        $error = true;
        array_push($errorMessages, 'El parámetro "nombre" no existe o no cumple requisitos');
    } else {
        $nombre = $_POST['nombre'];
    }

    if (!filter_input(INPUT_POST, 'apellidos', FILTER_CALLBACK, array('options' => 'valNomApe'))) {
        $error = true;
        array_push($errorMessages, 'El parámetro "apellidos" no existe o no cumple requisitos');
    } else {
        $apellidos = $_POST['apellidos'];
    }

    if (!filter_input(INPUT_POST, 'edad', FILTER_CALLBACK, array('options' => 'valEdad'))) {
        $error = true;
        array_push($errorMessages, 'El parámetro "edad" no existe o no cumple requisitos');
    } else {
        $edad = $_POST['edad'];
    }

    if (isset($_FILES['documento']) && $_FILES['documento']['error'] === UPLOAD_ERR_OK) {
        /* // Validar el tipo MIME para asegurarse de que es un PDF
        $mimeType = mime_content_type($archivo['tmp_name']);
        if ($mimeType !== 'application/pdf') {
            return false;
        } */

        if (substr($_FILES['documento']['name'], -3) == "pdf") {
            if ($_FILES['documento']['size'] < (2 * 1048576)) {
                $documento = $_FILES['documento'];

                //ruta de guardado del archivo
                $uploads_dir = 'ficheros';

                if (!is_dir($uploads_dir)) {
                    mkdir($uploads_dir, 0755, true);  // Crea el directorio con permisos de escritura
                }

                //ruta de archivo en la web
                $temp_name = $documento['tmp_name'];

                //nombre del docuento
                $name = basename(filter_var($_FILES["documento"]["name"], FILTER_SANITIZE_SPECIAL_CHARS));

                move_uploaded_file($temp_name, "$uploads_dir/$name");
            } else {
                $error = true;
                array_push($errorMessages, "El archivo supera los 2MB.");
            }
        } else {
            $error = true;
            array_push($errorMessages, "El archivo no es un PDF.");
        }
    } else {
        $error = true;
        array_push($errorMessages, $_FILES['documento']['error']);
    }

    if ($error) {
        // Manejo de los errores
        foreach ($errorMessages as $message) {
            echo $message . "<br>";
        }

        echo '<button onclick="history.back()">Volver</button>';
    } else {

    ?>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th rowspan="1" class="titulo">Datos llegada</th>
                    <td class="titulo"></td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td><?php echo $nombre ?></td>
                </tr>
                <tr>
                    <th>Apellidos</th>
                    <td><?php echo $apellidos ?></td>
                </tr>
                <tr>
                    <th>Edad</th>
                    <td><?php echo $edad ?></td>
                </tr>
                <tr>
                    <th>Documento</th>
                    <td><?php echo "<a href='$uploads_dir/$name' download='$name'>$name</a><br>"; ?></td>
                </tr>
            </tbody>
        </table>
    <?php

    }

    ?>



</body>

</html>