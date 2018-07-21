<?php if(!isset($_GET["id"]) || $_GET["id"]=="") header("Location: ../"); ?>
<?php require_once("includes/header.php"); ?>
<!-- //nav -->
<!-- banner -->
   
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
<?php 
foreach($db->getCategoriaById($_GET["id"]) as $key => $rows):
	$categoria = $rows["categoria"];
	endforeach;
 ?>
	<div class="general">
		<h4 class="latest-text w3_latest_text">Categoria: <?= $categoria;?></h4>
		<div class="container">
			<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
				
										<div class="agileits-single-top">
											<ol class="breadcrumb">
											  <li><a href="../">Inicio</a></li>
											  <li class="active"><?= $categoria;?></li>
											</ol>
										</div>
				<div id="myTabContent" class="tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
						<div class="w3_agile_featured_movies">
							<?php error_reporting(0); $db->getEventosPagCategoria($_GET["pagina"],$_GET["id"]); ?>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
						<div class="col-md-2 w3l-movie-gride-agile">
							<a href="single.html" class="hvr-shutter-out-horizontal"><img src="images/m22.jpg" title="album-name" class="img-responsive" alt=" " />
								<div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
							</a>
							<div class="mid-1 agileits_w3layouts_mid_1_home">
								<div class="w3l-movie-text">
									<h6><a href="single.html">Assassin's Creed 3</a></h6>
								</div>
								<div class="mid-2 agile_mid_2_home">
									<p>2016</p>
									<div class="block-stars">
										<ul class="w3l-ratings">
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
										</ul>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="ribben">
								<p>NEW</p>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- //general -->
<!-- footer -->
	<?php require_once("includes/footer.php"); ?>
