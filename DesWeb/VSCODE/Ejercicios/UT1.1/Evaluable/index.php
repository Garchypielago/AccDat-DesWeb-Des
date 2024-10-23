<?php
session_start();
$identifiedPost = false;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION['userId'])) {
        header("Location: events.php");
        die;
    }
} else {
    
    include  __DIR__ . "/utils/validation.php";


    $error = false;
    $errorMessages = [];

    if (!filter_input(INPUT_POST, 'email', FILTER_CALLBACK, array('options' => 'ValLoginEmail'))) {
        $error = true;
        array_push($errorMessages, 'El usuario no existe.');
    } else {
        $email = $_POST['email'];

        if (!filter_input(INPUT_POST, 'password', FILTER_CALLBACK, array('options' => function ($password) use ($email) {
            return ValLoginPass($password, $email);
        }))) {
            $error = true;
            array_push($errorMessages, 'El contraseña no es correcta.');
        } else {
            session_regenerate_id(true);
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            header("Location: events.php");
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

        <!-- <style>
            :root{
            --bs-warning: black; 
            --bs-warning-rgb: rgb(0,0,0);
            }
        </style> -->

</head>

<body>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    ?>
        <form action="" method="POST">
            <!-- Nombre -->
            <div class="form-group">
                <label for="id">Correo o usuario:</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>

            <!-- Apellidos -->
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="text" class="form-control" id="password" name="password">
            </div>

            <!-- Botón de enviar -->
            <br>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-dark" type="submit">Subir</button>
            </div>
        </form>
    <?php
    } else {
        // Manejo de los errores
        if ($error) {
            foreach ($errorMessages as $message) {
                echo '<div class="alert alert-warning" role="alert">';
                echo "<p>".$message."</p>";
                echo '</div>';
            }
        }
    ?>
    
        <form action="" method="POST">
            <!-- Nombre -->
            <div class="form-group">
                <label for="id">Correo o usuario:</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>

            <!-- Apellidos -->
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="text" class="form-control" id="password" name="password">
            </div>

            <!-- Botón de enviar -->
            <br>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-dark" type="submit">Subir</button>
            </div>
        </form>
    <?php
    }
    ?>

</body>

</html>