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
	<div class="general">
		<h4 class="latest-text w3_latest_text">Nosotros</h4>
		<div class="container">
			
		</div>
	</div>
<!-- //general -->
<!-- footer -->
	<?php require_once("includes/footer.php"); ?>
