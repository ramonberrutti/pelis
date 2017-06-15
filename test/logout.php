<?php // Sin usar!!
session_start();
session_destroy();

$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
header("Location: $uri");

?>