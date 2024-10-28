<?php
session_start();
include_once "entities/Event.php";
require_once __DIR__ . "/utils/db.php";

$eventId = $_GET["eventId"];
$event = $calendarDataAccess->getEventById($eventId);
$userevents = $calendarDataAccess->getEventsByUserId($_SESSION["userId"]);
$usercheck = false;

if (in_array($event, $userevents)) {
    $usercheck = true;
}

// es cunado le llega si mimso
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include  __DIR__ . "/utils/validation.php";
    $errorMessages = [];

    // validacion de titulo
    $valFirstName = filter_input(INPUT_POST, 'firstName', FILTER_CALLBACK, array('options' => 'ValRegFirstName'));

    if ($valFirstName != $_POST['firstName']) {
        $error = true;
        array_push($errorMessages, $valFirstName);
    } else {
        $firstName = ValRegFirstName($_POST['firstName']);
    }

    // validacion de descripcion
    $valFirstName = filter_input(INPUT_POST, 'firstName', FILTER_CALLBACK, array('options' => 'ValRegFirstName'));

    if ($valFirstName != $_POST['firstName']) {
        $error = true;
        array_push($errorMessages, $valFirstName);
    } else {
        $firstName = ValRegFirstName($_POST['firstName']);
    }

    // validacion de otros campos
    $valBirthDate = filter_input(INPUT_POST, 'birthDate', FILTER_CALLBACK, array('options' => 'ValRegBirthDate'));

    if ($_POST['birthDate'] == null || $valBirthDate != $_POST['birthDate']) {
        $error = true;
        array_push($errorMessages, $valBirthDate);
    } else {
        $birthDate = ValRegBirthDate($_POST['birthDate']);
    }

    $valBirthDate = filter_input(INPUT_POST, 'birthDate', FILTER_CALLBACK, array('options' => 'ValRegBirthDate'));

    if ($_POST['birthDate'] == null || $valBirthDate != $_POST['birthDate']) {
        $error = true;
        array_push($errorMessages, $valBirthDate);
    } else {
        $birthDate = ValRegBirthDate($_POST['birthDate']);
    }


    // todo modificar el evento
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
// trozo de samu de validacion
// } else {
//     $eventId = $_GET["eventId"];
//     $event = $calendarDataAccess->getEventById($eventId);
//     $userevents = $calendarDataAccess->getEventsByUserId($_SESSION["userId"]);
//     $usercheck = false;

//     if (in_array($event, $userevents)) {
//         $usercheck = true;
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

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

        .btn-custom-sm {
            height: 30px;
            /* Puedes ajustar la altura a lo que desees */
            margin-top: 10px;
            padding: 0px 20px;
            /* Ajusta el relleno interno (padding) si es necesario */
        }
    </style>
</head>

<body>
    <?php
    // esto cunado llega de otro lado y hace comprobacion y mete el error o no
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if ($event && $usercheck) {
    ?>
            <div class="container mt-5">
                <!-- <form method='post' action=''>
                <button name='eventId' value='{$eventId}' type='submit'>Sí, eliminar el evento</button>
                <button type='submit'>No, volver al listado de eventos</button>
            </form> -->

                <form action="" method="POST">

                    <!-- Titulo -->
                    <div class="form-group">
                        <label for="title">Titulo:</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $event->getTitle(); ?>">
                    </div>

                    <!-- Descripcion -->
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?php echo $event->getDescription(); ?>">
                    </div>

                    <!-- Fecha Inicio -->
                    <div class="form-group">
                        <label>Selecciona fecha de inicio: </label>
                        <input class="form-control" type="datetime-local" id="startDate" name="startDate" value="<?php echo $event->getStartDate(); ?>">
                    </div>

                    <!-- Fecha Final -->
                    <div class="form-group">
                        <label>Selecciona fecha de finalización: </label>
                        <input class="form-control" type="datetime-local" id="endDate" name="endDate" value="<?php echo $event->getEndDate(); ?>">
                    </div>

                    <br>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary btn-custom-lg" type="submit">Modificar</button>
                        <a href='events.php' class='btn btn-secondary btn-custom-sm'>Volver</a></p>
                    </div>

                </form>
            </div>

        <?php
        } else {
        ?>
            <div class="container mt-5">
                <div class="alert alert-warning" role="alert">
                    No se puede acceder al evento porque no existe, o no tiene permisos para verlo.
                </div>
                <br>
                <div class="d-flex gap-2">
                    <a href='events.php' class='btn btn-secondary btn--sm'>Volver</a></p>
                </div>
            </div>
    <?php
        }
        // este le llega pr post, d si mismo, aqu hacer el fomr como en el otro
    } else {
        // todo redirigir a eventos.
        echo "<h2>EVENTO BORRADO CON ÉXITO</h2>";
        echo "<p><a href=events.php>VOLVER AL LISTADO DE EVENTOS</a></p>";
    } ?>

</body>

</html>