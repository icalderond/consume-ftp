<?php 
class ControlFtp
{
	private $servidor="ipserver";
	private $usuario = "user";
	private $clave = "password";
	private $conexion;

    public function conectarse() {

        $this->conexion = ftp_connect($this->servidor) 
        		or die("No se pudo conectar a ".$this->servidor); 
        $login_result = ftp_login($this->conexion, $this->usuario, $this->clave) 
        		or die("La credencial para acceder al ftp es incorrecta, verifique <br/>");
	}
	public function desconectarse(){
		ftp_close($this->conexion);
	}

	public function existe_cliente($cliente){
		$arr_clientes=$this->get_info_directorio("/");
       
        //$string=implode(",",$arr_clientes);
        //echo $string;
		for ($i=0; $i < count($arr_clientes); $i++) { 
			$name=explode(" ",$arr_clientes[$i]);
			$currentItem=end($name);
			//echo substr($currentItem,4)."<br/>";
			//echo $cliente."<br/>";
			if(substr($currentItem,4)==$cliente){	
				return true;			
			}
		}
		return false;
	}
	public function clave_correcta($clave,$cliente){
		    $number=intval($cliente)*7;
			$c="av".$number."lp";
			//echo "ESTE ES EL VALOR: ".$c."<br/>";
			//echo $clave;/
			if($clave==$c){
				return true;
			}else{
				return false;
			}
	}
	public function get_info_directorio($directorio){
		$buff = ftp_rawlist($this->conexion, $directorio,false);
            
        //$string=implode(",",$buff);
        //echo $string;
		return $buff;
		//for ($i=0; $i < count($buff); $i++) { 
		//	echo end(explode(" ",$buff[$i]))."<br>";
		//}
	}

	public function descargar_file($local_file,$server_file){
		if (ftp_get($this->conexion, $local_file, $server_file, FTP_BINARY)) {
		    echo "Se ha guardado satisfactoriamente en $local_file\n";
		} else {
		    echo "Ha habido un problema\n";
		}
	}
}
 ?>
