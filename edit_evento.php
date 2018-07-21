<?php
 require_once("includes/header.php"); 
  if(!isset($_SESSION["admin"])) exit(); ?>
<!-- //nav -->
<!-- banner -->
    <script src="js/jquery.slidey.js"></script>
    <script src="js/jquery.dotdotdot.min.js"></script>
	   <script type="text/javascript">
			$("#slidey").slidey({
				interval: 8000,
				listCount: 5,
				autoplay: false,
				showList: true
			});
			$(".slidey-list-description").dotdotdot();
		</script>
<!-- //banner -->
<div class="general_social_icons">
	<nav class="social">
		<ul>
			<li class="w3_twitter"><a href="<?= $twitter_url;?>">Twitter <i class="fa fa-twitter"></i></a></li>
			<li class="w3_facebook"><a href="<?= $face_url;?>">Facebook <i class="fa fa-facebook"></i></a></li>
		</ul>
  </nav>
</div>
<!-- general -->
	<div class="general">
		
		<div class="container">
			<div class="row">
				<div class="col-md-3 well">
					<ul class="nav nav-pills nav-stacked">
						<h3>Menú</h3><br>
					  <li><a href="../panel">Inicio</a></li>
					  <li class="active"><a href="deletedit_evento">Eliminar/Editar Evento</a></li>
					  <li><a href="add_evento">Agregar Evento</a></li>
					  <li><a href="add_categoria">Agregar Categoria</a></li>
					</ul>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-6 well">
					<?php 
						foreach ($db->getEventosById($_GET["id"]) as $key => $rowEdit):
					 ?>
					<form method="POST" id="uploadEdit_form">
						<input type="hidden" name="idEvento" id="idEvento" value="<?= $rowEdit['ID'];?>">
					<h3>Editar Evento</h3><br>
						<div class="form-group">
					    <label for="nomEvento">Nombre Evento:</label>
					    <input type="text" class="form-control" id="nomEvento" name="nomEvento" required value="<?= $rowEdit['NOMBRE']?>">
					  </div>
					  <div class="form-group">
					    <label for="cateEvento">Categoria del Evento:</label>
					    <select name="cateEvento" id="cateEvento" name="cateEvento" class="form-control" required>
					    	<option value="">Seleccione una categoria</option>
					    	<?php 
					    	foreach($db->getCategorias() as $key => $row):
					    		echo '<option value="'.$row["id"].'" '; if($row["id"]==$rowEdit["CATE_ID"]) { echo " selected "; } echo ' >'.$row["categoria"].'</option>';
					    	endforeach;
					    	 ?>
					    </select>
					  </div>
					  <div class="form-group">
					    <label for="fechaEvento">Fecha de evento:</label>			     	
							<input type="date" name="fechaEvento" class="form-control" id="fechaEvento" required value="<?= date("Y-m-d", strtotime($rowEdit["FECHA"]))?>">
					  </div>
					  <div class="form-group">
					    <label for="horaEvento">Hora de evento(formato 24hrs.):</label>			     	
							<input type="time" name="horaEvento" class="form-control" id="horaEvento" required value="<?= $rowEdit['HORA']?>">
					  </div>
					  <div class="form-group">
					    <label for="direccEvento">Dirección:</label>
					    <input type="text" class="form-control" name="direccEvento" id="direccEvento" required value="<?= $rowEdit['DIRECCION']?>">
					  </div>
					  <div class="form-group">
					    <label for="precioEvento">Precio:</label>
					    <input type="text" class="form-control" id="precioEvento" name="precioEvento" required value="<?= $rowEdit['PRECIO']?>">
					  </div>
					  <div class="form-group">
					    <label for="precioEvento">Link boton "IR AL EVENTO":</label>
					    <input type="text" class="form-control" id="btnLinkEvento" name="btnLinkEvento" required value="<?= $rowEdit['LINKBTN']?>">
					  </div>
					  <div class="form-group">
					    <label for="precioEvento">Descripcion del Evento:</label>
					    <textarea name="descripEvento" class="form-control" rows="4" id="descripEvento" style="resize: vertical;max-height: 150px;"><?= $rowEdit['DESCRIPCION']?></textarea>
					  </div>
					  <hr>
					  <div class="form-group">
					    <label>Información adicional:</label>
					    &nbsp;&nbsp;Si&nbsp;<input type="radio" name="infoAdicional" value="1" <?php if($rowEdit["INADTXT"]!="" || $rowEdit["INADLINK"]!="") echo "checked"; ?> > &nbsp;&nbsp;- &nbsp;&nbsp;No&nbsp;<input type="radio" name="infoAdicional" value="0" <?php if($rowEdit["INADTXT"]=="" && $rowEdit["INADLINK"]=="") echo "checked"; ?>>
					    <div id="viewInfoAdd" <?php if($rowEdit["INADTXT"]=="" && $rowEdit["INADLINK"]=="") echo "style='display:none'"; ?> >
						    <center><b>Precios:</b></center><br1>
						    <label for="precioEvento">Como agregar:</label>
						    <select name="tipoAdd" id="tipoAdd" class="form-control">
						    	<option value=""></option>
						    	<option value="1" <?php if($rowEdit["INADTXT"]!="") echo "selected"; ?> >Forma Manual</option>
						    	<option value="2" <?php if($rowEdit["INADLINK"]!="") echo "selected"; ?> >Imagen</option>
						    </select>
						    <br>
						    <div id="resultTipoAdd">
						    	<div id="tipo1" <?php if($rowEdit["INADTXT"]!=""){ echo "style='display:block'"; }else { echo "style='display:none'";} ?> style="width: 80%">
						    		<textarea name="tipoManualInfo" id="tipoManualInfo" rows="10" style="width: 100%;resize: vertical;" class="form-control" placeholder="Escribe aqui los precios por sector..."><?php if($rowEdit["INADTXT"]!="") echo $rowEdit["INADTXT"]; ?></textarea>
						    	</div>
						    	<div id="tipo2" <?php if($rowEdit["INADLINK"]!=""){ echo "style='display:block'"; }else { echo "style='display:none'";} ?> >
						    		<label for="precioEvento">Imagen con los precios:</label>
						    		<input type="file" name="txtLinkImgInfo" id="txtLinkImgInfo"><br>
						    		<input type="hidden" name="valImgInfo" value="<?php if($rowEdit["INADLINK"]!="") echo $rowEdit["INADLINK"]; ?>">
						    		<h4>Imagen actual</h4>
						    		<?php if($rowEdit["INADLINK"]!=""): ?><img src="uploads_img/<?= $rowEdit['INADLINK']?>" width="70%;" alt=""> <?php endif; ?>
					    			
						    	</div>
						    	
						    </div>
						</div>
					  </div>
					  <hr>
					  <div class="form-group">
					  	<label>Cambiar imagenes del evento:</label>
					  	&nbsp;&nbsp;Si&nbsp;<input type="radio" name="changeImg" value="1"> &nbsp;&nbsp;- &nbsp;&nbsp;No&nbsp;<input type="radio" name="changeImg" value="0" checked>
					  	<h5 style="color: red;">NOTA: Al cambiar las imagenes, se eliminaran todas las que ya están en el evento, reemplazandose por las que subirá ahora.
					  </div>
					  <div class="form-group" id="divImgEdit" style="display: none;">
					  	<label for="precioEvento">Imagenes:</label>
					    </h5><br>
					    <div id="img1"><h4 style="float: left;">Imagen 1 (Principal):</h4>
					    	<input type="file" name="imgsEvento[]" id="imgEvento1" style="float: left;">
					    	<img src="images/delete.png" onclick="deleteImg(1);" alt="Eliminar Imagen" width="25" style="cursor: pointer;" id="delImg1"><br>
					    </div>
					    <div id="img2" style="display: none;"><h4 style="float: left;">Imagen 2:</h4>
					    	<input type="file" name="imgsEvento[]" id="imgEvento2" style="float: left;">
					    	<img src="images/delete.png" onclick="deleteImg(2);" alt="Eliminar Imagen" width="25" style="cursor: pointer;" id="delImg2"><br>
					    </div>
					    <div id="img3" style="display: none;"><h4 style="float: left;">Imagen 3:</h4>
					    	<input type="file" name="imgsEvento[]" id="imgEvento3" style="float: left;">
					    	<img src="images/delete.png" onclick="deleteImg(3);" alt="Eliminar Imagen" width="25" style="cursor: pointer;" id="delImg3"><br>
					    </div>
					    <div id="img4" style="display: none;"><h4 style="float: left;">Imagen 4:</h4>
					    	<input type="file" name="imgsEvento[]" id="imgEvento4" style="float: left;">
					    	<img src="images/delete.png" onclick="deleteImg(4);" alt="Eliminar Imagen" width="25" style="cursor: pointer;" id="delImg4"><br>
					    </div>
					    <div id="img5" style="display: none;"><h4 style="float: left;">Imagen 5:</h4>
					    	<input type="file" name="imgsEvento[]" id="imgEvento5" style="float: left;">
					    	<img src="images/delete.png" onclick="deleteImg(5);" alt="Eliminar Imagen" width="25" style="cursor: pointer;" id="delImg5"><br>
					    </div>
					  </div>
					   <div class="form-group"><br>
					    <center><div id="divBtn"><input type="submit" name="btnGuardar" value="Guardar Evento" class="btn btn-success" id="btnGuardar"></div></center>
					  </div>
					</form>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
<!-- //general -->
<!-- footer -->
	<?php require_once("includes/footer.php"); ?>