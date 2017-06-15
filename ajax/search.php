<?php
header('Content-type: application/json');

require_once '../util/opendb.php';
$searchTerm = "";
if( isset($_GET['term']) )
{
    $searchTerm = $mysqli->real_escape_string( $_GET['term'] );
}

$data = array();

$data['status'] = 'ok';

$data['data'] = array();

//get matched data from skills table
$fullquery = "SELECT id,nombre,ano FROM peliculas WHERE nombre LIKE '%".$searchTerm."%' ORDER BY nombre ASC LIMIT 5";
$query = $mysqli->query($fullquery);
while ( $row = $query->fetch_assoc() ) 
{
    $link = str_replace(' ', '-', strtolower($row["nombre"]) . " " . $row["ano"]);
    $link = preg_replace('/[^A-Za-z0-9\-]/', '-', $link);
    $link = preg_replace('/-+/', '-', $link);
    $link = "/pelis/film/" . preg_replace('/-+/', '-', $link);

    //$data[] = $row['name']; url, title, year, img
    $data['data'][] = array(  "id" => $row['id'], 
                                "title" => $row['nombre'],
                                "year" => $row['ano'],
                                "url" => $link, 
                                "img" => "/pelis/images.php?id=" .$row['id'] );
}

//return json data
echo json_encode($data);
require_once '../util/closedb.php';
?>