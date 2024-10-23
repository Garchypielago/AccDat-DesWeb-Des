<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .titulo {
            background-color: grey !important;
            text-align : center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Ej09 - PIZZA</h1>
    </header>

    <body>
        <?php
        $TipoMasa = isset($_POST['tipomasa']) ? $_POST['tipomasa'] : null;
        $Tamano = isset($_POST['tamaño']) ? $_POST['tamaño'] : null;
        $Base = isset($_POST['base']) ? $_POST['base'] : null;
        $Nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $Direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
        $Telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
        $Pago = isset($_POST['pago']) ? $_POST['pago'] : null;
        
        $Obligatorias = [
            "Tipo de masa" => $TipoMasa,
            "Tamaño" => $Tamano,
            "Base" => $Base,
            "Nombre" => $Nombre,
            "Direccion" => $Direccion,
            "Teléfono" => $Telefono,
            "Método de pago" => $Pago];

        
        $Apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
        $Observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;

        $Extras = isset($_POST['extras']) ? $_POST['extras'] : null;


        ?>

        <?php
        if (isset($TipoMasa) && isset($Tamano) && isset($Base) 
                && isset($Nombre) && isset($Direccion) && isset($Telefono) && isset($Pago)){
        ?>
        
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th rowspan="1" class="titulo" >Pedido nº001</th>
                        <td class="titulo" ></td>
                    </tr>
                    <tr>
                        <th>Tipo de masa</th>
                        <td><?php echo $TipoMasa ?></td>
                    </tr>
                    <tr>
                        <th>Tamaño</th>
                        <td><?php echo $Tamano?></td>
                    </tr>
                    <tr>
                        <th>Base</th>
                        <td><?php echo $Base?></td>
                    </tr>
                    <tr>
                        <th>Extras</th>
                        <td><?php 
                        foreach ($Extras as $extras){
                            echo "{$extras}   ";
                        }
                        ?></td>
                    </tr>
                    <tr>
                        <th>Observaciones</th>
                        <td><?php echo $Observaciones?></td>
                    </tr>
                    <tr>
                        <th rowspan="1" class="titulo" >Datos cliente</th>
                        <td class="titulo" ></td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <td><?php echo $Nombre?></td>
                    </tr>
                    <tr>
                        <th>Apellidos</th>
                        <td><?php echo $Apellidos?></td>
                    </tr>
                    <tr>
                        <th>Direccion</th>
                        <td><?php echo $Direccion?></td>
                    </tr>
                    <tr>
                        <th>Telefono</th>
                        <td><?php echo $Telefono?></td>
                    </tr>
                    <tr>
                        <th>Método de pago</th>
                        <td><?php echo $Pago?></td>
                    </tr>
                </tbody>
            </table>



        
            
        <?php   
        } else{
            foreach ($Obligatorias as $nulos => $valores){
                if ($valores === null || $valores == ""){
                    echo "<p>{$nulos} no esta definido.</p>";
                }
            }
        }
        ?>


    </body>
    
</body>
</html>