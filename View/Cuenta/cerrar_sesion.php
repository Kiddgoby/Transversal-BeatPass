<?php
session_start();
session_unset();// Borra todas las variables de sesion
session_destroy();// Destruye la sesion
header("Location: inicio.html"); 
exit();
?>
