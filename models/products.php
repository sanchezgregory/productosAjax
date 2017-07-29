<?php 
/**
* 
*/
class Product
{
	public $conexion;
	
	function __construct()
	{
		require_once('conexion.php');
		$this->conexion = new conexion();
		$this->conexion->conectar();
	}

	public function insertProductFromJson($file) // $file si el json es de un file o una url
	{
	    // Leemos el json ya sea de un archivo o una url
	    if ($file == '1') {
	    	$filename = '../resources/products.json';	
	    } else if ($file == '2') {
	    	$filename = 'http://remote.fizzmod.com/EY1KJqFTQ6oulCrw/backend/pub/products.json';	
	    }
	    
	    $json = file_get_contents($filename);   
	    //convert json object to php associative array
	    $data = json_decode($json, true);
	    $aux = 0;
	    // loop through the array
	    foreach ($data as $row) {
	        // get the employee details
	        $name = $row['name'];
	        $price = $row['price'];
	        // execute insert query
	        $sql = "INSERT INTO products (name,price,status) VALUES('$name','$price',1)";
	        if ($this->conexion->conexion->query($sql)) {
	        	$aux = 1;
	        }
	    }
	    echo $aux;
    //close connection
    $this->conexion->cerrar();
	}

	function listProducts()
	{
		$sql = "select id,name,price from products where status = '1'";
		$this->conexion->conexion->set_charset('utf8');
		$r = $this->conexion->conexion->query($sql);
		$arreglo = array();
		while ($resp = $r->fetch_row()){
			$arreglo[] = $resp;
		}
		echo json_encode($arreglo);
		$this->conexion->cerrar();
	}
	function borraProducto($id)
	{
		$sql = "UPDATE products set status = '-1' WHERE id ='$id' ";
		if ($this->conexion->conexion->query($sql)) echo '1';
		else echo '2';
		$this->conexion->cerrar();

	}
	function buscarProducto($id)
	{
		$sql = "SELECT id,name, price from products WHERE id = '$id' and status ='1'";
		$this->conexion->conexion->set_charset('utf8');
		$r = $this->conexion->conexion->query($sql);
		$arreglo = array();
		while ($resp = $r->fetch_row()){
			$arreglo[] = $resp;
		}
		echo json_encode($arreglo);
		$this->conexion->cerrar();
	}
}
