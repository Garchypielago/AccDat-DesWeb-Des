<?php
session_start();
include_once "entities/Event.php";
require_once __DIR__ . "/utils/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $calendarDataAccess->deleteEvent($_POST['delete']);
    } else {
        header("Location: events.php");
        exit;
    }
} else {
    $eventId = $_GET["eventId"];
    $event = $calendarDataAccess->getEventById($eventId);
    $userevents = $calendarDataAccess->getEventsByUserId($_SESSION["userId"]);
    $usercheck = false;

    foreach ($userevents as $userevent) {
        if ($userevent == $event) {
            $usercheck = true;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/basic-style.css"> <!-- Hoja de estilos -->
</head>

<body>
    <div class="container container-custom mt-5">
        <div class="shadow p-4 rounded bg-light">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if ($event && $usercheck) {
                    echo "<h4>¿Seguro que desea eliminar el evento: <strong>{$event->getTitle()}</strong>?</h4>";
            ?>
                    <p>
                        <form method='post' action=''>
                            <button class="btn btn-danger" name='delete' value='<?php echo $eventId; ?>' type='submit'>Sí, eliminar el evento</button>
                            <a href='events.php' class='btn btn-secondary'>No, volver al listado de eventos</a>
                        </form>
                    </p>
                <?php
                } else {
                    echo "<div class='alert alert-warning' role='alert'>No se puede acceder al evento porque no existe o porque no tiene permisos para verlo.</div>";
                    echo "<p><a href='events.php' class='btn btn-secondary'>VOLVER AL LISTADO DE EVENTOS</a></p>";
                }
            } else {
                echo "<h2>Evento borrado con éxito</h2>";
                echo "<a href='events.php' class='btn btn-primary btn-custom-lg'>Volver al listado de eventos</a>";
            }
            ?>
        </div>
    </div>
</body>

</html>
