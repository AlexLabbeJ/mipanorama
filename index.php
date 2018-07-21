<?php require_once("includes/header.php"); ?>
<!-- //nav -->
<!-- banner --><br>
	<center><div id="slidey" style="display:none;">
		<ul>
			<?php foreach($db->getEventos(5) as $key => $row2): ?>
			<li><img src="uploads_img/<?= $row2['IMAGEN']?>" alt=" ">
				<a><p class='title'><?= $row2["NOMBRE"]?></p>
				<p class='description'><b>Fecha: </b><?= $row2["FECHA"]?><br><b>Categoria: </b><?= $row2["CATEGORIA"]?></p>
			</li>
		<?php endforeach; ?>
		</ul>
    </div></center>
   
    <script src="js/jquery.slidey.js"></script>
    <script src="js/jquery.dotdotdot.min.js"></script>
	   <script type="text/javascript">
        $("#slidey").slidey({
            interval: 5000,
            listCount: 5,
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
			<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
				<ul id="myTab" class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#todos" onclick="addTipo(1);" role="tab" id="todos-tab" data-toggle="tab" aria-controls="todos" aria-expanded="false">Todos</a></li>
					
					<?php if(isset($_SESSION["nombreUser"])):?>
					<li role="presentation"><a href="#gustos" onclick="addTipo(2);" id="gustos-tab" role="tab" data-toggle="tab" aria-controls="gustos" aria-expanded="true">Según tus gustos</a></li>
					<?php endif; ?>
					<li role="presentation" ><a href="#home" onclick="addTipo(3);" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Recientes</a></li>
				
					
				</ul>
				<input type="hidden" id="tipp" value="">
				<div id="myTabContent" class="tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="todos" aria-labelledby="todos-tab">
						<h3>Todos los eventos publicados.</h3><br>
						<div class="w3_agile_featured_movies" id="divTipo_1">
							<?php error_reporting(0); $db->getEventosPagIndex($_GET["pagina"],1); ?>
						</div>
					</div>
					
					<div role="tabpanel" class="tab-pane fade" id="gustos" aria-labelledby="gustos-tab">
						<h3>Eventos segun tus gustos.</h3><br>
						<div class="w3_agile_featured_movies" id="divTipo_2">
							<?php error_reporting(0); $db->getEventosPagIndex($_GET["pagina"],2); ?>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="home" aria-labelledby="home-tab">
						<h3>Eventos agregados los últimos 5 días.</h3><br>
						<div class="w3_agile_featured_movies" id="divTipo_3">
							<?php error_reporting(0); $db->getEventosPagIndex($_GET["pagina"],3); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- //general -->
<!-- footer -->
	<?php require_once("includes/footer.php"); ?>
