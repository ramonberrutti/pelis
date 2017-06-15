<?php
header('Content-type: application/json');
session_start();

$data = array();
$data['data'] = array();

if( isset($_POST["action"]) && isset($_SESSION["username"]) )
{
    require_once '../util/opendb.php';

    $username = $_SESSION["username"];

    $fullquery = "SELECT administrador FROM usuarios WHERE nombreusuario='$username' LIMIT 1";
    $query = $mysqli->query($fullquery);
    if( $row = $query->fetch_row() ) 
    {
        if( $row[0] == 1 )
        {
            $action = $_POST["action"];

            if( $action == "addgenero" )
            {
                if( isset($_POST["genero"]) )
                {
                    $genero = $_POST["genero"];

                    $fullquery = "INSERT INTO generos (genero) VALUES ('$genero')";
                    if( $query = $mysqli->query($fullquery) )
                    {
                        $data['status'] = "ok";
                        $data['data'] = array("id" => $mysqli->insert_id);
                    }
                    else
                    {
                        $data['status'] = "error";
                    }
                }
            }
            elseif( $action == "delgenero" )
            {
                if( isset($_POST["id"]) )
                {
                    $generoid = $_POST["id"];

                    $fullquery = "DELETE FROM generos WHERE id='$generoid'";
                    if( $query = $mysqli->query($fullquery) )
                    {
                        $data['status'] = "ok";
                    }
                    else
                    {
                        $data['status'] = "error";
                    }
                }
                else if( isset($_POST["genero"]) )
                {
                    $genero = $_POST["genero"];

                    $fullquery = "DELETE FROM generos WHERE genero='$genero'";
                    if( $query = $mysqli->query($fullquery) )
                    {
                        $data['status'] = "ok";
                    }
                    else
                    {
                        $data['status'] = "error";
                    }
                }
            }
            else if( $action == "addfilm")
            {
                /* https://abandon.ie/notebook/simple-file-uploads-using-jquery-ajax */
                if( isset($_POST["name"]) && isset($_POST["year"]) && isset($_POST["generoid"]) && isset($_POST["sinopsis"]) && isset($_FILES['image']) )
                {
                    $name       = $mysqli->real_escape_string( $_POST["name"] );
                    $year       = $mysqli->real_escape_string( $_POST["year"] );
                    $generoid   = $mysqli->real_escape_string( $_POST["generoid"] );
                    $sinopsis   = $mysqli->real_escape_string( $_POST["sinopsis"] );

                    $image      = $mysqli->real_escape_string( file_get_contents($_FILES['image']['tmp_name']) );
                    $imagetype  = $mysqli->real_escape_string( $_FILES['image']['type'] );

                    $fullquery = "INSERT INTO peliculas (nombre, ano, generos_id, sinopsis, contenidoimagen, tipoimagen) VALUES ('$name','$year','$generoid', '$sinopsis','$image','$imagetype')";
                    if( $query = $mysqli->query($fullquery) )
                    {
                        $data['status'] = "ok";
                        $data['data'] = array("id" => $mysqli->insert_id);
                    }
                    else
                    {
                        $data['status'] = "error";
                    }
                }
            }
            else if( $action == "delfilm" )
            {
                if( isset($_POST["id"]) )
                {
                    $filmid       = $mysqli->real_escape_string( $_POST["id"] );

                    $fullquery = "DELETE FROM peliculas WHERE id='$filmid'";
                    if( $query = $mysqli->query($fullquery) )
                    {
                        $data['status'] = "ok";
                    }

                }
            }
        }
        else
        {
            $data['status'] = "error";
            $data['msg'] = "No Admin!";
        }
    }

    require_once '../util/closedb.php';
}
else 
{
    $data['status'] = "error";
    $data['msg'] = "No Action or Not Login!";
}

//return json data
echo json_encode($data);
?>