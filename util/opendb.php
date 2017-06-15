<?php

//$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql');
//mysql_select_db($dbname);

require_once 'config.php';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);
//Seguridad Baby!!
unset($dbhost);
unset($dbport);
unset($dbuser);
unset($dbpass);
unset($dbname);

if ($mysqli->connect_errno) 
{
    echo "Error to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>