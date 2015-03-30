<?php
include_once "init.php";
//echo "cliente=".$_SESSION["cliente"]."\n";
//echo "path=".$_SESSION["path"]."\n";
//echo "clave=".$_SESSION["clave"]."\n";
if(!isset($_SESSION["cliente"])){
    header("Location: login.php");
    die();
}else{
    $control=new ControlFtp();  
    $control->conectarse();
      if(isset($_GET["path"])){
        //echo "<br/> pathGET:".$_GET["path"];
        if (strpos($_SESSION["path"],$_GET["path"]) === false) {
          $_SESSION["path"].="/".$_GET["path"];
        }           
      }
    if(!$control->existe_cliente($_SESSION["cliente"]) || !$control->clave_correcta($_SESSION["clave"],$_SESSION["cliente"])){     
    ?>
    <a href="login.php">
      <div class="alert alert-danger" role="alert">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
      <span class="sr-only">Error:</span>El cliente o la clave no es correcta, verifique. Click aqui para corregir
     </a>     
</div>
    <?php
    }else{ 
     $array_info=$control->get_info_directorio($_SESSION["path"]);       
        ?>
        <div class="list-group">
          <a href="#" class="list-group-item active">
            <h4>Cliente:</h4><?php echo $_SESSION["cliente"]?>
          </a>
           <?php for($x=1;$x<count( $array_info);$x++){
                $name=explode(" ",$array_info[$x]);
                $value=end($name);
                if (substr($value,strlen($value)-4)==".pdf") {
                 ?>
                 <a href="ftp://216.251.81.43<?php echo $_SESSION["path"]."/".$value ?>" download="<?php echo $value ?>">
                  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Descargar</button>
                  </a>
                  <a href="index.php?path=<?php echo $value ?>" id="btnFolder" name="btnFolder" class="list-group-item">
                  <?php echo $value ?></a>
                 <?php
                }else{ ?>           
            <a href="index.php?path=<?php echo $value ?>" id="btnFolder" name="btnFolder" class="list-group-item">
            <?php echo $value ?></a>
              <?php }
            }
              ?>
        </div>
       <?php    }    
    $control->desconectarse();   
    } 
include_once "fin.php";?>