<?php
header('Content-type: application/json');
session_start();

require_once '../util/opendb.php';
$data = array();

if( isset($_POST['username']) && isset($_POST['password']) )
{
    $username = $mysqli->real_escape_string( $_POST['username'] );
    $password = $mysqli->real_escape_string( $_POST['password'] );


    $fullquery = "SELECT id FROM usuarios WHERE nombreusuario='$username' AND password='$password'";
    $query = $mysqli->query($fullquery);

    if( $query->num_rows == 1 )
    {
        $data['status'] = 'ok';
        $_SESSION['username'] = $username;
    }
    else 
    {
        $data['status'] = 'error';
        $data['message'] = 'Invalid Username';
    }
}

//return json data
echo json_encode($data);
require_once '../util/closedb.php';
?>