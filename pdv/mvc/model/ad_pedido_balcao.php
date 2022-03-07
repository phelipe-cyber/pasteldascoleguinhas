<?php
session_start();
include_once ("conexao.php");
date_default_timezone_set('America/recife');
 

$result_usuarios = ("SELECT MAX(numeropedido) as 'Pedido'FROM `pedido`");
$recebidos = mysqli_query($conn, $result_usuarios);

while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

    $pedido = $row_usuario['Pedido'];
}
if ($pedido == null) {
    $pedido = "1001";
} else {


    $result_usuarios = ("SELECT MAX(numeropedido)+1 as 'Pedido'FROM `pedido` ");
    $recebidos = mysqli_query($conn, $result_usuarios);

    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

        $pedido = $row_usuario['Pedido'];
    }
};
$numeropedido = $pedido;

$user =  $_SESSION['user'];
$hora_pedido = date('H:i');
$detalhes =  $_POST['detalhes'];
$cliente = utf8_decode($_POST['cliente']);
$cliente_2 = utf8_decode($_POST['cliente']);

foreach ($detalhes as $detalhesPedidos) {

  $quantidade = $detalhesPedidos['quantidade'];
  $pedido =     utf8_encode($detalhesPedidos['pedido']);
  $preco_venda = $detalhesPedidos['preco_venda'];
  $observacoes = $detalhesPedidos['observacoes'];
  
  
  if ($quantidade == 0 )
  continue;
  
//   print_r($pedido);
//   echo "<br>";
//   print_r($cliente);
//   exit();

  $insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, usuario, gorjeta) VALUES
  ('$numeropedido','','$cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '$user', '' )";
  $adiciona_pedido = mysqli_query($conn, $insert_table);
  
  $insert_table = "UPDATE mesas SET status = '2', nome = '$cliente' WHERE id_mesa = $id_mesa";
  $adiciona_pedido = mysqli_query($conn, $insert_table);

};

header("Location: /pdv/?view=todosPedidoBalcao");

$conn->close();

echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=todosPedidoBalcao'>";
$_SESSION['msg'] = "<div class='alert alert-success' role='alert'> Pedido para $cliente_2 cadastrado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

