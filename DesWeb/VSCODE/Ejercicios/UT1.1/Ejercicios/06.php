<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UT1.1 Ejercicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <h1>Formulario ej06 - Generar tablas de multiplicar</h1>
    <form method="post" action="" class="form-label">
        <div class="row g-2">
            <div class="col-sm">
                <label for="inicio" class="form-label">Número menor</label><input type="number" class="form-control" placeholder="Menor de los numeros" name="inicio">
            </div>
            <div class="col-sm">
                <label for="final" class="form-label">Número mayor</label><input type="number" class="form-control" placeholder="Mayor de los numeros" name="final">
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Calcular</button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['inicio']) && isset($_POST['final'])) {
        if (is_numeric($_POST['inicio']) && is_numeric($_POST['final'])) {
            if ($_POST['inicio'] < $_POST['final']) {

                $a = $_POST['inicio'];
                $b = $_POST['final']; ?>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th></th>
                            <?php for (; $a <= $b; $a++) { ?>
                                <th>
                                    <?php echo $a; ?>
                                </th>
                            <?php } ?>
                        </tr>
                        <?php for ($x = 0; $x <= 10; $x++) { ?>
                            <!-- declaro variables de nuevo por bucle -->
                            <?php $a = $_POST['inicio'];
                            $b = $_POST['final']; ?>

                            <tr>
                                <td>
                                    <?php echo $x; ?>
                                </td>
                                <?php for (; $a <= $b; $a++) { ?>
                                    <td>
                                        <?php echo $a * $x; ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
    <?php
            } else {
                echo "El primer valor es mayor al segundo";
            }
        } else if (!is_numeric($_POST['inicio']) && !is_numeric($_POST['final'])) {
            echo "Los valores no son numero";
        } else if (!is_numeric($_POST['inicio'])) {
            echo "El primer valor no es un numero";
        } else if (!is_numeric($_POST['final'])) {
            echo "El segundo valor no es un numero";
        }
    } else if (!isset($_POST['inicio']) && !isset($_POST['final'])) {
        echo "No hay valores en la entrda";
    } else if (!isset($_POST['inicio'])) {
        echo "No hay valor de primer numero";
    } else if (!isset($_POST['final'])) {
        echo "No hay valor de segundo numero";
    }
    ?>


    <br>

</body>

</html>