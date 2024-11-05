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
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/basic-style.css"> <!-- Hoja de estilos -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <?php if ($creado): ?>
            <h2>Usuario creado.</h2>
            <a href="index.php" class="btn btn-secondary btn-custom-sm">Volver al Login</a>
        <?php else: ?>
            <?php
            // Manejo de los errores
            if ($error) {
                foreach ($errorMessages as $message) {
                    echo '<div class="alert alert-warning" role="alert">' . $message . '</div>';
                }
            }
            ?>

            <form action="" method="POST" class="shadow p-4 rounded bg-light">
                <!-- Correo -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo:</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="firstName" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>

                <!-- Apellidos -->
                <div class="mb-3">
                    <label for="lastName" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>

                <!-- Cumpleaños -->
                <div class="mb-3">
                    <label for="birthDate" class="form-label">Selecciona tu fecha de nacimineto:</label>
                    <input class="form-control" type="date" id="birthDate" name="birthDate" required>
                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <!-- Repite Contraseña -->
                <div class="mb-3">
                    <label for="passwordCheck" class="form-label">Repite la contraseña:</label>
                    <input type="password" class="form-control" id="passwordCheck" name="passwordCheck" required>
                </div>

                <!-- Botón de enviar -->
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-custom-lg" type="submit">Registrarse</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>