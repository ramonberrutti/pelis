<?php
header('Content-type: application/json');
require_once '../util/opendb.php';

$data = array();
$data['data'] = array();

if( isset($_GET["id"]) && $_GET["id"] > 0 )
{

    $id = $mysqli->real_escape_string( $_GET["id"] );

    $fullquery = "SELECT peliculas.id AS id, peliculas.nombre AS nombre, peliculas.ano AS ano, generos.id AS generoid, generos.genero AS genero, ROUND(IFNULL(AVG(NULLIF(comentarios.calificacion,0)),0),1) AS calificacion FROM peliculas INNER JOIN generos ON peliculas.generos_id=generos.id LEFT OUTER JOIN comentarios ON peliculas.id=comentarios.peliculas_id WHERE peliculas.id='$id' GROUP BY peliculas.id LIMIT 1";
    if( $query = $mysqli->query($fullquery) )
    {
        if( $row = $query->fetch_assoc() )
        {
            $data['status'] = "ok";
            $data['data']   = $row;
        }
        else 
        {
            $data['status'] = "error";
            $data['msg'] = "Invalid Id";
        }
    }
    else 
    {
        $data['status'] = "error";
        $data['msg'] = "Invalid Query";
    }
}
else 
{
    $fullquery = "SELECT peliculas.id AS id, peliculas.nombre AS nombre, peliculas.ano AS ano, generos.id AS generoid, generos.genero AS genero, ROUND(IFNULL(AVG(NULLIF(comentarios.calificacion,0)),0),1) AS calificacion FROM peliculas INNER JOIN generos ON peliculas.generos_id=generos.id LEFT OUTER JOIN comentarios ON peliculas.id=comentarios.peliculas_id GROUP BY peliculas.id";
    if( $query = $mysqli->query($fullquery) )
    {
        while( $row = $query->fetch_assoc() )
        {
            $data['status'] = "ok";
            $data['data'][]   = $row;

        }
    }
    else 
    {
        $data['status'] = "error";
        $data['msg'] = "Invalid Query";
    }
}

//return json data
echo json_encode($data);
require_once '../util/closedb.php';
?>