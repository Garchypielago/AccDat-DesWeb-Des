<?php


function valNomApe($value)
{
    if (!empty($value) && is_string($value)) {
        if (strlen((string)$value) > 10) {
            return $value;
        }
    }
    return false;
}

function valEdad($value)
{
    if (!empty($value) && is_numeric($value)) {
        if (is_int((int)$value) && $value >= 18 && $value <= 70) {
            return $value;
        }
    }
    return false;
}

/* function valDocumento($value)
{
    $name = $value['name'];
    $size = $value['size'];

    if ($size > 1048576*2) {
        if ($name.include(".pdf")){
            return $value;
        }
    }
    return false;
} */
