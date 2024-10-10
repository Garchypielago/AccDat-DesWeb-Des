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
    <h2>Ejercicio 05</h2>

    <?php 
    if (isset($_GET['inicio']) && isset($_GET['final']) ) {
        if (is_numeric($_GET['inicio']) && is_numeric($_GET['final']) ) {
            if ($_GET['inicio'] < $_GET['final'] ) {
    
                $a = $_GET['inicio'];
                $b = $_GET['final']; ?>
            
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
                            <?php $a = $_GET['inicio'];
                            $b = $_GET['final']; ?>
            
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
    <?php 
            } else {
                echo "El primer valor es mayor al segundo";
            }

        } else if (!is_numeric($_GET['inicio']) && !is_numeric($_GET['final'])){
            echo "Los valores no son numero";
        } else if (!is_numeric($_GET['inicio'])){
            echo "El primer valor no es un numero";
        } else if (!is_numeric($_GET['final'])){
            echo "El segundo valor no es un numero";
        } 

    }  else if (!isset($_GET['inicio']) && !isset($_GET['final'])){
        echo "No hay valores en la entrda";
    } else if (!isset($_GET['inicio'])){
        echo "No hay valor de primer numero";
    } else if (!isset($_GET['final'])){
        echo "No hay valor de segundo numero";
    } 
    ?>

    
    <br>

</body>

</html>