<?php


    $langchar = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

    $lang = array();

    require_once 'lang.en.php';

    //echo dirname(__FILE__) . '/lang.' . $langchar . '.php';
    if( file_exists( dirname(__FILE__) . '/lang.' . $langchar . '.php' ) )
    {
        require_once 'lang.' . $langchar . '.php';
    }

    /*switch( $lang )
    {
        case 'en':
            require_once 'lang.en.php';
        break;

        case 'es':
            require_once 'lang.es.php';
        break;

        case 'pt':
            require_once 'lang.pt.php';
        break;

        default:
            require_once 'lang.en.php';
        
    }*/


?>