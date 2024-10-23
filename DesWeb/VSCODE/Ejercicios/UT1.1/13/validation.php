<?php 
include "users.php";

// $users = array_keys($usersPasswords);


function valUser($value)
{
    if (!empty($value) && is_string($value)) {
        global $usersPasswords;
        if (array_key_exists($value, $usersPasswords)) {
            return $value;
        }
    }
    return false;
} 

function valPass($valuePass, $valueUser)
{
    if (!empty($valuePass) && is_string($valuePass)) {
        global $usersPasswords;
        if ($usersPasswords[$valueUser]==$valuePass) {
            return $valuePass;
        }
    }
    return false;
} 

?>