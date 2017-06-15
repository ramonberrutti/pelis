<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once 'lang/lang.php';
    require_once 'util/opendb.php';
    require_once 'util/User.php';
    session_start(); 
    $pathRequest = explode( '/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) );
    $pathToIndex = $pathRequest[0] . '/' . $pathRequest[1];

    //file_put_contents('./log_'.date("j.n.Y").'.txt', json_encode($pathRequest) . "\n", FILE_APPEND);
    if( $pathRequest[2] == "logout" )
    {
        session_destroy();
        header("Location: $pathToIndex"); // No se si esto esta bueno!!
    }

    $userClass = null;
    if( isset($_SESSION["username"]) )
    {
        $username = $_SESSION["username"];

        $fullquery = "SELECT id,nombre,apellido,nombreusuario,email,administrador FROM usuarios WHERE nombreusuario='$username' LIMIT 1";
        $query = $mysqli->query($fullquery);
        if( $row = $query->fetch_row() ) 
        {
            $userClass = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
        }
        else 
        {
            session_destroy();
        }
    }
    
    ?>
    <title><?php echo $lang['PAGE_TITLE']; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="<?php echo $lang['PAGE_DESCRIPTION']; ?>">
    <link rel="stylesheet" href="<?php echo $pathToIndex; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $pathToIndex; ?>/css/styles.css">
</head>
<body>
    <?php require 'contents/header.php' ?>
    <?php require 'contents/login.php' ?>
    <div class="container home-content" role="main">
	<div class="ac-results hidden-sm hidden-xs">
		<ul></ul>
	</div>
	<div class="jumbotron">
		<h1><?php echo $lang['PAGE_PAGE_TITLE']; ?></h1>
		<p><?php echo $lang['PAGE_DESCRIPTION']; ?></p>
	</div>
    <?php // Rutas... Cambiar esto, cadena de IF!!! OMG!!!
    if( $pathRequest[2] == "film" )
    {
        require_once 'contents/film.php';
    }
    else if( $pathRequest[2] == "user" )
    {
        require_once 'contents/user.php';
    }
    else if( $pathRequest[2] == "admin" )
    {
        if( $userClass != null && $userClass->isAdmin() )
            require_once 'contents/admin.php';        
    }
    else
    {
        require_once 'contents/main.php';
    }
    
    ?>
    </div>
    <?php //require 'footer.php' ?>
    <script type="text/javascript" src="<?php echo $pathToIndex; ?>/js/jquery-3.2.0.js"></script>
    <script type="text/javascript" src="<?php echo $pathToIndex; ?>/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo $pathToIndex; ?>/js/scripts.js"></script>
</body>
</html>