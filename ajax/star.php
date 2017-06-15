<?php
header('Content-type: application/json');
session_start();
require_once '../util/opendb.php';

$data = array();
//$data['data'] = array();

if( isset($_POST["id"]) && isset($_POST["stars"]) && isset($_SESSION["username"]))
{
    $username = $_SESSION["username"];
    $id       = $mysqli->real_escape_string($_POST["id"]);
    $stars    = $mysqli->real_escape_string($_POST["stars"]);

    if( $stars > 0 && $stars < 6 )
    {
        $fullquery = "SELECT usuarios.id, peliculas.id FROM usuarios, peliculas WHERE usuarios.nombreusuario='$username' AND  peliculas.id='$id'";
        $query = $mysqli->query($fullquery);
        if( $query = $mysqli->query($fullquery) && $row = $query->fetch_row() )
        {
            $userid = $row[0];
            $filmid = $row[1]; // This is Stupid!!

            $fullquery = "INSERT INTO comentarios (comentario, peliculas_id, usuarios_id, calificacion) VALUES ( '', '$filmid', '$userid', '$stars') ON DUPLICATE KEY UPDATE calificacion='$stars'";
            $query = $mysqli->query($fullquery);

            $fullquery = "SELECT IFNULL(AVG(NULLIF(calificacion,0)), 0) FROM comentarios WHERE peliculas_id='$filmid'";
            if( $query = $mysqli->query($fullquery)  )
            {
                $row = $query->fetch_row();
                $data['status'] = 'ok';
                $data['data'] = array( "avg" => round($row[0],1));
            }
        }
    }
    else 
    {
        $data['status'] = 'error';
        $data['msg'] = 'Invalid Stars';
    }
}
else if( isset($_POST["id"]) ) // Return cant Stars!!
{
    $id       = $mysqli->real_escape_string($_POST["id"]);

    $fullquery = "SELECT IFNULL(AVG(NULLIF(calificacion,0)), 0) FROM comentarios WHERE peliculas_id='$filmid'";
    if( $query = $mysqli->query($fullquery)  )
    {
        if( $row = $query->fetch_row() )
        {
            $data['status'] = 'ok';
            $data['data'] = array( "avg" => round($row[0],1));
        }
        else 
        {
            $data['status'] = 'error';
            $data['msg'] = 'Invalid Film Id';
        }
    }

}
else 
{
    $data['status'] = 'error';
    $data['msg'] = 'Invalid Params or Not Login';
}

//return json data
echo json_encode($data);
require_once '../util/closedb.php';
?>