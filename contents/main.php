
	<div class="page-header">
		<h1><?php echo $lang['PAGE_TITLE'];?></h1>
	</div>

	<div class="row">
	<?php
		$page = 1;
		if( isset( $_GET["page"] ) )
		{
			$page = $_GET["page"];
		}

		$fullquery = "SELECT COUNT(peliculas.id) AS cant FROM peliculas";
		$query = $mysqli->query($fullquery);

		$cant = $query->fetch_assoc()["cant"];
		$cantPage = ceil( $cant / 5.0 );
		$firstId = (($page-1) * 5);

		$fullquery = "SELECT peliculas.id AS id, peliculas.nombre AS nombre, peliculas.ano AS ano, generos.genero AS genero, IFNULL(AVG(NULLIF(comentarios.calificacion,0)),0) AS calificacion FROM peliculas INNER JOIN generos ON peliculas.generos_id=generos.id LEFT OUTER JOIN comentarios ON peliculas.id=comentarios.peliculas_id GROUP BY peliculas.id LIMIT $firstId, 5";
		$query = $mysqli->query($fullquery);

		while( $row = $query->fetch_assoc()	)
		{
			$link = str_replace(' ', '-', strtolower($row["nombre"]) . " " . $row["ano"]);
			$link = preg_replace('/[^A-Za-z0-9\-]/', '-', $link);
			$link = "film/" . preg_replace('/-+/', '-', $link);
			//$stars = 0;
			/*if( isset($row["calificacion"]) )
			{*/
				//$stars = number_format((float)$row["calificacion"], 1, '.', '');
				$stars = round($row["calificacion"], 1);
			//}

	?>
			<div class="browse-movie-wrap col-md-15 col-xs-3">
				<a href="<?php echo $link; ?>" class="browse-movie-link">
					<figure>
						<img class="img-responsive" src="<?php echo $pathToIndex; ?>/images.php?id=<?php echo $row["id"]; ?>" alt="<?php echo $row["nombre"]; ?>" width="210" height="315">
						<figcaption class="hidden-xs hidden-sm">
							<span class="glyphicon glyphicon-star" style="color:green"></span>
							<h4 class="rating"><?php echo $stars; ?>  / 5</h4>
							<h4><?php echo $row["genero"]; ?></h4>
							<span class="button-green"><?php echo $lang['VIEW_DETAILS']; ?></span>
						</figcaption>
					</figure>
				</a>

				<div class="browse-movie-bottom">
					<a href="<?php echo $pathToIndex; ?>/<?php echo $link; ?>" class="browse-movie-title"><?php echo $row["nombre"]; ?></a>
					<div class="browse-movie-year"><?php echo $row["ano"]; ?></div>
				</div>

			</div>

		<?php } ?>
	</div>

	<div class="text-center">
		<nav aria-label="Page navigation">
  			<ul class="pagination">
   				<li>
      				<a href="/pelis" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
    			</li>
				<?php
				$pp = 5;
				if( ($page + 5) >= $cantPage )
				{
					$pp = 10 - ($cantPage - $page);
				}

				$pp = max($page - $pp ,1);
				for( $p = $pp; $p <= $pp+10 && $p <= $cantPage; $p++ )
				{
					if( $p == $page )
					{
						echo "<li class=\"active\"><a href=\"?page=$p\">$p</a></li>";
					}
					else 
					{
						echo "<li><a href=\"?page=$p\">$p</a></li>";
					}
				}
				?>
				<li>
					<a href="<?php echo $pathToIndex; ?>?page=<?php echo $cantPage; ?>" aria-label="Next">
        				<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>