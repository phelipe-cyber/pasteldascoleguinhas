<?php
	// $servidor = "db";
	// $usuario = "root";
	// $senha = "#tr0caf0ne#";
	// $dbname = "pdv";
	
	// //Criar a conexao
	// $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	
define('HOST', 'localhost');
define('USUARIO', 'u841971040_root');
define('SENHA', 'sC7MH#Sl9@');
define('DB', 'u841971040_pdv');
$conn = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');