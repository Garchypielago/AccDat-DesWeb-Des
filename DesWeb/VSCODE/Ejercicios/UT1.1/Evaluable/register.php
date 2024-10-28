<?php
session_start();

$identifiedPost = false;
$creado = false;
$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION['userId'])) {
        header("Location: events.php");
        die;
    }
} else {

    include  __DIR__ . "/utils/validation.php";
    $errorMessages = [];

    // validacion de email
    $valEmail = filter_input(INPUT_POST, 'email', FILTER_CALLBACK, array('options' => 'ValRegEmail'));

    if ($valEmail != $_POST['email']) {
        $error = true;
        array_push($errorMessages, $valEmail);
    } else {
        $email = ValRegEmail($_POST['email']);
    }


    // validacion de contraseñas
    $passwordCheck = $_POST['passwordCheck'];

    $valPass = filter_input(INPUT_POST, 'password', FILTER_CALLBACK, array('options' => function ($password) use ($passwordCheck) {
        return valRegPassword($password, $passwordCheck);
    }));

    if ($valPass != $_POST['password']) {
        $error = true;
        array_push($errorMessages, $valPass);
    } else {
        $password = valRegPassword($_POST['password'], $passwordCheck);
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    // validacion de otros campos TODO hacerlos mas especificos
    $valFirstName = filter_input(INPUT_POST, 'firstName', FILTER_CALLBACK, array('options' => 'ValRegFirstName'));

    if ($valFirstName != $_POST['firstName']) {
        $error = true;
        array_push($errorMessages, $valFirstName);
    } else {
        $firstName = ValRegFirstName($_POST['firstName']);
    }

    $valRegLastName = filter_input(INPUT_POST, 'lastName', FILTER_CALLBACK, array('options' => 'ValRegLastName'));

    if ($valRegLastName != $_POST['lastName']) {
        $error = true;
        array_push($errorMessages, $valRegLastName);
    } else {
        $lastName = ValRegFirstName($_POST['lastName']);
    }

    $valBirthDate = filter_input(INPUT_POST, 'birthDate', FILTER_CALLBACK, array('options' => 'ValRegBirthDate'));

    if ($_POST['birthDate'] == null || $valBirthDate != $_POST['birthDate']) {
        $error = true;
        array_push($errorMessages, $valBirthDate);
    } else {
        $birthDate = ValRegBirthDate($_POST['birthDate']);
    }

    if (!$error) {
        require_once __DIR__ . '/entities/User.php';

        $newUser = new User($email, $password, $firstName, $lastName, $birthDate, null);

        $creado = $calendarDataAccess->createUser($newUser);

        if ($creado) {
            session_regenerate_id(true);
        } else {
            $error = true;
            array_push($errorMessages, "FATAL ERROR: no se pudo crear el usuario.");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .btn-custom-lg {
            height: 40px;
            /* Puedes ajustar la altura a lo que desees */
            margin-left: 15px;
            padding: 0px 30px;
            /* Ajusta el relleno interno (padding) si es necesario */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <?php

        if ($creado) {
        ?>
            <h2> Usuario creado.</h2>
            <a href="index.php" class="btn btn-secondary btn-custom-sm">Volver al Login</a>

        <?php
        } else {

            // Manejo de los errores
            if ($error) {
                foreach ($errorMessages as $message) {
                    echo '<div class="alert alert-warning" role="alert">';
                    echo "<p>" . $message . "</p>";
                    echo '</div>';
                }
            }
        ?>

            <form action="" method="POST">
                <!-- Correo -->
                <div class="form-group">
                    <label for="id">Correo o usuario:</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>

                <!-- Nombre -->
                <div class="form-group">
                    <label for="firstName">Nombre:</label>
                    <input type="text" class="form-control" id="firstName" name="firstName">
                </div>

                <!-- Apellidos -->
                <div class="form-group">
                    <label for="lastName">Apellidos:</label>
                    <input type="text" class="form-control" id="lastName" name="lastName">
                </div>

                <!-- Cumpleaños -->
                <div class="form-group">
                    <label>Selecciona fecha: </label>
                        <input class="form-control" type="date" id="birthDate" name="birthDate">
                </div>

                <!-- Contraseña -->
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>

                <!-- Rep Contraseña -->
                <div class="form-group">
                    <label for="passwordCheck">Repite la contraseña:</label>
                    <input type="text" class="form-control" id="passwordCheck" name="passwordCheck">
                </div>

                <!-- Botón de enviar -->
                <br>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary btn-custom-lg" type="submit">Registrarse</button>
                </div>
            </form>
    </div>
<?php } ?>
</body>

</html>