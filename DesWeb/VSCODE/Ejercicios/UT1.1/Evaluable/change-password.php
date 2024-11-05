<?php
session_start();
require_once __DIR__ . "/utils/db.php";
require_once __DIR__ . "/utils/validation.php";
$error = false;
$errorMessages = [];
$cambiada = false;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_SESSION['userId'])) {
        header("Location: index.php");
    }
} else {
    $email = $calendarDataAccess->getUserById($_SESSION['userId'])->getEmail();

    if (!filter_input(INPUT_POST, 'password', FILTER_CALLBACK, array('options' => function ($password) use ($email) {
        return ValLoginPass($password, $email);
    }))) {
        $error = true;
        array_push($errorMessages, 'La contraseña actual no es correcta.');
    } else {

        $passwordCheck = $_POST['passwordCheck'];

        $valPass = filter_input(INPUT_POST, 'newpassword', FILTER_CALLBACK, array('options' => function ($newpassword) use ($passwordCheck) {
            return valRegPassword($newpassword, $passwordCheck);
        }));

        if ($valPass != $_POST['newpassword']) {
            $error = true;
            array_push($errorMessages, $valPass);
        } else {
            $newpassword = valRegPassword($_POST['newpassword'], $passwordCheck);
            $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $newUsuario = $calendarDataAccess->getUserById($_SESSION['userId']);
            $newUsuario->setPassword($newpassword);
            $cambiada = $calendarDataAccess->updateUser($newUsuario);

            if(!$cambiada){
                $error = true;
                array_push($errorMessages, "Error al cambiar la contraseña en el servidor.");
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/basic-style.css">
</head>

<body>
    <div class="container container-custom mt-5">
        <div class="shadow p-4 rounded bg-light">
            <?php
            if ($cambiada) {
                session_destroy();
                echo "<h4>Contraseña cambiada correctamente.</h4>";
                echo "<a href='index.php' class='btn btn-secondary btn-custom-sm'>Volver</a>";
            } else {

                echo password_verify("password1",  $calendarDataAccess->getUserById($_SESSION['userId'])->getPassword());
                if ($error) {
                    foreach ($errorMessages as $message) {
                        echo '<div class="alert alert-warning" role="alert">';
                        echo "<p>" . $message . "</p>";
                        echo '</div>';
                    }
                } ?>

                <form action="" method="post">
                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <!-- Contraseña nueva-->
                    <div class="mb-3">
                        <label for="newpassword" class="form-label">Nueva Contraseña:</label>
                        <input type="password" class="form-control" id="newpassword" name="newpassword">
                    </div>

                    <!-- Repetir Contraseña -->
                    <div class="mb-3">
                        <label for="passwordCheck" class="form-label">Repite la nueva contraseña:</label>
                        <input type="password" class="form-control" id="passwordCheck" name="passwordCheck">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary btn-custom-lg" type="submit">Cambiar</button>
                        <a href='events.php' class='btn btn-secondary btn-custom-sm'>Volver</a>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</body>

</html>