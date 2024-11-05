<?php
session_start();
include_once "entities/Event.php";
require_once __DIR__ . "/utils/db.php";

$eventId = $_GET["eventId"];
$event = $calendarDataAccess->getEventById($eventId);
$userevents = $calendarDataAccess->getEventsByUserId($_SESSION["userId"]);
$usercheck = false;
$error = false;

if (in_array($event, $userevents)) {
    $usercheck = true;
}

// Manejo del formulario al recibir una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include __DIR__ . "/utils/validation.php";
    $errorMessages = [];

    // Validación del título
    $valTitle = filter_input(INPUT_POST, 'title', FILTER_CALLBACK, array('options' => 'ValEditTitle'));
    if ($valTitle != $_POST['title']) {
        $error = true;
        array_push($errorMessages, $valTitle);
    } else {
        $title = ValEditTitle($_POST['title']);
    }

    // Validación de la descripción
    $valDescription = filter_input(INPUT_POST, 'description', FILTER_CALLBACK, array('options' => 'ValEditDescription'));
    if ($valDescription != $_POST['description']) {
        $error = true;
        array_push($errorMessages, $valDescription);
    } else {
        $description = ValEditDescription($_POST['description']);
    }

    // Validación de fechas
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
            $endDate = ValEndDate($endDate, $startDate);
        }
    }

    // Modificación del evento si no hay errores
    if (!$error) {
        require_once __DIR__ . '/entities/Event.php';
        $newEvent = new Event($event->getUserId(), $title, $description, $startDate, $endDate, $event->getId());

        $creado = $calendarDataAccess->updateEvent($newEvent);
        if ($creado) {
            session_regenerate_id(true);
            header("Location: events.php");
            die;
        } else {
            $error = true;
            array_push($errorMessages, "FATAL ERROR: no se pudo modificar el evento.");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/basic-style.css"> <!-- Hoja de estilos -->
</head>

<body>
    <?php if ($event && $usercheck): ?>
        <div class="container container-custom mt-5">
            <div class="shadow p-4 rounded bg-light">
                <!-- Manejo de errores -->
                <?php if ($error): ?>
                    <div class="alert alert-warning" role="alert">
                        <?php foreach ($errorMessages as $message): ?>
                            <p><?php echo $message; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <!-- Título -->
                    <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $event->getTitle(); ?>">
                    </div>

                    <!-- Descripción -->
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea class="form-control" placeholder="Describe este evento" id="description" name="description" style="height: 100px"><?php echo $event->getDescription(); ?></textarea>
                    </div>

                    <!-- Fecha Inicio -->
                    <div class="form-group">
                        <label>Selecciona fecha de inicio:</label>
                        <input class="form-control" type="datetime-local" id="startDate" name="startDate" value="<?php echo $event->getStartDate(); ?>">
                    </div>

                    <!-- Fecha Final -->
                    <div class="form-group">
                        <label>Selecciona fecha de finalización:</label>
                        <input class="form-control" type="datetime-local" id="endDate" name="endDate" value="<?php echo $event->getEndDate(); ?>">
                    </div>

                    <br>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary btn-custom-lg" type="submit">Modificar</button>
                        <a href='events.php' class='btn btn-secondary btn-custom-sm'>Volver</a>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="container container-custom mt-5">
            <div class="shadow p-4 rounded bg-light">
                <div class="alert alert-warning" role="alert">
                    No se puede acceder al evento porque no existe, o no tiene permisos para verlo.
                </div>
                <br>
                <div class="d-flex gap-2">
                    <a href='events.php' class='btn btn-secondary btn-custom-sm'>Volver</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>