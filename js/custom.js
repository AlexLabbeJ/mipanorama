
$(document).ready(function() {
	$("input[name=infoAdicional]").click(function() {
		if($(this).val()=="1"){
			$("#viewInfoAdd").css('display','block');
			$("#tipoAdd").val("");
			$("#tipoManualInfo").val("");
			$("#txtLinkImgInfo").val("");
		}else if($(this).val()=="0"){
			$("#viewInfoAdd").css('display','none');
			$("#tipoAdd").val("");
			$("#tipoManualInfo").val("");
			$("#txtLinkImgInfo").val("");
			$("#tipo1").css('display','none');
			$("#tipo2").css('display','none');

		}
	});
	$("#tipoAdd").change(function() {
		if($(this).val()=="1"){//forma manual
			$("#tipo2").css('display','none');
			$("#tipo1").css('display','block');
			$("#tipoManualInfo").val("");
			$("#txtLinkImgInfo").val("");
		}else if($(this).val()=="2"){//link imagen
			$("#tipo2").css('display','block');
			$("#tipo1").css('display','none');
			$("#tipoManualInfo").val("");
			$("#txtLinkImgInfo").val("");
		}else if($(this).val()==""){//ninguna
			$("#tipo1").css('display','none');
			$("#tipo2").css('display','none');
			$("#tipoManualInfo").val("");
			$("#txtLinkImgInfo").val("");
		}
	});
	
});
$(document).ready(function() {
	$("#email_login").keypress(function(e) {
		if(e.which == 13){
			loginUser();
		}
	});
	$("#pass_login").keypress(function(e) {
		if(e.which == 13){
			loginUser();
		}
	});
	$("#delImg1").css('display','none');
	$("#delImg2").css('display','none');
	$("#delImg3").css('display','none');
	$("#delImg4").css('display','none');
	$("#delImg5").css('display','none');
	$("#imgEvento1").change(function(event) {
		if($("#imgEvento1").val()!=""){
			$("#img2").css('display','inline');
			$("#delImg1").css('display','block');
			$("#imgEvento1").css('float','left');
		}else{
			$("#img2").css('display','none');
			$("#delImg1").css('display','none');
		}
	});
	$("#imgEvento2").change(function(event) {
		if($("#imgEvento2").val()!=""){
			$("#img3").css('display','inline');
			$("#delImg2").css('display','block');
			$("#imgEvento2").css('float','left');
		}else{
			$("#img3").css('display','none');
			$("#delImg2").css('display','none');
		}
	});
	$("#imgEvento3").change(function(event) {
		if($("#imgEvento3").val()!=""){
			$("#img4").css('display','inline');
			$("#delImg3").css('display','block');
			$("#imgEvento3").css('float','left');
		}else{
			$("#img4").css('display','none');
			$("#delImg3").css('display','none');
		}
	});
	$("#imgEvento4").change(function(event) {
		if($("#imgEvento4").val()!=""){
			$("#img5").css('display','inline');
			$("#delImg4").css('display','block');
			$("#imgEvento4").css('float','left');
		}else{
			$("#img5").css('display','none');
			$("#delImg4").css('display','none');
		}
	});
	$("#imgEvento5").change(function(event) {
		if($("#imgEvento5").val()!=""){
			$("#delImg5").css('display','block');
			$("#imgEvento5").css('float','left');
		}else{
			$("#delImg5").css('display','none');
		}
	});
});
$(document).ready(function() {
	$("#upload_form").on('submit', function(event) {
		event.preventDefault();
		$.ajax({
			url: '../upload_img.php',
			type: 'POST',
			data: new FormData(this),
			contentType:false,
			processData:false,
			beforeSend: function(){
				$("#btnGuardar").css('display','none');
				$("#divBtn").append('<a href="#" class="btn btn-success">Guardando...</a>');
			},
			success: function(data){
              window.location.href="../add_evento";
			}
		});
		
	});
});
$(document).ready(function() {
	$("#uploadEdit_form").on('submit', function(event) {
		event.preventDefault();
		$.ajax({
			url: '../uploadEdit_img.php',
			type: 'POST',
			data: new FormData(this),
			contentType:false,
			processData:false,
			beforeSend: function(){
				$("#btnGuardar").css('display','none');
				$("#divBtn").append('<a href="#" class="btn btn-success">Guardando...</a>');
			},
			success: function(data){
              window.location.href="../edit_evento?id="+$("#idEvento").val();
			}
		});
		
	});
});
function deleteImg(img){
	if(img==1){
		if($("#imgEvento1").val()!=""){
			$("#imgEvento1").val("");
			$("#delImg1").css('display','none');
			$("#imgEvento1").css('float','none');
		}
	}
	if(img==2){
		if($("#imgEvento2").val()!=""){
			$("#imgEvento2").val("");
			$("#delImg2").css('display','none');
			$("#imgEvento2").css('float','none');
		}
	}
	if(img==3){
		if($("#imgEvento3").val()!=""){
			$("#imgEvento3").val("");
			$("#delImg3").css('display','none');
			$("#imgEvento3").css('float','none');
		}
	}
	if(img==4){
		if($("#imgEvento4").val()!=""){
			$("#imgEvento4").val("");
			$("#delImg4").css('display','none');
			$("#imgEvento4").css('float','none');
		}
	}
	if(img==5){
		if($("#imgEvento5").val()!=""){
			$("#imgEvento5").val("");
			$("#delImg5").css('display','none');
			$("#imgEvento5").css('float','none');
		}
	}
	
}
function registrar(){
	var regexs = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
	var emailuser = $("#email_reg").val();
	if($("#nombre_reg").val()==""){
		$("#nombre_reg").addClass("errorInput");
		if(!$("#errorNombre").is(":visible"))
			$("#nombre_reg").after('<div class="errorInputText" id="errorNombre">Ingrese su nombre!</div>');
	}
	if($("#email_reg").val()=="" || !regexs.test($("#email_reg").val().trim())){
		$("#email_reg").addClass('errorInput');
		if(!$("#errorEmail").is(":visible"))
			$("#email_reg").after('<div class="errorInputText" id="errorEmail">Ingrese su correo electronico valido!</div>');
	}
	if($("#pass_reg").val()==""){
		$("#pass_reg").addClass('errorInput');
		if(!$("#errorPass1").is(":visible"))
			$("#pass_reg").after('<div class="errorInputText" id="errorPass1">Ingrese su contraseña!</div>');
	}
	if($("#pass2_reg").val()==""){
		$("#pass2_reg").addClass('errorInput');
		if(!$("#errorPass2").is(":visible"))
			$("#pass2_reg").after('<div class="errorInputText" id="errorPass2">Ingrese de nuevo su contraseña!</div>');
	}
	if($("#pass_reg").val()!=$("#pass2_reg").val()){
		$("#pass2_reg").addClass('errorInput');
		if(!$("#errorPass3").is(":visible"))
			$("#pass2_reg").after('<div class="errorInputText" id="errorPass3">Ingrese la misma contraseña!</div>');
	}
	if($("#nombre_reg").val()!="" && $("#email_reg").val()!="" && $("#pass_reg").val()!="" && $("#pass2_reg").val()!="" && $("#pass_reg").val()==$("#pass2_reg").val()){
		
		var datos = "action=registrar&nombre="+$("#nombre_reg").val()+"&email="+$("#email_reg").val()+"&pass1="+$("#pass_reg").val()+"&pass2="+$("#pass2_reg").val();
		
		$.ajax({
			url: '../class/ajax.php',
			type: 'POST',
			data: datos,
			beforeSend: function(){

			},
			success: function(response){
				var myArray = $.parseJSON(response);
				if(myArray.result==1){//ya existe
					$("#formReg").after('<div class="dangerBox"><strong>El email ingresado ya esta registrado, por favor utilice otro.</strong></div>');
					$("#nombre_reg").val("");
					$("#email_reg").val("");
					$("#pass_reg").val("");
					$("#pass2_reg").val("");
					if($("#errorNombre").is(":visible"))
						$("#errorNombre").fadeOut();
					if($("#errorEmail").is(":visible"))
						$("#errorEmail").fadeOut();
					if($("#errorPass1").is(":visible"))
						$("#errorPass1").fadeOut();
					if($("#errorPass2").is(":visible"))
						$("#errorPass2").fadeOut();
					if($("#errorPass3").is(":visible"))
						$("#errorPass3").fadeOut();
				}else if(myArray.result==2){//creada
					$("#idUser").val(myArray.idUser);
					$("#formRegister").css('display', 'none');
					$("#formIntereses").css('display', 'inline');
				}else if(myArray.result==3){//error
					$("#nombre_reg").val("");
					$("#email_reg").val("");
					$("#pass_reg").val("");
					$("#pass2_reg").val("");
					$("#formReg").after('<div class="dangerBox"><strong>Error al intentar crear la cuenta, por favor comuniquese con la administración.</strong></div>');
				}
			}
		});
		
	}
}
function interesesReg(){
	var check = $("#categoriasReg:checked").length;
	if(check =="" ) {
		if(!$("#errorCate").is(":visible"))
    		$("#brReg").after('<div class="errorInputText" id="errorCate">Seleccione al menos un interes!</div>');
    	return false;
	}else{
		return true;
	}
}
function loginUser(){
	var email = $("#email_login").val();
	var pass = $("#pass_login").val();
	if(email=="" || pass==""){
		if(!$("#errLogin").is(":visible"))
			$("#formLogin").after('<div class="dangerBox" id="errLogin"><strong>Ingrese todos los campos!</strong></div>');
	}else{
		var datos = "action=login&email="+email+"&pass="+pass;
		$.ajax({
				url: '../class/ajax.php',
				type: 'POST',
				data: datos,
				beforeSend: function(){

				},
				success: function(response){
					if(response==true){
						window.location.href = "../";
					}else if(response==false){
						$("#formLogin").after('<div class="dangerBox"><strong>Datos incorrectos!</strong></div>');
						$("#email_login").val("");
						$("#pass_login").val("");
					}
					
				}
			});
	}
	
}
function guardarCategoria(){
	if($("#nameCategoria").val()==""){
		alert("Inserte el Nombre");
		$("#nameCategoria").focus();
	}else{
		var datos = "action=guardarCategoria&categoria="+$("#nameCategoria").val();
		$.ajax({
				url: '../class/ajax.php',
				type: 'POST',
				data: datos,
				beforeSend: function(){

				},
				success: function(response){
					if(response==false){
						alert("Ya existe esta categoria");
						$("#nameCategoria").val("").focus();
					}else if(response==true){
						window.location.href="../add_categoria";
					}
					
				}
			});
	}
}
$(document).ready(function() {
	var regexs = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
	$("#nombre_reg").keyup(function(event) {
		if($(this).val()!=""){
			$("#errorNombre").fadeOut();
			$(this).removeClass('errorInput');
			return false;
		}
	});
	$("#email_reg").keyup(function(event) {
		if($(this).val()!="" && regexs.test($(this).val().trim())){
			$("#errorEmail").fadeOut();
			$(this).removeClass('errorInput');
			return false;
		}
	});
	$("#pass_reg").keyup(function(event) {
		if($(this).val()!=""){
			$("#errorPass1").fadeOut();
			$(this).removeClass('errorInput');
			return false;
		}
	});
	$("#pass2_reg").keyup(function(event) {
		if($(this).val()!=""){
			$("#errorPass2").fadeOut();
			$(this).removeClass('errorInput');
			return false;
		}
		if($("#pass_reg").val()==$("#pass2_reg").val()){
			$("#errorPass3").fadeOut();
			$("#pass2_reg").removeClass('errorInput');
			return false;
		}
	});

});
function verEventoDel(id){
	window.open('../evento?id='+id,'_blank');
}
function eliminarEvento(id){
	    bootbox.confirm({
        title: "Eliminar Evento?",
        message: "¿Quiere eliminar el Evento (ID: "+id+") para siempre?",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancelar'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Eliminar'
            }
        },
        callback: function (result) {
            if(result==true){
            	var datos = "action=eliminarEvento&idEvento="+id;
				$.ajax({
						url: '../class/ajax.php',
						type: 'POST',
						data: datos,
						success: function(response){
								window.location.href="../deletedit_evento";
							
						}
					});
            }
        }
    });
}
function editarEvento(id){
	window.open('../edit_evento?id='+id,'_blank');
}
$(document).ready(function() {
	$("input[name=changeImg]").click(function() {
		if($(this).val()=="1"){
			$("#divImgEdit").css('display','block');
		}else if($(this).val()=="0"){
			$("#divImgEdit").css('display','none');
		}
	});
});
$(document).ready(function() {
	addTipo(1);
});
function addTipo(tipo){
    	$("#tipp").val(tipo);
} 
$(document).ready(function() {	
	/*
	$('.paginate').on('click', function(event) {
		alert("asd");
		//event.preventDefault();
		//$('#content').html('<div class="loading"><img src="images/loading.gif" width="70px" height="70px"/></div>');
		var tipo = $("#tipp").val();
		var page = $(this).attr('data');		
		var dataString = 'action=loadPagination&page='+page+'&tipo='+tipo;
		console.log("Tipo:"+tipo+"-Page:"+page);
		$.ajax({
            type: "POST",
            url: "../class/ajax.php",
            data: dataString,
            success: function(data) {
				$('#divTipo_'+tipo).fadeIn(1000).html(data);
            }
        });
	});  */
            
}); 
function paginate(page){
		var tipo = $("#tipp").val();
		//var page = $(this).attr('data');		
		var dataString = 'action=loadPagination&page='+page+'&tipo='+tipo;
		console.log("Tipo:"+tipo+"-Page:"+page);
		$.ajax({
            type: "POST",
            url: "../class/ajax.php",
            data: dataString,
            success: function(data) {
				$('#divTipo_'+tipo).fadeIn(1000).html(data);
            }
        });
}