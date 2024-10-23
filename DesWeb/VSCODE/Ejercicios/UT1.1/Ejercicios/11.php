<?php
// Verificar si las cookies ya existen
$fondo = isset($_COOKIE['fondo']) ? $_COOKIE['fondo'] : "white";
$texto = isset($_COOKIE['texto']) ? $_COOKIE['texto'] : "black";


    if (isset($_POST['fondo']) && $_POST['fondo'] !== 'sincambio') {
        $fondo = $_POST['fondo'];
        setcookie("fondo", $fondo, time() + 3600 * 2, "/");
    }

    if (isset($_POST['texto']) && $_POST['texto'] !== 'sincambio') {
        $texto = $_POST['texto'];
        setcookie("texto", $texto, time() + 3600 * 2, "/");
    }

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
        <h2 class="mb-4">Formulario de eleccion (Cookies)</h2>

        <form action="" method="POST">

            <div class="form-floating">
                <select class="form-select" id="fondo" aria-label="Floating label select example" name="fondo">
                    <option value="white">Por defecto</option>
                    <option selected value="sincambio">No cambiar color preferido</option>
                    <option value="tomato">Tomato</option>
                    <option value="mediumslateblue">Mediumslateblue</option>
                    <option value="peru">Peru</option>
                    <option value="paleturquoise">Paleturquoise</option>

                </select>
                <label for="fondo">Elige el color de fondo de pantalla</label>
            </div>

            <br>
            <div class="form-floating">
                <select class="form-select" id="texto" aria-label="Floating label select example" name="texto">
                    <option value="black">Por defecto</option>
                    <option selected value="sincambio">No cambiar color preferido</option>
                    <option value="white">White</option>
                    <option value="beige">Beige</option>
                    <option value="darkseagreen">Darkseagreen</option>
                    <option value="violet">Violet</option>

                </select>
                <label for="texto">Elige el color de texto</label>
            </div>



            <br>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
        </form>
    </div>

</body>

</html>