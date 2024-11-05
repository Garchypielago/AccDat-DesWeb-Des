<?php 
session_start();
require_once __DIR__ . "/utils/db.php";
$login=false;
$logoff=false;
if(!isset($_SESSION['userId'])) {
    header("Location: index.php");
}
if($_SERVER['REQUEST_METHOD'] === 'GET') {
if(isset($_SESSION['userId'])){
$login=true;
}
}
else{
    if(isset($_POST['logout'])){
        $logoff=true;
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/basic-style.css">
</head>

<body>
    <div class="container container-custom mt-5">
        <div class="shadow p-4 rounded bg-light text-center">
            <?php 
            if ($login) {
                echo "<h3 class='mb-4'>¿Seguro que deseas desconectarte?</h3>";
                echo "<p><form method='post' action='' class='d-flex justify-content-center gap-2'>";
                echo "<button name='logout' value=true type='submit' class='btn btn-danger'>Sí, desconectar</button>";
                echo "<button type='submit' class='btn btn-secondary'>No, volver al listado de eventos</button>";
                echo "</form></p>";
            } 
            else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                echo "<p class='text-muted'>Ya estás desconectado.</p>";
            } 
            else if ($logoff) {
                session_destroy();
                echo "<h4>Se ha desconectado correctamente.</h4>";
                echo "<a href='index.php' class='btn btn-secondary btn-custom-sm'>Volver</a>";
            } 
            else {
                header("Location: events.php");
            }
            ?>
        </div>
    </div>
</body>

</html>
