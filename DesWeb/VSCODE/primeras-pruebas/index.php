<!DOCTYPE html>
<html lang="en">
<?php
$nombre = "Alejandro";
$apellidos = "Garcia Sanchez";
$edad = 23;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Mi primera pag PHP chaval</h1>
    <p>Mas facil</p>
    <p>
        Primera Opcion:
        <?php
        echo $nombre;
        ?>
    </p>
    <p>Segunda Opcion: <?php echo $nombre; ?></p>
    <p>Tercera Opcion: <?php print $nombre; ?></p>
    <p>Cuarta Opcion: <?php print $nombre; ?> <?php print $apellidos; ?></p>
    <p>Quinta Opcion: <?php echo $nombre, ' ', $apellidos; ?></p>
    <p>Sexta Opcion: <?php printf('%s-%s', $nombre, $apellidos); ?></p>
    <p>Septima Opcion: <?= $nombre, ' ', $apellidos; ?></p>

    <?php if ($edad >= 18) { ?>
        <p>Eres mayor de edad</p>
    <?php } else { ?>
        <p>No eres mayor de edad</p>
    <?php } ?>

    <?php if ($edad >= 18) {
        echo '<p>Confirmo, eres mayor de edad</p>';
    } else {
        echo '<p>Confirmo, no eres mayor de edad</p>';
    } ?>

    <?php 
    var_dump($edad);
    echo "\n";
    print_r($apellidos);
    ?>

</body>

</html>