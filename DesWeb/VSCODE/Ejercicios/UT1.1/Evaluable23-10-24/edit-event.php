<?php
session_start();
include_once "entities/Event.php";
require_once __DIR__ . "/utils/db.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['edit'])){
        // todo edit
        $calendarDataAccess->editEvent($_POST['edit']);
    } else {
        header(("Location: events.php"));
    }
}
else{
$eventId=$_GET["eventId"];
$event = $calendarDataAccess->getEventById($eventId);
$userevents = $calendarDataAccess->getEventsByUserId($_SESSION["userId"]);
$usercheck=false;



foreach ($userevents as $userevent) {
    if($userevent==$event){
        $usercheck=true;
        break;
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 

    if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if($event && $usercheck){
    
    echo "<p><form method='post' action=''><button name='edit' value='{$eventId}' type='submit'>Sí, eliminar el evento</button><button type='submit'>No, volver al listado de eventos</button></form></p>.";
        
        // todo form edit event

}
    else{
        echo "No se puede acceder al evento porque no existe o porque no tiene permisos para verlo";
        echo "<p><a href=events.php>VOLVER AL LISTADO DE EVENTOS</a></p>";
    }
    }
    else{
        echo "<h2>EVENTO BORRADO CON ÉXITO</h2>";
        echo "<p><a href=events.php>VOLVER AL LISTADO DE EVENTOS</a></p>";
    }?>
    
</body>
</html>