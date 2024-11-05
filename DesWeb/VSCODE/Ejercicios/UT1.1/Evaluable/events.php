<?php
session_start();
include_once "entities/Event.php";
require_once __DIR__ . "/utils/db.php";

// para mostrar bien las fechas
function visualizarfecha($dateString)
{
    $dateTime = new DateTime($dateString);
    return $dateTime->format('d/m/Y - H:i');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="styles/basic-style.css">
</head>

<body>
    <div class="container container-custom mt-5">
        <div class="shadow p-4 rounded bg-light">
            <h2 class="h2 ">Tus eventos</h2>
            <?php
            $eventos = $calendarDataAccess->getEventsByUserId($_SESSION["userId"]);
            ?>

            <div class="user-icon" tabindex="0">
                <div class="circulo"><span class="fa-solid fa-user fa-2xl" id="icono"></span></div>
                <div class="user-span">
                    <a href="change-password.php">Cambiar contraseña</a>
                    <a href="logout.php">Cerrar sesión</a>
                </div>
            </div>


            <?php

            echo "<table class='table table-striped'>";
            echo "<tr><td colspan='5' class='text-center'>
                <a href='new-event.php' class='fa-solid fa-plus btn btn-action' alt='Añadir evento'></a>
            </td></tr>";

            if (count($eventos) > 0) {
                foreach ($eventos as $event) {
                    echo "<tr>
                        <td>
                            <div class='event-title'>
                                <span>{$event->getTitle()}</span>
                                <div class='event-tooltip'>
                                    <strong>Descripción:</strong> {$event->getDescription()}<br>
                                    <strong>Inicio:</strong> " . visualizarfecha($event->getStartDate()) . "<br>
                                    <strong>Fin:</strong> " . visualizarfecha($event->getEndDate()) . "<br>
                                </div>
                            </div>
                        </td>
                        <td>" . visualizarfecha($event->getStartDate()) . "  hasta  " . visualizarfecha($event->getEndDate()) . "</td>
                        <td class='text-end'> <!-- Clase para alinear a la derecha -->
                        <a href='edit-event.php?eventId={$event->getId()}' class='fa-solid fa-pencil btn-action' alt='Modificar evento'></a>
                            <a href='delete-event.php?eventId={$event->getId()}' class='fa-solid fa-eraser btn-action' alt='Borrar evento'></a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No tienes eventos.</td></tr>";
            }
            echo "<tr><td colspan='5' class='text-center'>
                <a href='new-event.php' class='fa-solid fa-plus btn btn-action' alt='Añadir evento'></a>
            </td></tr>";
            echo "</table>";
            ?>
            <p class="mt-3 small">Para ver más detalles pasa por encima de los eventos</p>
        </div>
    </div>
</body>

</html>