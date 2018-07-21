<?php
require_once 'class.DB.php';
$db = db::singleton();
if(isset($_POST["btnRegistrar"])){
	$interes=$_POST["categoriasReg"];
	foreach ($interes as $value) {
		$db->insertInteresesReg($value,$_POST["idUser"]);
	}
}if(isset($_POST['action'])){
    $action = $_POST['action'];
    if($action=="registrar" && $_POST["nombre"]!="" && $_POST["email"]!="" && $_POST["pass1"]!="" && $_POST["pass2"]!=""){
    	$db->insertUser($_POST["nombre"],$_POST["email"],$_POST["pass1"]);
    }
    if($action=="login" && $_POST["email"]!="" && $_POST["pass"]!=""){
    	$db->loginUser($_POST["email"],$_POST["pass"]);
    }
    if($action=="guardarCategoria" && $_POST["categoria"]!=""){
    	$db->guardarCategoria($_POST["categoria"]);
    }
    if($action=="eliminarEvento" && $_POST["idEvento"]!=""){
        $db->eliminarEvento($_POST["idEvento"]);
    }
    if($action=="loadPagination" && $_POST["page"]!="" && $_POST["tipo"]!=""){
        $db->getEventosPagIndex($_POST["page"],$_POST["tipo"]);
    }
    
}
?>