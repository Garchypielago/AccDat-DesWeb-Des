<?php
session_start();
include_once "entities/Event.php";
require_once __DIR__ . "/utils/db.php";

// $eventId = $_GET["eventId"];
// $event = $calendarDataAccess->getEventById($eventId);
// $userevents = $calendarDataAccess->getEventsByUserId($_SESSION["userId"]);
// $usercheck = false;
$error = false;

// es cunado le llega si mimso
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include  __DIR__ . "/utils/validation.php";
    $errorMessages = [];

    // validacion de titulo
    $valTitle = filter_input(INPUT_POST, 'title', FILTER_CALLBACK, array('options' => 'ValEditTitle'));

    if ($valTitle != $_POST['title']) {
        $error = true;
        array_push($errorMessages, $valTitle);
    } else {
        $title = ValEditTitle($_POST['title']);
    }

    // validacion de descripcion
    $valDescription = filter_input(INPUT_POST, 'description', FILTER_CALLBACK, array('options' => 'ValEditDescription'));

    if ($valDescription != $_POST['description']) {
        $error = true;
        array_push($errorMessages, $valDescription);
    } else {
        $description = ValEditDescription($_POST['description']);
    }

    // validacion de otros campos
    $valStartDate = filter_input(INPUT_POST, 'startDate', FILTER_CALLBACK, array('options' => 'ValStartDate'));

    if ($_POST['startDate'] == null || $valStartDate != $_POST['startDate']) {
        $error = true;
        array_push($errorMessages, $valStartDate);
    } else {
        $startDate = ValStartDate($_POST['startDate']);

        $endDate = $_POST['endDate'];
        $valEndDate = filter_input(INPUT_POST, 'endDate', FILTER_CALLBACK, array('options' => function ($endDate) use ($startDate) {
            return ValEndDate($endDate, $startDate);
        }));

        if ($_POST['endDate'] == null || $valEndDate != $_POST['endDate']) {
            $error = true;
            array_push($errorMessages, $valEndDate);
        } else {
            $startDate = ValEndDate($endDate, $startDate);
        }
    }


    // todo modificar el evento
    if (!$error) {
        require_once __DIR__ . '/entities/Event.php';

        $newEvent = new Event($_SESSION["userId"], $title, $description, $startDate, $endDate);

        $creado = $calendarDataAccess->createEvent($newEvent);

        if ($creado) {
            session_regenerate_id(true);
            header("Location: events.php");
            die;
        } else {
            $error = true;
            array_push($errorMessages, "FATAL ERROR: no se pudo crear el evento.");
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
    // if ($event && $usercheck) {
        // Manejo de los errores
        if ($error) {
            foreach ($errorMessages as $message) {
                echo '<div class="alert alert-warning" role="alert">';
                echo "<p>" . $message . "</p>";
                echo '</div>';
            }
        }
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
                    <input type="text" class="form-control" id="title" name="title">
                </div>

                <!-- Descripcion -->
                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <textarea class="form-control" placeholder="Describe este evento" id="description" name="description" style="height: 100px"></textarea>
                </div>

                <!-- Fecha Inicio -->
                <div class="form-group">
                    <label>Selecciona fecha de inicio: </label>
                    <input class="form-control" type="datetime-local" id="startDate" name="startDate">
                </div>

                <!-- Fecha Final -->
                <div class="form-group">
                    <label>Selecciona fecha de finalización: </label>
                    <input class="form-control" type="datetime-local" id="endDate" name="endDate">
                </div>

                <br>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary btn-custom-lg" type="submit">Crear</button>
                    <a href='events.php' class='btn btn-secondary btn-custom-sm'>Volver</a></p>
                </div>

            </form>
        </div>

    <?php
    // } else {
    ?>
        <!-- <div class="container mt-5">
            <div class="alert alert-warning" role="alert">
                No se puede acceder al evento porque no existe, o no tiene permisos para verlo.
            </div>
            <br>
            <div class="d-flex gap-2">
                <a href='events.php' class='btn btn-secondary btn--sm'>Volver</a></p>
            </div>
        </div> -->
    <?php

    // } ?>

</body>

</html>