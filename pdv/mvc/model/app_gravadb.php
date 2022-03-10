<?php
session_start();
// print_r($_POST);
// exit();
?>

<link href="../common/css/bootstrap.min.css" rel="stylesheet"/>

<?php
include_once "conexao.php";
date_default_timezone_set('America/recife');

$detalhes = $_POST['detalhes'];

   $hora_pedido = date('H:i');

//    $nome = $_GET['nome'];
//    $preco = $_GET['preco'];
//    $cliente = $_GET['cliente'];
//    $quantidade = $_GET['quantidade'];
//    $observacoes = $_GET['observacoes'];
//    $categoria = $_GET['categoria'];
//    $mesa = $_GET['mesa'];
   $usuarioid = $_SESSION['usuarioid'];
   
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
	$cliente = $_POST['cliente'];

foreach ($detalhes as $detalhesPedidos) {

	$nome = $detalhesPedidos['nome'];
	$preco_venda = $detalhesPedidos['preco'];
	// $cliente = $detalhesPedidos['cliente'];
	$quantidade = $detalhesPedidos['quantidade'];
	$observacoes = $detalhesPedidos['observacoes'];
	$categoria = $detalhesPedidos['categoria'];
	$mesa = $detalhesPedidos['mesa'];

	if ($quantidade == 0 )
	  continue;

	echo $insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, usuario, gorjeta, `status`) VALUES
	 ('$numeropedido','','$cliente', '$id_mesa', '$nome', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '$user', '', 2 )";
  		$adiciona_pedido = mysqli_query($conn, $insert_table);
	echo "<br>";
	  $update_table = "UPDATE mesas SET status = '2', nome = '$cliente' WHERE id_mesa = $mesa";
	//   $adiciona_pedido = mysqli_query($conn, $update_table);

	// header("Location: ../app/app_mesas.php");

	// $conn->close();

}

 ?>


  <script src="../common/js/jquery-3.3.1.slim.min.js" ></script>
  <script src="../common/js/popper.min.js" ></script>
  <script src="../common/js/bootstrap.min.js" ></script>