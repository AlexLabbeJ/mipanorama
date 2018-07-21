<?php 
error_reporting(0);
	require_once 'class/class.DB.php';
	$db = db::singleton();

	if(is_array($_FILES)){  
		$idEvent = $db->randomNum(15);
	           $file_name1 = explode(".", $_FILES['txtLinkImgInfo']['name']);  
	           $allowed_extension1 = array("jpg", "jpeg", "png", "gif");  
	           if(in_array($file_name1[1], $allowed_extension1))  
	           {  
	                $new_name1 = $db->randomNum(9) . '.'. $file_name1[1];  
	                $sourcePath1 = $_FILES["txtLinkImgInfo"]["tmp_name"];  
	                $targetPath1 = "uploads_img/".$new_name1;  
	                move_uploaded_file($sourcePath1, $targetPath1); 
	           }  
		$db->insertEvento($idEvent,$_POST["nomEvento"],$_POST["cateEvento"],$_POST["fechaEvento"],$_POST["horaEvento"],$_POST["direccEvento"],$_POST["precioEvento"],$_POST["btnLinkEvento"],$_POST["descripEvento"],$_POST["tipoManualInfo"],$new_name1);
		$contador=0;
	      foreach($_FILES['imgsEvento']['name'] as $name => $value)  
	      {  
	           $file_name = explode(".", $_FILES['imgsEvento']['name'][$name]);  
	           $allowed_extension = array("jpg", "jpeg", "png", "gif");  
	           if(in_array($file_name[1], $allowed_extension))  
	           {  
	                $new_name = $db->randomNum(10) . '.'. $file_name[1];  
	                $sourcePath = $_FILES["imgsEvento"]["tmp_name"][$name];  
	                $targetPath = "uploads_img/".$new_name;  
	                move_uploaded_file($sourcePath, $targetPath); 
	                $db->insertImgEvento($idEvent,$new_name); 
	                if($contador==0){
	                	$db->updateEvento($idEvent,$new_name);
	                }
	           }  
	           $contador++;
	      }
	}  
?>