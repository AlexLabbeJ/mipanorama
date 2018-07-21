<?php
class DB
{
    private static $instancia;
    private $dbh;

    private function __construct()
    {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=mipanorama', 'root', '');
            $this->dbh->exec("SET CHARACTER SET utf8");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            session_start();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public static function singleton()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    

    public function insertUser($nombre,$email,$password)
    {
        try {
            $q2 = $this->dbh->prepare('SELECT * FROM usuarios WHERE email=?');
            $q2->bindParam(1, $email,PDO::PARAM_STR);
            $q2->execute();
            if($q2->rowCount()>0){
                echo json_encode(array("result"  => 1));//
            }else{
                $query = $this->dbh->prepare('INSERT INTO usuarios (nombre,email,password) values(?,?,?)');
                $query->bindParam(1, $nombre,PDO::PARAM_STR);
                $query->bindParam(2, $email,PDO::PARAM_STR);
                $query->bindParam(3, $password,PDO::PARAM_STR);


                if($query->execute()){
                    $idUser = $this->dbh->lastInsertId();

                    $q3 = $this->dbh->prepare('SELECT * FROM usuarios WHERE email=? AND password=?');
                    $q3->bindParam(1, $email,PDO::PARAM_STR);
                    $q3->bindParam(2, $password,PDO::PARAM_STR);
                    $q3->execute();
                    if($q3->rowCount()==1){
                        $row = $q3->fetch();
                            $_SESSION["emailUser"] = $row["email"];
                            $_SESSION["nombreUser"] = $row["nombre"];

                            echo json_encode(array("result"  => 2, "idUser" => $idUser));//se inserto

                    }
                }else{
                    echo json_encode(array("result"  => 3));//
                }
            }
            
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function insertInteresesReg($interes,$idUser){
        try{
            $q1 = $this->dbh->prepare('INSERT INTO intereses (idUsuario,categoria) VALUES(?,?)');
            $q1->bindParam(1, $idUser,PDO::PARAM_STR);
            $q1->bindParam(2, $interes,PDO::PARAM_STR);  
            $q1->execute();

            $q2 = $this->dbh->prepare('UPDATE usuarios SET encuesta_inicio=1 WHERE id=?');
            $q2->bindParam(1, $idUser,PDO::PARAM_STR);  
            $q2->execute();
            header("Location: ../");      
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function loginUser($login,$password){
        try {
            if($login=="" && $password==""){
               echo false; 
            }else{
                $query = $this->dbh->prepare('SELECT * FROM usuarios WHERE email=? AND password=?');
                $query->bindParam(1, $login,PDO::PARAM_STR);
                $query->bindParam(2, $password,PDO::PARAM_STR);
                $query->execute();
                $this->dbh = null;
                    if($query->rowCount()==1){
                        $row = $query->fetch();
                            $_SESSION["emailUser"] = $row["email"];
                            $_SESSION["nombreUser"] = $row["nombre"];
                            $_SESSION["idUser"] = $row["id"];
                            if($row["admin"]==1){
                                $_SESSION["admin"] = true;
                            }
                            echo true;
                    }else{
                        echo false;
                    }
            }
            
                
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getCategorias(){
        try {
                $query = $this->dbh->prepare('SELECT * FROM categorias ORDER BY categoria ASC');
                $query->execute();
                return $query->fetchAll();
                $this->dbh = null;
                
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getCategoriaById($id){
        try {
                $query = $this->dbh->prepare('SELECT * FROM categorias WHERE id=? ORDER BY categoria ASC');
                $query->bindParam(1, $id,PDO::PARAM_STR);
                $query->execute();
                return $query->fetchAll();
                $this->dbh = null;
                
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function guardarCategoria($categoria){
         try{
            $q2 = $this->dbh->prepare('SELECT * FROM categorias WHERE categoria=?');
            $q2->bindParam(1, $categoria,PDO::PARAM_STR);
            $q2->execute();
            if($q2->rowCount()>0){
                echo false;
            }else{
                $q1 = $this->dbh->prepare('INSERT INTO categorias (categoria) VALUES(?)');
                $q1->bindParam(1, $categoria,PDO::PARAM_STR);  
                $q1->execute(); 
                echo true;
            }
               
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function insertEvento($idEvent,$nombre,$categoria,$fecha,$hora,$direccion,$precio,$linkbtn,$descripcion,$tipoManualInfo,$txtLinkImgInfo){
         try{
            
                $q1 = $this->dbh->prepare('INSERT INTO eventos (id,nombreEvento,categoria,fecha,hora,direccion,precio,linkBtnEvento,descripcion,infoAdicionalTxt,infoAdicionalLink) VALUES(?,?,?,?,?,?,?,?,?,?,?)');
                 $q1->bindParam(1, $idEvent,PDO::PARAM_STR);
                $q1->bindParam(2, $nombre,PDO::PARAM_STR);
                $q1->bindParam(3, $categoria,PDO::PARAM_STR);
                $q1->bindParam(4, $fecha,PDO::PARAM_STR);
                $q1->bindParam(5, $hora,PDO::PARAM_STR);
                $q1->bindParam(6, $direccion,PDO::PARAM_STR);
                $q1->bindParam(7, $precio,PDO::PARAM_STR);
                $q1->bindParam(8, $linkbtn,PDO::PARAM_STR);
                $q1->bindParam(9, $descripcion,PDO::PARAM_STR);  
                $q1->bindParam(10, $tipoManualInfo,PDO::PARAM_STR);  
                $q1->bindParam(11, $txtLinkImgInfo,PDO::PARAM_STR);  
                $q1->execute(); 
               
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
     public function editarEvento($idEvento,$nombre,$categoria,$fecha,$hora,$direccion,$precio,$linkbtn,$descripcion,$tipoManualInfo,$txtLinkImgInfo){
         try{
            
                $q1 = $this->dbh->prepare('UPDATE eventos SET nombreEvento=?,categoria=?,fecha=?,hora=?,direccion=?,precio=?,linkBtnEvento=?,descripcion=?,infoAdicionalTxt=?,infoAdicionalLink=? WHERE id=?');
                $q1->bindParam(1, $nombre,PDO::PARAM_STR);
                $q1->bindParam(2, $categoria,PDO::PARAM_STR);
                $q1->bindParam(3, $fecha,PDO::PARAM_STR);
                $q1->bindParam(4, $hora,PDO::PARAM_STR);
                $q1->bindParam(5, $direccion,PDO::PARAM_STR);
                $q1->bindParam(6, $precio,PDO::PARAM_STR);
                $q1->bindParam(7, $linkbtn,PDO::PARAM_STR);
                $q1->bindParam(8, $descripcion,PDO::PARAM_STR);  
                $q1->bindParam(9, $tipoManualInfo,PDO::PARAM_STR);  
                $q1->bindParam(10, $txtLinkImgInfo,PDO::PARAM_STR);
                $q1->bindParam(11, $idEvento,PDO::PARAM_STR);  

                $q1->execute(); 
               
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function insertImgEvento($idEvento,$urlImagen){
        try{
            
                $q1 = $this->dbh->prepare('INSERT INTO imagenes (idEvento,imagen) VALUES(?,?)');
                $q1->bindParam(1, $idEvento,PDO::PARAM_STR);
                $q1->bindParam(2, $urlImagen,PDO::PARAM_STR); 
                if($q1->execute()){
                    echo true;
                }else{
                    echo false;
                }
               
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getEventosPag($paginaGet){
        try{
            $query1 = $this->dbh->prepare('SELECT * FROM eventos');
            $query1->execute();
            $num_total_registros = $query1->rowCount();

            if ($num_total_registros > 0) {
                //Limito la busqueda
                $TAMANO_PAGINA = 10;
                    $pagina = false;

                //examino la pagina a mostrar y el inicio del registro a mostrar
                    if (isset($paginaGet))
                        $pagina = $paginaGet;
                    
                if (!$pagina) {
                    $inicio = 0;
                    $pagina = 1;
                }
                else {
                    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
                }
                //calculo el total de paginas
                $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

                echo '<table class="table table-bordered hoverTable">';
                echo '<thead>';
                echo '<tr>';
                echo '<th width="20%">ID</th>';
                echo '<th width="20%">NOMBRE</th>';
                echo '<th width="15%">CATEGORIA</th>';
                echo '<th width="20%">FECHA PUBLICACION</th>';
                echo '<th width="20%">OPCIONES</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                $query = $this->dbh->prepare('SELECT 
                    EV.id as ID,
                    EV.nombreEvento as NOMBRE,
                    CAT.categoria as CATEGORIA,
                    EV.fecha as FECHA,
                    EV.hora as HORA,
                    EV.direccion as DIRECCION,
                    EV.precio as PRECIO,
                    EV.descripcion as DESCRIPCION,
                    EV.timestam as FECHA_PUBLIC,
                    EV.imgPrincipal as IMAGEN FROM eventos as EV JOIN categorias as CAT ON EV.categoria=CAT.id ORDER BY timestam DESC LIMIT '.$inicio.',' . $TAMANO_PAGINA);
                $query->execute();

                foreach ($query->fetchAll() as $key => $row) {
                    echo '<tr>';
                    echo '<td>'.$row["ID"].'</td>';
                    echo '<td>'.$row["NOMBRE"].'</td>';
                    echo '<td>'.$row["CATEGORIA"].'</td>';
                    echo '<td>'.$row["FECHA_PUBLIC"].'</td>';
                    echo '<td><center><i class="fa fa-search fa-lg" title="Mostrar Evento" onclick="verEventoDel(\''.$row["ID"].'\');"></i>&nbsp;&nbsp; - &nbsp;&nbsp;<i class="fa fa-edit fa-lg" title="Editar Evento" onclick="editarEvento(\''.$row["ID"].'\');"></i>&nbsp;&nbsp; - &nbsp;&nbsp;<i class="fa fa-trash fa-lg" title="Eliminar Evento" onclick="eliminarEvento(\''.$row["ID"].'\');"></i></center></td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '<ul class="pagination pagination-sm">';
                if ($total_paginas > 1) {
                    if ($pagina != 1)
                        echo '<li><a href="'.$url.'?pagina='.($pagina-1).'"><i class="fa fa-angle-left"></i></a></li>';
                    for ($i=1;$i<=$total_paginas;$i++) {
                        if ($pagina == $i)
                            //si muestro el �ndice de la p�gina actual, no coloco enlace
                            echo '<li class="active"><a href="#">'.$pagina.'</a></li>';
                        else
                            //si el �ndice no corresponde con la p�gina mostrada actualmente,
                            //coloco el enlace para ir a esa p�gina
                            echo '<li><a href="'.$url.'?pagina='.$i.'">'.$i.'</a></li>';
                    }
                    if ($pagina != $total_paginas)
                        echo '<li><a href="'.$url.'?pagina='.($pagina+1).'"><i class="fa fa-angle-right"></i></a></li>';
                }
                echo '</ul>';
            }
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
   }
   public function getEventosPagCategoria($paginaGet,$categoria){
        try{
            $query1 = $this->dbh->prepare('SELECT * FROM eventos');
            $query1->execute();
            $num_total_registros = $query1->rowCount();

            if ($num_total_registros > 0) {
                //Limito la busqueda
                $TAMANO_PAGINA = 30;
                    $pagina = false;

                //examino la pagina a mostrar y el inicio del registro a mostrar
                    if (isset($paginaGet))
                        $pagina = $paginaGet;
                    
                if (!$pagina) {
                    $inicio = 0;
                    $pagina = 1;
                }
                else {
                    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
                }
                //calculo el total de paginas
                $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

                $query = $this->dbh->prepare('SELECT 
                    EV.id as ID,
                    EV.nombreEvento as NOMBRE,
                    CAT.categoria as CATEGORIA,
                    DATE_FORMAT(EV.fecha, "%d-%m-%Y") as FECHA,
                    EV.hora as HORA,
                    EV.direccion as DIRECCION,
                    EV.precio as PRECIO,
                    EV.descripcion as DESCRIPCION,
                    EV.imgPrincipal as IMAGEN FROM eventos as EV JOIN categorias as CAT ON EV.categoria=CAT.id WHERE EV.categoria=? ORDER BY timestam DESC LIMIT '.$inicio.',' . $TAMANO_PAGINA);
                    $query->bindParam(1, $categoria,PDO::PARAM_STR);
                $query->execute();

                foreach ($query->fetchAll() as $key => $row): ?>
                    <div class="col-md-2 w3l-movie-gride-agile">
                                <a href="evento?id=<?= $row['ID']?>" class="hvr-shutter-out-horizontal">
                                    <?php if($row["IMAGEN"]==""): ?>
                                        <img src="images/sinfoto.png" class="img-responsive" style="opacity: 0.7;" />
                                    <?php else: ?>
                                        <img src="uploads_img/<?= $row['IMAGEN']?>"  class="img-responsive"/>
                                    <?php endif; ?>
                                    <div class="w3l-action-icon"></div>
                                </a>
                                
                                <div class="mid-1 agileits_w3layouts_mid_1_home">
                                    <div class="w3l-movie-text">
                                        <h6><a href="evento?id=<?= $row['ID']?>"><?= $row["NOMBRE"];?></a></h6>
                                    </div>
                                    <div class="mid-2 agile_mid_2_home">
                                        <p>Fecha: <?= $row["FECHA"]?></p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            
                            </div>
                <?php endforeach;
                echo '<div class="clearfix"> </div><br><ul class="pagination pagination-sm">';
                if ($total_paginas > 1) {
                    if ($pagina != 1)
                        echo '<li><a href="categoria?id='.$categoria.'&pagina='.($pagina-1).'"><i class="fa fa-angle-left"></i></a></li>';
                    for ($i=1;$i<=$total_paginas;$i++) {
                        if ($pagina == $i)
                            //si muestro el �ndice de la p�gina actual, no coloco enlace
                            echo '<li class="active"><a href="#">'.$pagina.'</a></li>';
                        else
                            //si el �ndice no corresponde con la p�gina mostrada actualmente,
                            //coloco el enlace para ir a esa p�gina
                            echo '<li><a href="categoria?id='.$categoria.'&pagina='.$i.'">'.$i.'</a></li>';
                    }
                    if ($pagina != $total_paginas)
                        echo '<li><a href="categoria?id='.$categoria.'&pagina='.($pagina+1).'"><i class="fa fa-angle-right"></i></a></li>';
                }
                echo '</ul>';
            }
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
   }
   public function getEventosPagIndex($paginaGet,$tipo){
        try{
            $query1 = $this->dbh->prepare('SELECT * FROM eventos');
            $query1->execute();
            $num_total_registros = $query1->rowCount();

            if ($num_total_registros > 0) {
                //Limito la busqueda
                $TAMANO_PAGINA = 30;
                    $pagina = false;

                //examino la pagina a mostrar y el inicio del registro a mostrar
                    if (isset($paginaGet))
                        $pagina = $paginaGet;
                    
                if (!$pagina) {
                    $inicio = 0;
                    $pagina = 1;
                }
                else {
                    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
                }
                //calculo el total de paginas
                $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

                if($tipo==1):
                $query = $this->dbh->prepare('SELECT 
                    EV.id as ID,
                    EV.nombreEvento as NOMBRE,
                    CAT.categoria as CATEGORIA,
                    DATE_FORMAT(EV.fecha, "%d-%m-%Y") as FECHA,
                    EV.hora as HORA,
                    EV.direccion as DIRECCION,
                    EV.precio as PRECIO,
                    EV.descripcion as DESCRIPCION,
                    EV.imgPrincipal as IMAGEN FROM eventos as EV JOIN categorias as CAT ON EV.categoria=CAT.id ORDER BY timestam DESC LIMIT '.$inicio.',' . $TAMANO_PAGINA);
                elseif($tipo==2):
                    $q2 = $this->dbh->prepare('SELECT * FROM intereses WHERE idUsuario=?');
                    $q2->bindParam(1, $_SESSION["idUser"],PDO::PARAM_STR);
                    $q2->execute();
                    $records = array();
                    while($row = $q2->fetch(PDO::FETCH_ASSOC)){
                       $records[] .= $row['categoria'];
                    }
                    $query = $this->dbh->prepare('SELECT 
                        EV.id as ID,
                        EV.nombreEvento as NOMBRE,
                        CAT.categoria as CATEGORIA,
                        DATE_FORMAT(EV.fecha, "%d-%m-%Y") as FECHA,
                        EV.hora as HORA,
                        EV.direccion as DIRECCION,
                        EV.precio as PRECIO,
                        EV.descripcion as DESCRIPCION,
                        EV.imgPrincipal as IMAGEN FROM eventos as EV JOIN categorias as CAT ON EV.categoria=CAT.id WHERE EV.categoria IN ('.implode(',',$records).') ORDER BY timestam DESC LIMIT '.$inicio.',' . $TAMANO_PAGINA);
                elseif($tipo==3):
                    $query = $this->dbh->prepare('SELECT 
                    EV.id as ID,
                    EV.nombreEvento as NOMBRE,
                    CAT.categoria as CATEGORIA,
                    DATE_FORMAT(EV.fecha, "%d-%m-%Y") as FECHA,
                    EV.hora as HORA,
                    EV.direccion as DIRECCION,
                    EV.precio as PRECIO,
                    EV.descripcion as DESCRIPCION,
                    EV.imgPrincipal as IMAGEN FROM eventos as EV JOIN categorias as CAT ON EV.categoria=CAT.id WHERE date(timestam)>date(date_sub(NOW(), INTERVAL 5 DAY)) ORDER BY timestam DESC LIMIT '.$inicio.',' . $TAMANO_PAGINA);

                endif;
                $query->execute();

                foreach ($query->fetchAll() as $key => $row): ?>
                    <div class="col-md-2 w3l-movie-gride-agile">
                                <a href="evento?id=<?= $row['ID']?>" class="hvr-shutter-out-horizontal">
                                    <?php if($row["IMAGEN"]==""): ?>
                                        <img src="images/sinfoto.png" class="img-responsive" style="opacity: 0.7;" />
                                    <?php else: ?>
                                        <img src="uploads_img/<?= $row['IMAGEN']?>" class="img-responsive"/>
                                    <?php endif; ?>
                                    <div class="w3l-action-icon"></div>
                                </a>
                                
                                <div class="mid-1 agileits_w3layouts_mid_1_home">
                                    <div class="w3l-movie-text">
                                        <h6><a href="evento?id=<?= $row['ID']?>"><?= $row["NOMBRE"];?></a></h6>
                                    </div>
                                    <div class="mid-2 agile_mid_2_home">
                                        <p>Fecha: <?= $row["FECHA"]?></p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            
                            </div>
                <?php endforeach;
                echo '<div class="clearfix"> </div><br><ul class="pagination pagination-sm">';
                if ($total_paginas > 1) {
                    if ($pagina != 1)
                        echo '<li><a href="javascript:void(0);" class="paginate" onclick="paginate(\''.($pagina-1).'\');" ><i class="fa fa-angle-left"></i></a></li>';
                    for ($i=1;$i<=$total_paginas;$i++) {
                        if ($pagina == $i)
                            //si muestro el �ndice de la p�gina actual, no coloco enlace
                            echo '<li class="active"><a href="#">'.$pagina.'</a></li>';
                        else
                            //si el �ndice no corresponde con la p�gina mostrada actualmente,
                            //coloco el enlace para ir a esa p�gina
                            echo '<li><a href="javascript:void(0);" class="paginate" onclick="paginate(\''.($i).'\');">'.$i.'</a></li>';
                    }
                    if ($pagina != $total_paginas)
                        echo '<li><a href="javascript:void(0);" class="paginate" onclick="paginate(\''.($pagina+1).'\');"><i class="fa fa-angle-right"></i></a></li>';
                }
                echo '</ul>';
            }
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
   }
   public function eliminarEvento($idEvento){
        try{
            $query = $this->dbh->prepare('DELETE FROM eventos WHERE id=?');
            $query->bindParam(1, $idEvento,PDO::PARAM_STR);
            $query->execute();

            $query2 = $this->dbh->prepare('SELECT * FROM imagenes WHERE idEvento=?');
            $query2->bindParam(1, $idEvento,PDO::PARAM_STR);
            $query2->execute();
            foreach($query2->fetchAll() as $key => $row){
                $dir = "../uploads_img/";
                $img = $row["imagen"];
                if(is_file($dir.$img)){
                    unlink($dir.$img);
                }
                
            }

            $query3 = $this->dbh->prepare('DELETE FROM imagenes WHERE idEvento=?');
            $query3->bindParam(1, $idEvento,PDO::PARAM_STR);
            $query3->execute();
            return true;
        }catch (PDOException $e) {
                echo $e->getMessage();
        }
   }
   public function eliminarImgEventEdit($idEvento){
    try{

            $query2 = $this->dbh->prepare('SELECT * FROM imagenes WHERE idEvento=?');
            $query2->bindParam(1, $idEvento,PDO::PARAM_STR);
            $query2->execute();
            foreach($query2->fetchAll() as $key => $row){
                $dir = "../uploads_img/";
                $img = $row["imagen"];
                if(is_file($dir.$img)){
                    unlink($dir.$img);
                }
                
            }
            $query3 = $this->dbh->prepare('DELETE FROM imagenes WHERE idEvento=?');
            $query3->bindParam(1, $idEvento,PDO::PARAM_STR);
            $query3->execute();
        }catch (PDOException $e) {
                echo $e->getMessage();
        }
   }
    public function getEventos($limit=""){
        $limi="";
        if($limit!=""){
            $limi.=" LIMIT ".$limit;
        }
        try {
                $query = $this->dbh->prepare('SELECT 
                    EV.id as ID,
                    EV.nombreEvento as NOMBRE,
                    CAT.categoria as CATEGORIA,
                    DATE_FORMAT(EV.fecha, "%d-%m-%Y") as FECHA,
                    EV.hora as HORA,
                    EV.direccion as DIRECCION,
                    EV.precio as PRECIO,
                    EV.descripcion as DESCRIPCION,
                    EV.imgPrincipal as IMAGEN FROM eventos as EV JOIN categorias as CAT ON EV.categoria=CAT.id ORDER BY timestam DESC '.$limi);
                $query->execute();
                return $query->fetchAll();
                $this->dbh = null;
                
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getEventosBy($by){
        $where="";
        if($by=="semana"){
            $where.=" date(timestam)>date(date_sub(NOW(), INTERVAL 5 DAY)) ";
        }
        try {
                $query = $this->dbh->prepare('SELECT 
                    EV.id as ID,
                    EV.nombreEvento as NOMBRE,
                    CAT.categoria as CATEGORIA,
                    EV.fecha as FECHA,
                    EV.hora as HORA,
                    EV.direccion as DIRECCION,
                    EV.precio as PRECIO,
                    EV.descripcion as DESCRIPCION,
                    EV.imgPrincipal as IMAGEN FROM eventos as EV JOIN categorias as CAT ON EV.categoria=CAT.id WHERE '.$where.' ORDER BY timestam DESC');
                $query->execute();
                return $query->fetchAll();
                $this->dbh = null;
                
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getEventoExiste($id){
        try {
                $query = $this->dbh->prepare('SELECT * FROM eventos WHERE id=?');
                $query->bindParam(1, $id,PDO::PARAM_STR);
                $query->execute();
                return $query->rowCount();
            }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
     public function getEventosById($id){
        try {
                $query = $this->dbh->prepare('SELECT 
                    EV.id as ID,
                    EV.nombreEvento as NOMBRE,
                    EV.categoria as CATE_ID,
                    CAT.categoria as CATEGORIA,
                    DATE_FORMAT(EV.fecha, "%d-%m-%Y") as FECHA,
                    EV.hora as HORA,
                    EV.direccion as DIRECCION,
                    EV.precio as PRECIO,
                    EV.linkBtnEvento as LINKBTN,
                    EV.descripcion as DESCRIPCION,
                    EV.infoAdicionalTxt as INADTXT,
                    EV.infoAdicionalLink as INADLINK,
                    EV.imgPrincipal as IMAGEN FROM eventos as EV JOIN categorias as CAT ON EV.categoria=CAT.id WHERE EV.id=? ORDER BY timestam DESC');
                $query->bindParam(1, $id,PDO::PARAM_STR);
                $query->execute();
                return $query->fetchAll();
                $this->dbh = null;
                
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getEventosByCate($cate){
        try {
                $query = $this->dbh->prepare('SELECT 
                    EV.id as ID,
                    EV.nombreEvento as NOMBRE,
                    CAT.categoria as CATEGORIA,
                    EV.fecha as FECHA,
                    EV.hora as HORA,
                    EV.direccion as DIRECCION,
                    EV.precio as PRECIO,
                    EV.descripcion as DESCRIPCION,
                    EV.imgPrincipal as IMAGEN FROM eventos as EV JOIN categorias as CAT ON EV.categoria=CAT.id WHERE EV.categoria=? ORDER BY timestam DESC');
                $query->bindParam(1, $cate,PDO::PARAM_STR);
                $query->execute();
                return $query->fetchAll();
                $this->dbh = null;
                
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getImagenesById($id){
        try {
                $query = $this->dbh->prepare('SELECT * FROM imagenes WHERE idEvento=?');
                $query->bindParam(1, $id,PDO::PARAM_STR);
                $query->execute();
                return $query->fetchAll();
                $this->dbh = null;
                
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function updateEvento($idEvento,$img){
        try{
            
                $q1 = $this->dbh->prepare('UPDATE eventos SET imgPrincipal=? WHERE id=?');
                $q1->bindParam(1, $img,PDO::PARAM_STR);
                $q1->bindParam(2, $idEvento,PDO::PARAM_STR);
                if($q1->execute()){
                    echo true;
                }else{
                    echo false;
                }
               
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getEventosByGustos($idUser){
        try {
                $q2 = $this->dbh->prepare('SELECT * FROM intereses WHERE idUsuario=?');
                $q2->bindParam(1, $idUser,PDO::PARAM_STR);
                $q2->execute();
                $records = array();
                while($row = $q2->fetch(PDO::FETCH_ASSOC)){
                   $records[] .= $row['categoria'];
                }
                $query = $this->dbh->prepare("SELECT 
                    EV.id as ID,
                    EV.nombreEvento as NOMBRE,
                    CAT.categoria as CATEGORIA,
                    EV.fecha as FECHA,
                    EV.hora as HORA,
                    EV.direccion as DIRECCION,
                    EV.precio as PRECIO,
                    EV.descripcion as DESCRIPCION,
                    EV.imgPrincipal as IMAGEN FROM eventos as EV JOIN categorias as CAT ON EV.categoria=CAT.id WHERE EV.categoria IN (".implode(',',$records).") ORDER BY timestam DESC");
                $query->bindParam(1, $id,PDO::PARAM_STR);
                $query->execute();
                return $query->fetchAll();
                $this->dbh = null;
                
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function randomNum($long) {
        $key = '';
         $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $max = strlen($pattern)-1;
         for($i=0;$i < $long;$i++) $key .= $pattern{mt_rand(0,$max)};
         return $key;
    }
    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }
}
?>