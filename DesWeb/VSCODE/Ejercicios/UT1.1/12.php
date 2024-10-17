<?php
// Verificar si las cookies ya existen
$fondo = isset($_COOKIE['fondo']) ? $_COOKIE['fondo'] : "white";
$texto = isset($_COOKIE['texto']) ? $_COOKIE['texto'] : "black";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <style>
        body {
            background-color: <?php echo $fondo ?>;
        }
        * {
            color: <?php echo $texto ?>;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Busqueda de Cookies</h2>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque quaerat impedit vitae quia eum reprehenderit officiis vel laudantium nesciunt repudiandae, nostrum quod ut amet cupiditate corrupti incidunt harum voluptatum cum.</p>
    </div>

</body>

</html>