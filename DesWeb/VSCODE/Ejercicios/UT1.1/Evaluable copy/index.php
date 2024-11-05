<?php
session_start();
$identifiedPost = false;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION['userId'])) {
        header("Location: events.php");
        die;
    }
    $error = false;
} else {

    include_once __DIR__ . "/utils/validation.php";

    $error = false;
    $errorMessages = [];

    if (!filter_input(INPUT_POST, 'email', FILTER_CALLBACK, array('options' => 'ValLoginEmail'))) {
        $error = true;
        array_push($errorMessages, 'El usuario no existe.');
    } else {
        $email = ValLoginEmail($_POST['email']);

        if (!filter_input(INPUT_POST, 'password', FILTER_CALLBACK, array('options' => function ($password) use ($email) {
            return ValLoginPass($password, $email);
        }))) {
            $error = true;
            array_push($errorMessages, 'El contraseña no es correcta.');
        } else {
            session_regenerate_id(true);
            $_SESSION['email'] = $email;
            $_SESSION['password'] = ValLoginPass($password, $email);

            global $calendarDataAccess;
            $user = $calendarDataAccess->getUserByEmail($email);

            $_SESSION['userId'] = $user->getId();
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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/basic-style.css"> <!-- Hoja de estilos -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
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
                <input type="email" class="form-control" id="email" name="email" required>
                <div id="emailHelp" class="form-text">No compartiremos tu correo con nadie más.</div>
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Botón de enviar -->
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary btn-custom-lg" type="submit">Iniciar Sesión</button>
                <a href="register.php" class="btn btn-secondary btn-custom-sm">Registrarse</a>
            </div>
        </form>
    </div>
</body>

</html>