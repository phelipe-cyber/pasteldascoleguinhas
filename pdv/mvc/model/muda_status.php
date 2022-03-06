<?php

	include_once ('./conexao.php');
	date_default_timezone_set('America/recife');

	$id = mysqli_real_escape_string($conn, $_POST['id']);// proteção contra sql injection
	$condicao = mysqli_real_escape_string($conn, $_POST['condicao']);

	if ($condicao < 3) {
		$condicao = $condicao + 1;
	}else {
		$condicao = 1;
	}
	

	$insert_table = "UPDATE atividade SET  condicao = '$condicao' WHERE id = $id";	
	$produtos_editados = mysqli_query($conn, $insert_table);
	header("Location: /pdv/?view=cards");

	$conn->close();

 
?>