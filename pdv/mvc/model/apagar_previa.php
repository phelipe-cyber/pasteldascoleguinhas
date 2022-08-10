<?php
session_start();
include_once("conexao.php");

$apagar = "TRUNCATE TABLE `pdv`.`pedido_previa`";

$adiciona_pedido = mysqli_query($conn, $apagar);


?>

