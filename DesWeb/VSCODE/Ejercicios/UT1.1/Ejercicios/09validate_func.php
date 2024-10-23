<?php


function valMasa($value){
    $array = ["F","G","Q","SG"];
    
    if (in_array($value, $array)) {
        return $value;
    } else {
        return false;
    }
}

function valTamano($value){
    $array = ["S","M","L","XL"];
    
    if (in_array($value, $array)) {
        return $value;
    } else {
        return false;
    }
}

function valBase($value){
    $array = ["BQQ","M","C"];
    
    if (in_array($value, $array)) {
        return $value;
    } else {
        return false;
    }
}

function valPago($value){
    $array = ["T","B","P"];
    
    if (in_array($value, $array)) {
        return $value;
    } else {
        return false;
    }
}

function valTelefono($value){
    if (is_numeric($value)) {
        if (is_int((int)$value)) {
            if (strlen((string)$value) == 9){
                return $value;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}



?>