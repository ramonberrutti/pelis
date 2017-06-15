<?php
header('Content-type: application/json');

$data = array();


$data['status'] = 'ok';

$data['movies'] = array();

$data['movies'][] = array( "nombre" => "pepe", 
                            "link" => "http" );

$data['movies'][] = array( "nombre" => "pepe2", 
                            "link" => "http2" );

$data['movies'][] = array( "nombre" => "pepe3", 
                            "link" => "http3" );

echo json_encode($data);

?>