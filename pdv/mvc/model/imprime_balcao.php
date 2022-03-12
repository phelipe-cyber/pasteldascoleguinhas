<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido - Balcão</title>
</head>

<body>

    <?php
    // print_r($_POST);
    // exit();
    $id = $_POST['id'];
    $cliente = $_POST['cliente'];
    ?>
    <h3 class="text-center">Pedido - Balcão</h3>

    <div class="row">

        <a class="text-center col-lg-2"><b>Pedido #<?php echo $id ?>:</b></a><br>

        
        <a class="text-center col-lg-2"><b>Cliente: </b><?php echo $cliente ?></a><br>


        <?php

        include_once "conexao.php";

        $idpedido = '';
        $total = 0;
        $i = 0;

        $tab_cliente = "SELECT * FROM pedido WHERE numeropedido LIKE '$id'";

        $pedido = mysqli_query($conn, $tab_cliente) or die(mysqli_error($conn));

        while ($rows_clientes = mysqli_fetch_assoc($pedido)) {

            if ($idpedido != $rows_clientes['idpedido']) {
                $idpedido = $rows_clientes['idpedido'];
                $total = 0;
            }

            $produto = ($rows_clientes['produto']);
            $quantidade = $rows_clientes['quantidade'];
            $valor = $rows_clientes['valor'];
            $cliente = $rows_clientes['cliente'];
            $obs = $rows_clientes['observacao'];
            $numeropedido = $rows_clientes['numeropedido'];
            $totalValor = $rows_clientes['totalValor'];

            $subtotal = $valor * $quantidade;
            $total += $subtotal;

            $totalGeral = $subtotal + $total;

            $i++;

            $total = number_format($total, 2); ?>

            <hr>
            <a class="text-center col-lg-2"><b>Pedido #<?php echo $i; ?>:</b></a><br>
            <a class="text-center"><?php echo $produto; ?></a><br>

            <a class="text-center col-lg-2"><b>Quantidade:</b></a>
            <a class="text-center"><?php echo $quantidade; ?></a><br>

            <a class="text-center col-lg-2"><b>Total :</b></a>
            <a class="text-center"><b>R$ <?php echo $total; ?></b></a><br>

            <a class="text-center col-lg-2"><b>Obs. :</b><?php echo $obs; ?></a>


        <?php
        }

        ?>
        <hr>
            <?php
                $valorTotal = "SELECT SUM(valor) AS totalValor FROM pedido WHERE numeropedido LIKE '%$id%'";

                $pedido = mysqli_query($conn, $valorTotal);

                while ($rows_clientes = mysqli_fetch_assoc($pedido)) {
                   $Total = $rows_clientes['totalValor'];
                }
            ?>
        
        <a class="text-center"><b>Valor Total do pedido:</b></a>
        <a class="text-center"><?php echo $Total; ?></a><br><br>

        <!-- <a class="text-center col-lg-2"><b>Nome:</b></a>
        <a class="text-center"><?php echo $nome; ?></a><br><br>


        <a class="text-center"><b>Bairro:</b></a>
        <a class="text-center"><?php echo $bairro; ?></a><br><br>

        <a class="text-center"><b>Complemento:</b></a>
        <a class="text-center"><?php echo $complemento; ?></a><br><br>

        <a class="text-center"><b>Ponto de Referência:</b></a>
        <a class="text-center"><?php echo $pontoreferencia; ?></a><br><br>

        <a class="text-center"><b>Telefone #1:</b></a>
        <a class="text-center"><?php echo $tel1; ?></a><br><br>

        <a class="text-center"><b>Telefone #2:</b></a>
        <a class="text-center"><?php echo $tel2; ?></a><br><br>

        <a class="text-center"><b>Condomínio:</b></a>
        <a class="text-center"><?php echo $condominio; ?></a><br><br>

        <a class="text-center"><b>Bloco/Edifício:</b></a>
        <a class="text-center"><?php echo $blocoedificio; ?></a><br><br>

        <a class="text-center"><b>Apartamento:</b></a>
        <a class="text-center"><?php echo $apartamento; ?></a><br><br>

        <a class="text-center"><b>Local da Entrega:</b></a>
        <a class="text-center"><?php echo $local_entrega; ?></a><br><br>

        <a class="text-center"><b>Observações:</b></a><br>
        <a class="text-center"><?php echo $observacoes; ?></a><br><br> -->
    </div>

</body>

<script type="text/javascript">
	 window.print();
 </script> 

<script type="text/javascript"> 
     window.onload = function() { window.print(); } 
 </script>
<?php
    echo '<meta http-equiv="refresh" content="0;URL=/pdv/?view=todosPedidoBalcao" />';  
?>

</html>