<?php

require_once __DIR__ . "/db.php";


// Login validaciones: 

// val el email para que no nos hackeen
function ValLoginEmail($a)
{
    if (!empty($a) && is_string($a)) {
        $sanitized_a = filter_var($a, FILTER_SANITIZE_EMAIL);
        if (filter_var($sanitized_a, FILTER_VALIDATE_EMAIL)) {

            global $calendarDataAccess;
            if ($calendarDataAccess->getUserByEmail($sanitized_a) != null) {
                return $sanitized_a;
            }
        }
    }
    return false;
}
// val la pass para que no nos hackeen
function ValLoginPass($valuePass, $valueUser)
{
    if (!empty($valuePass) && is_string($valuePass)) {

        global $calendarDataAccess;
        $user = $calendarDataAccess->getUserByEmail($valueUser);

        $sanitized_a = filter_var($valuePass, FILTER_SANITIZE_SPECIAL_CHARS);

        if (password_verify($sanitized_a, $user->getPassword())) {
            return $valuePass;
        }
    }
    return false;
}

// 
// Register validaciones:

// para ver que la contra es a corde a lo puesto
function valRegPassword($password, $passwordCheck)
{

    if (empty($password) || !is_string($password)) {
        return "La contraseña esta vacía.";
    }

    $sanitized_a = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);

    if ($sanitized_a != $password) {
        return "La contraseña no admite este formato por seguriddad.";
    }

    // Verificar longitud
    if (strlen($sanitized_a) < 8) {
        return "La contraseña debe tener al menos 8 caracteres.";
    }

    // Verificar letra
    if (!preg_match('/[A-Za-z]/', $sanitized_a)) {
        return "La contraseña debe tener al menos una letra.";
    }

    // Verificar número
    if (!preg_match('/[0-9]/', $sanitized_a)) {
        return "La contraseña debe tener al menos un número.";
    }

    // Verificar ningun carcater especial oespacios
    if (!preg_match('/^[A-Za-z0-9]+$/', $sanitized_a)) {
        return "La contraseña debe tener al menos un carácter especial.";
    }

    if ($sanitized_a != $passwordCheck) {
        return "Las contraseñas debe coincidir.";
    }

    return $sanitized_a; // Si pasa todas las validaciones
}

// val el email de registro
function ValRegEmail($a)
{
    // die("estoy");
    if (empty($a) || !is_string($a)) {
        return "El usuario esta vacío";
    }

    $sanitized_a = filter_var($a, FILTER_SANITIZE_EMAIL);
    if ($sanitized_a != $a && filter_var($sanitized_a, FILTER_VALIDATE_EMAIL)) {
        return "El usuario no admite este formato por seguridad.";
    }

    global $calendarDataAccess;
    if ($calendarDataAccess->getUserByEmail($sanitized_a) != null) {
        return "Usuario ya registrado en la plataforma.";
    }

    return $sanitized_a;
}

// val resto de campos string
function ValRegFirstName($a)
{
    if (empty($a) || !is_string($a)) {
        return "El nombre esta vacío";
    }
    $sanitized_a = filter_var($a, FILTER_SANITIZE_SPECIAL_CHARS);
    if ($sanitized_a != $a) {
        return "El nombre no admite este formato por seguridad.";
    }
    return $sanitized_a;
}
function ValRegLastName($a)
{
    if (empty($a) || !is_string($a)) {
        return "Los apellidos estan vacíos";
    }
    $sanitized_a = filter_var($a, FILTER_SANITIZE_SPECIAL_CHARS);
    if ($sanitized_a != $a) {
        return "Los apellidos no admiten este formato por seguridad.";
    }
    return $sanitized_a;
}
function ValRegBirthDate($cumple)
{
    // die($cumple);
    if (empty($cumple) || !is_string($cumple)) {
        return "Fecha de nacimiento esta vacío";
    }

    $datos = explode("-", $cumple);
    if (!checkdate($datos[1], $datos[2], $datos[0])) {
        return "Fecha de nacimiento no válida.";
    }
    return $cumple;
}
