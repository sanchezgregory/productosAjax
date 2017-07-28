<?php 
if (isset($_POST['op'])) {

	require_once('../models/products.php');

	$op = $_POST['op'];

	switch ($op) {

		case 'insertar':
			$r = new Product();
			$r->insertProductFromJson($_POST['file']);	
			break;

		case 'listar':

			$prod= new Product();
			$prod->listProducts();
			break;
		
		default:
			# code...
			break;
	}
}


 ?>
