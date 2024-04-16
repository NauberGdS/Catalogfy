<?php

session_start();
// remove all session variables
session_unset();
// destroy the session
session_destroy();

session_write_close();

setcookie(session_name(),'',0,'/');

session_regenerate_id(true);

header('Location: painel.php');

?>