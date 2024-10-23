<?php

// ID: 4, Nombre: Ana Martinez, Email: ana.martinez@example.com
// ID: 3, Nombre: Carlos Gomez, Email: carlos.gomez@example.com
// ID: 5, Nombre: Luis Torres, Email: luis.torres@example.com
// ID: 2, Nombre: Maria Lopez, Email: maria.lopez@example.com
// ID: 6, Nombre: Nuevo Usuario, Email: new.user@example.com
// ID: 1, Nombre: Usuario Actualizado, Email: updated.user@example.com

require_once __DIR__ . '/../data-access/CalendarDataAccess.php';
require_once __DIR__ . '/../entities/User.php';
require_once __DIR__ . '/../entities/Event.php';
require_once __DIR__ . '/SecUtils.php';

$dbFile = __DIR__ . '/calendar.db';
$calendarDataAccess = new CalendarDataAccess($dbFile);


// val el email para que no nos hackeen
function ValLoginEmail($a)
{
    die("estoy");
    if (!empty($value) && is_string($value)) {
        $sanitized_a = filter_var($a, FILTER_SANITIZE_EMAIL);
        if (filter_var($sanitized_a, FILTER_VALIDATE_EMAIL)) {

            global $calendarDataAccess;
            if ( $calendarDataAccess->getUserByEmail($sanitized_a) != null ) {
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

        if ($user->getPassword() == $sanitized_a) {
            return $valuePass;
        }
    }
    return false;
}




// para ver que la contra es a corde a lo puesto
function valRegPassword($password)
{
    // Verificar longitud
    if (strlen($password) < 8 || strlen($password) > 64) {
        return "La contraseña debe tener entre 8 y 64 caracteres.";
    }

    // Verificar letra mayúscula
    if (!preg_match('/[A-Z]/', $password)) {
        return "La contraseña debe tener al menos una letra mayúscula.";
    }

    // Verificar letra minúscula
    if (!preg_match('/[a-z]/', $password)) {
        return "La contraseña debe tener al menos una letra minúscula.";
    }

    // Verificar número
    if (!preg_match('/[0-9]/', $password)) {
        return "La contraseña debe tener al menos un número.";
    }

    // Verificar carácter especial
    if (!preg_match('/[\W_]/', $password)) {
        return "La contraseña debe tener al menos un carácter especial.";
    }

    // Verificar que no tenga espacios
    if (preg_match('/\s/', $password)) {
        return "La contraseña no debe contener espacios.";
    }

    return true; // Si pasa todas las validaciones
}
