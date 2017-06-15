    <div class="conteiner">
        <ul class="nav nav-tabs">
			<li class="active"><a href="#filmstab" data-toggle="tab">Films</a></li>
			<li><a href="#generostab" data-toggle="tab">Generos</a></li>
			<li><a href="#userstab" data-toggle="tab">Users</a></li>
		</ul>
        
        <div class="tab-content">
                <!-- Modal Add Movie-->
                <div class="modal fade" id="modaladdmovie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Add Movie</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/pelis/ajax/admin" method="POST" enctype="multipart/form-data">
                            <div class="input-group">
                            <span class="input-group-addon" style="max-width:75px">Nombre</span>
                            <input id="addname" type="text" class="form-control" placeholder="Nombre" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group">
                            <span class="input-group-addon" style="min-width:75px">Año</span>
                            <input id="addyear" type="text" class="form-control" placeholder="Año" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group">
                            <span class="input-group-addon" style="min-width:75px">Genero</span>
                            <input id="addgene" type="text" class="form-control" placeholder="Genero" aria-describedby="basic-addon1">
                            </div>

                            <div class="input-group">
                            <span class="input-group-addon" style="max-width:75px">Sinopsis</span>
                            <textarea id="addsinop" class="form-control" rows="3" placeholder="Sinopsis..."  aria-describedby="basic-addon1"></textarea>
                            </div>

                            <div class="input-group image-preview">
                                <input type="text" class="form-control image-filename" disabled="disabled">
                                <span class="input-group-btn">
                                    <div class="btn btn-default image-preview-input">
                                        <span class="glyphicon glyphicon-folder-open"></span>
                                        <span class="image-preview-input-title">Browse</span>
                                        <input type="file" accept="image/png, image/jpeg" name="input-file-preview"/> <!-- rename it -->
                                    </div>
                                </span>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-add">Summit</button>
                    </div>
                    </div>
                </div>
                </div>

            <div class="tab-pane active" id="filmstab">
                <ul id="list-film" class="list-group" style="margin-top:0px" style="line-height:30px">
                <div class="list-group-item clearfix">
                    <span class="pull-right button-group">
                        <a href="javascript:void(0)" class="btn btn-success btn-film btn-add"><span class="glyphicon glyphicon-plus"></span> Add</a> 
                    </span>
                </div>

                <?php 
                $fullquery = "SELECT peliculas.id AS id, peliculas.nombre AS nombre, peliculas.ano AS ano, generos.genero AS genero FROM peliculas INNER JOIN generos ON peliculas.generos_id=generos.id GROUP BY peliculas.id";
                $query = $mysqli->query($fullquery);

                while( $row = $query->fetch_assoc() )
                { ?>
                    <li class="list-group-item clearfix">
                        <span class="label label-default"><?php echo $row["id"]?></span> 
                        <span class="film-info"><?php echo $row["nombre"] . " (". $row["ano"] . ")"?></span>
                        <span class="film-edit"></span>
                        <span class="pull-right button-group">
                            <a id="<?php echo $row["id"]?>" href="javascript:void(0)" class="btn btn-primary btn-film btn-edit"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
                            <a id="<?php echo $row["id"]?>" href="javascript:void(0)" class="btn btn-danger btn-film"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                        </span>
                        <div class="edit-space"></div>
                    </li>
                <?php
                }
                ?>
                </ul>
            </div>
            <div class="tab-pane" id="generostab">
            </div>
            <div class="tab-pane" id="userstab">
            </div>
        </div>
    </div>