	<?php
    require_once './util/Film.php';
    require_once './util/Comment.php';

    if( isset($pathRequest[3]) )
    {
        //$result = array_map('strrev', explode('-', strrev($string)));

        $film = explode('-', $pathRequest[3]);
        $year = $film[count($film)-1];

        $userStars = 0;

        $filmQuery = "%";
        for( $i = 0; $i < count($film)-1 ; $i++ )
        {
            $filmQuery .= $film[$i] . "%";
        }

		$fullquery = "SELECT peliculas.id AS id, peliculas.nombre AS nombre, peliculas.ano AS ano, generos.genero AS genero, peliculas.sinopsis AS sinopsis, IFNULL(AVG(NULLIF(comentarios.calificacion,0)),0) AS calificacion FROM peliculas INNER JOIN generos ON peliculas.generos_id=generos.id LEFT OUTER JOIN comentarios ON peliculas.id=comentarios.peliculas_id WHERE peliculas.nombre LIKE '$filmQuery' AND peliculas.ano='$year' GROUP BY peliculas.id LIMIT 1";
        if( $query = $mysqli->query($fullquery) )
        {
            if( $row = $query->fetch_row() )
            {
                $comments = array();

                $fullquery = "SELECT comentarios.id AS id, usuarios.nombreusuario AS nombreusuario, comentarios.calificacion AS calificacion, comentarios.fecha AS fecha, comentarios.comentario AS comentario FROM comentarios INNER JOIN usuarios ON comentarios.usuarios_id=usuarios.id WHERE comentarios.peliculas_id='$row[0]' GROUP BY comentarios.id ORDER BY comentarios.fecha ASC";              
                if( $query = $mysqli->query($fullquery) )
                {
                    while( $row2 = $query->fetch_row()	)
                    {
                        //public function __construct($id, $user, $star, $time, $comment)
                        $comments[] = new Comment($row2[0], $row2[1], $row2[2], $row2[3], $row2[4]);

                        if( $userClass != null && $row2[1] == $userClass->getUsername() )
                        {
                            $userStars = $row2[2];
                        }
                    }
                }

                $filmClass = new Film($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $comments);
            }
        }
        ?>

        <div class="container" id="movie-content">

            <div class="page-header">
                <h1><?php echo $filmClass->getName() . " (". $filmClass->getYear() . ")";?></h1>
            </div>

            <div class="row">

                <div id="mobile-movie-info" class="visible-xs col-xs-12">
                    <h1><?php echo $filmClass->getName();?></h1>
                    <h2><?php echo $filmClass->getYear();?></h2>
                    <h2><?php echo $filmClass->getGenero();?></h2>
                </div>

                <div id="movie-poster" class="col-xs-12 col-sm-3">
                    <img class="img-responsive" src="/pelis/images.php?id=<?php echo $filmClass->getId(); ?>" alt="<?php echo $filmClass->getName() . " (". $filmClass->getYear() . ")";?>">
                </div>

                <div id="movie-info" class="col-xs-12 col-sm-8 col-md-7 col-lg-9" data-movie-id="<?php echo $filmClass->getId(); ?>">
                    <div class="hidden-xs">
                        <h1><?php echo $filmClass->getName();?></h1>
                        <h2><?php echo $filmClass->getYear();?></h2>
                        <h2><?php echo $filmClass->getGenero();?></h2>
                    </div>
                    <div class="rating-row">
                    <span id="rating-span"><?php echo round($filmClass->getAvgStar(),1);?></span>
                    <span class="hidden-xs icon-star"></span>
                    </div>
                    <div class="star-row">
                    <?php //check if user comment film 
                    for( $i = 1 ; $i <= 5; $i++ )
                    { ?>
                        <span id="<?php echo $i; ?>" class="glyphicon glyphicon-star" <?php echo ($i <= $userStars) ? "style=\"color:#BBD41C\"" : ""; ?>></span>
                    <?php } ?>
                    </div>
                    <span><?php echo $filmClass->getSinopsis();?></span>

                </div>
            </div>

            <div class="row">
            <div class="col-md-12">
            <h2 class="page-header">Comments</h2>
            <section class="comment-list">

                <?php // http://bootsnipp.com/snippets/featured/comment-posts-layout
                $cantComments = count($filmClass->getComments());
                $commentLeft = false;
                for( $i = 0; $i < $cantComments; $i++)
                {
                    $comment = $filmClass->getComments()[$i];
                    if( strlen($comment->getComment()) > 0 )
                    {
                    ?>
                <article id="<?php echo $comment->getId(); ?>" class="row">
                    <div class="col-md-10 col-sm-10">
                    <div class="panel panel-default arrow <?php echo ($commentLeft = !$commentLeft) ? "left" : "right" ?>">
                        <div class="panel-body">
                            <header class="text-left">
                                <div class="comment-user"><span class="glyphicon glyphicon-user"></span> <?php echo $comment->getUser(); ?></div>
                                <?php if( $comment->getStar() > 0 )
                                {?>
                                    <div class="comment-star"><span class="glyphicon glyphicon-star"></span> <?php echo $comment->getStar(); ?></div>
                                <?php } ?>
                                <div class="comment-date"><span class="glyphicon glyphicon-time"></span> <?php echo date('H:i d/m/y', strtotime($comment->getTime())); ?></div>
                            </header>
                            <div class="comment-post">
                                <p><?php echo $comment->getComment(); ?></p>
                            </div>
                        </div>
                    </div>
                    </div>
                </article>
                <?php
                    }
                }?>

                <?php
                // Modificar esto YA!!
                if( $userClass != null )
                {
                    echo "<textarea id=\"comment-form\" class=\"form-control\" rows=\"3\" placeholder=\"Comentario...\"></textarea>";
                } ?>

            </section>
            </div>
            </div>

        </div>
<?php
    }
?>