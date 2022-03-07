<?php
session_start();
include_once "conexao.php";
date_default_timezone_set('America/recife');
 
// print_r($_POST);

// exit();
$cliente = utf8_encode($_POST['nomecliente']);
$numeropedido =  $_POST['pedido'];
$user =  $_SESSION['user'];
$hora_pedido = date('H:i');
$detalhes =  $_POST['detalhes'];
// $cliente =  $_POST['detalhes'][0]['cliente'];

foreach ($detalhes as $detalhesPedidos) {

  $quantidade = $detalhesPedidos['quantidade'];
  $pedido = $detalhesPedidos['pedido'];
  $preco_venda = $detalhesPedidos['preco_venda'];
  $observacoes = $detalhesPedidos['observacoes'];

  if ($quantidade == 0 )
    continue;

  $insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, usuario, gorjeta) VALUES
  ('$numeropedido','','$cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '$user', '' )";
  $adiciona_pedido = mysqli_query($conn, $insert_table);
  
  $insert_table = "UPDATE mesas SET status = '2', nome = '$cliente' WHERE id_mesa = $id_mesa";
  $adiciona_pedido = mysqli_query($conn, $insert_table);

};

header("Location: /pdv/?view=todosPedidoBalcao");

$conn->close();

echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=Dashboard1'>";
$_SESSION['msg'] = "<div class='alert alert-success' role='alert'> Pedido para $cliente cadastrado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

