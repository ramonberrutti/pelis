<?php
header('Content-type: application/json');
session_start(); // Register and autologin!!

require_once '../util/opendb.php';
$data = array();

if( isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && 
    isset($_POST['username'])  && isset($_POST['password']) && isset($_POST['password_confirmation']) )
{
    $firstname              = $mysqli->real_escape_string( $_POST['firstname'] );
    $lastname               = $mysqli->real_escape_string( $_POST['lastname'] );
    $username               = $mysqli->real_escape_string( $_POST['username'] );
    $email                  = $mysqli->real_escape_string( $_POST['email'] );
    $password               = $mysqli->real_escape_string( $_POST['password'] );
    $password_confirmation  = $mysqli->real_escape_string( $_POST['password_confirmation'] );


    // -------------> Check Data!!


    // <------------- Check Data!!

    if( !strcmp($password, $password_confirmation) )
    {
        //$fullquery = "SELECT id FROM usuarios WHERE nombreusuario='$username' AND password='$password'";
        $fullquery = "INSERT INTO usuarios (nombre, apellido, nombreusuario, email, password) VALUES ('$firstname', '$lastname', '$username', '$email', '$password')";
        if( $query = $mysqli->query($fullquery) )
        {
            $data['status'] = 'ok';
        }
        else 
        {
            $data['status'] = 'error';
            $data['message'] = 'Db Error';
        }
    }
    else 
    {
            $data['status'] = 'error';
            $data['message'] = 'No coinciden las contraseñas';
    }
}

//return json data
echo json_encode($data);
require_once '../util/closedb.php';
?>