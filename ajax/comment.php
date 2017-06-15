<?php
header('Content-type: application/json');
session_start();
require_once '../util/opendb.php';

$data = array();
//$data['data'] = array();

if( isset($_POST["id"]) && isset($_POST["comment"]) && isset($_SESSION["username"]))
{
    $username   = $_SESSION["username"];
    $id         = $mysqli->real_escape_string($_POST["id"]);
    $comment    = $mysqli->real_escape_string($_POST["comment"]);

    $fullquery = "SELECT usuarios.id, peliculas.id FROM usuarios, peliculas WHERE usuarios.nombreusuario='$username' AND  peliculas.id='$id' LIMIT 1";
    $query = $mysqli->query($fullquery);
    if( $query = $mysqli->query($fullquery) && $row = $query->fetch_row() )
    {
        $userid = $row[0];
        $filmid = $row[1]; // This is Stupid!!

        // For last insert id: http://stackoverflow.com/questions/778534/mysql-on-duplicate-key-last-insert-id
        $fullquery = "INSERT INTO comentarios (comentario, peliculas_id, usuarios_id, calificacion) VALUES ( '$comment', '$filmid', '$userid', '0') ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id), comentario='$comment', fecha=now()";
        if( $query = $mysqli->query($fullquery) )
        {
            $commentid = $mysqli->insert_id;

            // Se puede juntar con la query de arriba, por simplicidad por ahora queda asi!!
            $fullquery = "SELECT comentario, calificacion, fecha FROM comentarios WHERE id='$commentid' LIMIT 1";
            if( $query = $mysqli->query($fullquery) )
            {
                if( $row2 = $query->fetch_row() )
                {
                    $data['status'] = 'ok';
                    $data['data'] = array(  "id" => $commentid,
                                            "userid" => $userid,
                                            "username" => $username,
                                            "comment" => $row2[0],
                                            "stars" => $row2[1],
                                            "time" => $row2[2] );
                }
            }
            else 
            {
            }
        }
    }
    else 
    {
        $data['status'] = 'error';
        $data['msg'] = 'Invalid Movie Id';
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