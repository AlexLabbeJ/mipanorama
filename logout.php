<?php 
session_start();
if(isset($_SESSION["emailUser"])):
	unset($_SESSION["emailUser"]);
endif;
if(isset($_SESSION["nombreUser"])):
	unset($_SESSION["nombreUser"]);
endif;
if(isset($_SESSION["admin"])):
	unset($_SESSION["admin"]);
endif;
if(isset($_SESSION["idUser"])):
	unset($_SESSION["idUser"]);
endif;
session_destroy();
header("Location: ../");
 ?>