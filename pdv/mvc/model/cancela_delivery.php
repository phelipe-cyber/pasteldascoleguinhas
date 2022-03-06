<?php
$idpedido = $_POST['idpedido'];

include_once "conexao.php";
date_default_timezone_set('America/recife');


	$exclude_table = "DELETE FROM pedido WHERE idpedido = '$idpedido'";	
	$pedido_excluido = mysqli_query($conn, $exclude_table);

	header("Location: /pdv/?view=pedidos_delivery");
?>