<?php
session_start();
include_once "entities/Event.php";

require_once __DIR__ . "/utils/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        a{
            text-decoration: none;
            color: black;
        }
        p{
            border: 1px solid black;
            text-align: center;
        }
    
    </style>
</head>

<body>
    <h2 class="h2">
        Eventos
    </h2>
    <?php
    $eventos = $calendarDataAccess->getEventsByUserId($_SESSION["userId"]);
    echo "<p><a href='new-event.php' class='fa-solid fa-plus' alt='Añadir evento'></a></p>";
    echo "<table class=table>";
    foreach ($eventos as $event) {
        echo "<tr><td>ID: {$event->getId()}</td><td> Título: {$event->getTitle()}</td><td> Inicio: {$event->getStartDate()}</td>
        <td><a href='edit-event.php?eventId={$event->getId()}' class='fa-solid fa-pencil' alt='Modificar evento'></a></td>
        <td><a href='delete-event.php?eventId={$event->getId()}' class='fa-solid fa-eraser' alt='Borrar evento'></a></td>
        </tr>";
    }
    echo "</table>"
    ?>

<?php echo "<p><a href='new-event.php' class='fa-solid fa-plus' alt='Añadir evento'></a></p>" ?>

</body>

</html>