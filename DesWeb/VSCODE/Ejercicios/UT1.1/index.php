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
    <h1>UT1.1 Ejercicios</h1>

    <br>
    <h2>Ejercicio 01</h2>
    <?php
    $numeroTabla = 5;
    ?>
    <ul>
        <? for ($x = 0; $x <= 10; $x++) { ?>
            <li>
                <?php echo $numeroTabla . " x " . $x . ": " . ($numeroTabla * $x); ?>
            </li>
        <?php } ?>
    </ul>

    <br>
    <h2>Ejercicio 02</h2>
    <table class="table table-bordered">
        <tbody>
            <? for ($x = 0; $x <= 10; $x++) { ?>
                <tr>
                    <td>
                        <?php echo $numeroTabla . " x " . $x . ": " . ($numeroTabla * $x); ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br>
    <h2>Ejercicio 03</h2>
    <?php $a = 2;
    $b = 4; ?>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th></th>
                <? for (; $a <= $b; $a++) { ?>
                    <th>
                        <?php echo $a; ?>
                    </th>
                <?php } ?>
            </tr>
            <? for ($x = 0; $x <= 10; $x++) { ?>
                <!-- declaro variables de nuevo por bucle -->
                <?php $a = 2;
                $b = 4; ?>

                <tr>
                    <td>
                        <?php echo $x; ?>
                    </td>
                    <? for (; $a <= $b; $a++) { ?>
                        <td>
                            <?php echo $a * $x; ?>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br>
    <h2>Ejercicio 04</h2>
    <?php

    // defino la fecha pedida en el enunciado
    $mes = 2;
    $anio = 2024;

    // de aqui saco el nombre en String del dia (lines, martes, miercoles...)
    $date = date_create_from_format("d-m-Y", "01-{$mes}-{$anio}");
    $dia = date_format($date, "l");

    // de aqui saco el numero de dias del mes segun el año (bisiestos)
    $diasMes = cal_days_in_month(CAL_JULIAN, date_format($date, "m"), date_format($date, "Y"));

    // necesitare este arrray para empezar el calendari en el dia
    $diasSemana = [
        "Monday" => 1,
        "Tuesday" => 2,
        "Wednesday" => 3,
        "Thursday" => 4,
        "Friday" => 5,
        "Saturday" => 6,
        "Sunday" => 7
    ];

    // variables de apoyo para imprimir
    $empezado = false;
    $dias = 1;
    ?>

    <table class="table table-bordered">
        <tbody>
            <!-- primer th para la cabecera, nobre de dias -->
            <tr>
                <!-- for each para emprimir con el array los nmobre de la semana -->
                <?php foreach ($diasSemana as $nombreDia => $noSirveEstaVariable): ?>
                    <th>
                        <?= $nombreDia ?>
                    </th>
                <? endforeach ?>
            </tr>

            <!-- while para imprimri las filas necesarias (4, 5 o 6) -->
            <?php while ($dias <= $diasMes) { ?>
                <tr>
                    <!-- for each para las 7 celdas de cada semana -->
                    <?php for ($x = 1; $x < 8; $x++) { ?>
                        <td>
                            <!-- if para saber que dia imprime
                                $diasSemana[$dia] == $x, para empezar a imprimir en el dia adecuado
                                $empezado == true, para saber si debe seguir imprimiendo
                                $dias <= $diasMes, para dejar de imprimir en el ultimo dia-->
                            <?php if (( $diasSemana[$dia] == $x || $empezado == true) && $dias <= $diasMes) {
                                $empezado = true;
                                echo "<p>".$dias++."</p>";
                            } ?>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>

        </tbody>
    </table>

    <br>

</body>

</html>