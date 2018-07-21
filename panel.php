<?php
 require_once("includes/header.php");
 if(!isset($_SESSION["admin"])) exit();
  ?>
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
					<h3>Menú</h3><br>
					<ul class="nav nav-pills nav-stacked">
					  <li class="active"><a href="../panel">Inicio</a></li>
					  <li><a href="deletedit_evento">Eliminar/Editar Evento</a></li>
					  <li><a href="add_evento">Agregar Evento</a></li>
					  <li><a href="add_categoria">Agregar Categoria</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<!-- //general -->
<!-- footer -->
<?php require_once("includes/footer.php"); ?>