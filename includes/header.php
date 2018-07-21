
<?php
if(isset($_GET["id"])){
	$idEvento = $_GET["id"];
}
require_once 'class/class.DB.php';

$db = db::singleton();
require_once("class/config.php");

?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>MiPanorama.cl</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="One Movies Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/contactstyle.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/faqstyle.css" type="text/css" media="all" />
<link href="css/single.css" rel='stylesheet' type='text/css' />
<link href="css/medile.css" rel='stylesheet' type='text/css' />
<!-- banner-slider -->
<link href="css/jquery.slidey.min.css" rel="stylesheet">
<!-- //banner-slider -->
<!-- pop-up -->
<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
<!-- //pop-up -->
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
<!-- //font-awesome icons -->
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>

<!-- //js -->
<!-- banner-bottom-plugin -->
<link href="css/owl.carousel.css" rel="stylesheet" type="text/css" media="all">
<script src="js/owl.carousel.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<script>
	$(document).ready(function() {
		$("#owl-demo").owlCarousel({

		  autoPlay: 3000, //Set AutoPlay to 3 seconds

		  items : 5,
		  itemsDesktop : [640,4],
		  itemsDesktopSmall : [414,3]

		});

	});
</script>

<!-- //banner-bottom-plugin -->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>
<body>
<!-- header -->
	<div class="header">
		<div class="container">
			<div class="w3layouts_logo">
				<a href="../"><h1>MiPanorama<span>.cl</span></h1></a>
			</div>
			<div class="w3_search">
				<form action="#" method="post">
					<input type="text" name="Search" placeholder="Search" required="">
					<input type="submit" value="Go">
				</form>
			</div>
			<div class="w3l_sign_in_register">
				<?php 
					if(isset($_SESSION["nombreUser"]) && isset($_SESSION["emailUser"])):
				 ?>
				 <ul>
				 	<?php if(isset($_SESSION["admin"]) && $_SESSION["admin"]==true): ?>
				 		<li><a href="../panel">Panel Admin</a></li>
				 	<?php else: ?>
				 		<li><h3>Bienvenido, <?php echo $_SESSION["nombreUser"] ?>.</h3></li>
				 	<?php endif; ?>
				 	<li><a href="logout">Cerrar Sesión</a></li>
				 </ul>
				<?php
				else: ?>
				<ul>
					<li><a href="#" data-toggle="modal" data-target="#myModal">Iniciar Sesión</a></li>
					<li><a href="#" data-toggle="modal" data-target="#register">Registrar</a></li>
				</ul>
			<?php endif; ?>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- bootstrap-pop-up -->
	<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Entra a tu Cuenta!
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<section>
					<div class="modal-body">
						<div class="w3_login_module">
							<div class="module form-module">
							  <div class="toggle">
								
							  </div>
							  <div class="form" id="formLogin">
								<h3>Iniciar Sesión</h3>
								  <input type="email" name="email_login" id="email_login" placeholder="Correo Electronico" required="">
								  <input type="password" name="pass_login" id="pass_login" placeholder="Contraseña" required="">
								  <input type="button" id="btnLogin" onclick="loginUser();" value="Iniciar Sesión">
							  </div>
							  <!-- div class="cta"><a href="#">Forgot your password?</a></div> -->
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<div class="modal video-modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Registrar una nueva cuenta!
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<section>
					<div class="modal-body">
						<div class="w3_login_module">
							<div class="module form-module">
							  <div class="toggle">
								
							  </div>
							  <div class="form">
								<h3>Crear nueva cuenta</h3>
								<form id="formReg">
									<div id="formRegister">
									  <input type="text" name="nombre_reg" id="nombre_reg" placeholder="Nombre">
									  <input type="email" name="email_reg" id="email_reg" placeholder="Correo Electronico" >
									  <input type="password" name="pass_reg" id="pass_reg" placeholder="Contraseña">
									  <input type="password" name="pass2_reg" id="pass2_reg" placeholder="Repetir Contraseña">
									  <input type="button" id="btnRegistrar" onclick="registrar();" value="Siguiente..." >
								  	</div>
								  </form>
								  	<div id="formIntereses" style="display: none;" >
								  		<form method="post" action="class/ajax.php" id="formIntereses" name="formIntereses" onsubmit="return interesesReg()">
								  			<h3>Por Favor selecciona algunos de tus intereses!</h3><br>
									  Intereses:<br>
									  <?php 
												foreach($db->getCategorias() as $key => $row):
													echo '<input type="checkbox" name="categoriasReg[]" id="categoriasReg" value="'.$row["id"].'"> '.$row["categoria"].'<br>';
												endforeach;
												echo '<input type="hidden" name="idUser" id="idUser" value="">';
										?><br id="brReg">
									  <input type="submit" name="btnRegistrar" id="btnRegistrar" value="Registrarme" >
									</form>
								  	</div>
							  </div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<script>
		$('.toggle').click(function(){
		  // Switches the Icon
		  $(this).children('i').toggleClass('fa-pencil');
		  // Switches the forms
		  $('.form').animate({
			height: "toggle",
			'padding-top': 'toggle',
			'padding-bottom': 'toggle',
			opacity: "toggle"
		  }, "slow");
		});
	</script>
<!-- //bootstrap-pop-up -->
<!-- nav -->
	<div class="movies_nav">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav>
						<ul class="nav navbar-nav">
							<li class="active"><a href="../">Inicio</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorias <b class="caret"></b></a>
								<ul class="dropdown-menu multi-column">
									<li>
									<div class="col-sm-4">
										<ul class="multi-column-dropdown">
											<?php 
											foreach($db->getCategorias() as $key => $row):
												echo '<li><a href="categoria?id='.$row["id"].'">'.$row["categoria"].'</a></li>';
											endforeach;	
											 ?>
										</ul>
									</div>
									<div class="clearfix"></div>
									</li>
								</ul>
							</li>
							<li><a href="nosotros">Nosotros</a></li>
							<li><a href="contactanos">Contactanos</a></li>
						</ul>
					</nav>
				</div>
			</nav>
		</div>
	</div>