<?php
session_start();
$identifiedPost = false;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION['user'])) {
        header("Location: app.php");
        die;
    }
} else {
    include "validation.php";

    $error = false;
    $errorMessages = [];

    if (!filter_input(INPUT_POST, 'user', FILTER_CALLBACK, array('options' => 'valUser'))) {
        $error = true;
        array_push($errorMessages, 'El usuario no existe.');
    } else {
        $user = $_POST['user'];

        if (!filter_input(INPUT_POST, 'password', FILTER_CALLBACK, array('options' => function ($password) use ($user) {
            return valPass($password, $user);
        }))) {
            $error = true;
            array_push($errorMessages, 'El contraseña no es correcta.');
        } else {
            session_regenerate_id(true);
            $_SESSION['user'] = $_POST['user'];
            $_SESSION['password'] = $_POST['password'];
            header("Location: app.php");
            die;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</head>

<body>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    ?>
        <form action="" method="POST">
            <!-- Nombre -->
            <div class="form-group">
                <label for="user">Usuario</label>
                <input type="text" class="form-control" id="user" name="user">
            </div>

            <!-- Apellidos -->
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="text" class="form-control" id="password" name="password">
            </div>

            <!-- Botón de enviar -->
            <br>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Subir</button>
            </div>
        </form>
    <?php
    } else {
        // Manejo de los errores
        foreach ($errorMessages as $message) {
            echo $message . "<br>";
        }
        echo '<button onclick="history.back()">Volver</button>';
    }
    ?>

</body>

</html>