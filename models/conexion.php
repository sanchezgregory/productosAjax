<?php 
	class conexion
	{	
		private $servidor;
		private $usuario;
		private $password;
		private $basedatos;
		public $conexion;

		public function __construct() 
		{				
			$this->servidor = '127.0.0.1';
			$this->usuario = 'root';
			$this->password = '123';
			$this->basedatos= 'productos';
		}

		function conectar() {
			$this->conexion = new mysqli($this->servidor,$this->usuario, $this->password,$this->basedatos);

        }
	
		function cerrar() {
			$this->conexion->close();
		}

	}