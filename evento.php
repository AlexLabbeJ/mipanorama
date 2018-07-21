<?php if(!isset($_GET["id"])) header("Location: ../"); ?>

<?php require_once("includes/header.php"); ?>


<script>
   $(document).ready(function(){
     $('.bxslider').bxSlider({
   auto: true,
   autoControls: true,
   stopAutoOnClick: true,
   pager: true,
   slideWidth: 600,
   responsive:true
   });
   });
</script>
<!-- //nav -->

<div class="general_social_icons">
   <nav class="social">
      <ul>
         <li class="w3_twitter"><a href="<?= $twitter_url;?>">Twitter <i class="fa fa-twitter"></i></a></li>
		 <li class="w3_facebook"><a href="<?= $face_url;?>">Facebook <i class="fa fa-facebook"></i></a></li>
      </ul>
   </nav>
</div>
<!-- single -->
<div class="general">
   <div class="container">
      <?php
if($db->getEventoExiste($_GET["id"])>0):

?>
      <?php 
      foreach($db->getEventosById($_GET["id"]) as $key => $rowE):
         $titulo = $rowE["NOMBRE"];
      endforeach; 
       ?>  
      <!-- /w3l-medile-movies-grids -->
      <div class="agileits-single-top">
         <ol class="breadcrumb">
            <li><a href="../">Inicio</a></li>
            <li class="active"><?= $rowE["NOMBRE"]?></li>
         </ol>
      </div>
         <div class="col-md-7">
         	<h3><?= $titulo;?></h3><br>
         	<div class="bxslider">
                           	<?php foreach($db->getImagenesById($_GET["id"]) as $key => $row): ?>
                              		<div><center><img src="uploads_img/<?= $row['imagen'];?>"></center></div>
                              <?php endforeach; ?>
                           </div>
                           <?php 
            if($rowE["INADTXT"]!=""){
               echo '<h3>Información adicional</h3><br>';
               echo nl2br($rowE["INADTXT"]);
            }else if($rowE["INADLINK"]!=""){
               echo '<h3>Información adicional</h3><br>';
               echo "<img src='uploads_img/".$rowE["INADLINK"]."' style='max-width:100%;'>";
            }else{
            }
          ?>
         </div>

      <div class="col-md-4">
      	<h3>Información de Evento</h3><br>
      	<ul class="list-group w3-agile" style="margin-bottom: 20px;">
			  <li class="list-group-item"><b>Fecha: </b><?= $rowE["FECHA"];?></li>
			  <li class="list-group-item"><b>Hora: </b><?= $rowE["HORA"];?></li>
			  <li class="list-group-item"><b>Dirección: </b><?= $rowE["DIRECCION"];?></li>
			  <li class="list-group-item"><b>Precio: </b>$ <?= $rowE["PRECIO"];?></li>
			  <li class="list-group-item"><b>Categoria: </b><?= $rowE["CATEGORIA"];?></li>
			</ul>
			<?php if($rowE["LINKBTN"]!=""){ ?><center><a href="<?= $rowE['LINKBTN'];?>" target="_blank" class="btnDefault">Ir al Evento</a></center><br> <?php } ?>
			<b>Descripción: </b> <?php if($rowE["DESCRIPCION"]==""){ echo "Sin descripción..."; }else { echo $rowE["DESCRIPCION"];}?>
      </div>
   <?php else: ?>
      <h3>Evento no encontrado...</h3>
   <?php endif; ?>
      <!-- //w3l-latest-movies-grids -->
   </div><br><br><br><br><br><br><br><br>
</div>
<!-- //w3l-medile-movies-grids -->
<!-- footer -->
<?php require_once("includes/footer.php"); ?>


