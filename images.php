<?php
include_once 'util/opendb.php';

//header('Content-type: image/jpeg');

if( isset($_GET["id"]) )
{
    $id = $mysqli->real_escape_string($_GET['id']);

    $fullquery = "SELECT contenidoimagen,tipoimagen FROM peliculas WHERE id='$id'";
    $query = $mysqli->query($fullquery);

    if( $row = $query->fetch_assoc() )
    {
        header("Content-type: " . $row["tipoimagen"]);
        echo $row["contenidoimagen"];
    }
    else 
    {
        echo "Invalid Id";
    }
}
else 
{
    echo "Missing Id";
}
include_once 'util/closedb.php';
?>