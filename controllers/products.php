<?php 
if (isset($_POST['op'])) {

	require_once('../models/products.php');
	$prod = new Product();

	$op = $_POST['op'];

	switch ($op) {

		case 'insertar':
			$prod->insertProductFromJson($_POST['file']);	
			break;

		case 'listar':
			$prod->listProducts();
			break;

		case 'borrar':
			$id = $_POST['id'];
			$prod->borraProducto($id);
			break;
		case 'buscar':
			$id = $_POST['id'];
			$prod->buscarProducto($id);
			break;
		
		default:
			# code...
			break;
	}
}


 ?>
