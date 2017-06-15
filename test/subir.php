<?php // Prueba para Cargar Imagenes
include_once '../opendb.php';

if( isset( $_POST['name']) )
{
    $name = $mysqli->real_escape_string( $_POST['name'] );
    $year = $mysqli->real_escape_string( $_POST['year'] );

    $image = $mysqli->real_escape_string( file_get_contents($_FILES['image']['tmp_name']) );
    $imagetype = $mysqli->real_escape_string( $_FILES['image']['type'] );

    $fullquery = "INSERT INTO peliculas (nombre, ano, generos_id, sinopsis, contenidoimagen, tipoimagen) VALUES ('$name','$year','1', 'sino','$image','$imagetype')";
   
    if( $query = $mysqli->query($fullquery) )
    {
        echo "Peliculas guardada";
    }

}
?>
<form action="/pelis/test/subir.php" method="POST" enctype="multipart/form-data" style="display:inline">
    <label>Nombre: </label><input type=text name="name" />
    <label>Año: </label><input type=text name="year" />
    <label>File: </label><input type="file" name="image" />
    <input type="submit" />
</form>