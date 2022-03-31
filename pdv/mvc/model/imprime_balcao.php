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
    $cliente = $_POST['cliente'];
    $pgto = $_POST['pgto'];

    ?>
    <h3 class="text-center">Pedido - Balcão</h3>

    <div class="row">
        <a class="text-center col-lg-2"><b>Forma de Pgto: </b><?php echo $pgto; ?></a><br>
        <!-- <a class="text-center"><b><?php echo $pgto; ?></b><br> -->
        <hr>
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
            $pgto = $rows_clientes['pgto'];

            $subtotal = $valor * $quantidade;
            $total += $subtotal;

            $i++;

            $total = number_format($total, 2); ?>

            <hr>
            <a class="text-center col-lg-2"><b>Pedido #<?php echo $i; ?>:</b></a><br>
            <a class="text-center"><?php echo $produto; ?></a><br>

            <a class="text-center col-lg-2"><b>Quantidade:</b></a>
            <a class="text-center"><?php echo $quantidade; ?></a><br>

            <a class="text-center"><b>R$ <?php echo $total; ?></b></a><br>

            <a class="text-center col-lg-2"><b>Obs. :</b><?php echo $obs; ?></a>


        <?php
        }

        ?>
        <hr>
        <?php
        $valorTotal = "SELECT sum( quantidade * valor ) AS totalValor FROM pedido WHERE numeropedido = '$id'";

        $pedido = mysqli_query($conn, $valorTotal);

        while ($rows_clientes = mysqli_fetch_assoc($pedido)) {
            $Total = $rows_clientes['totalValor'];
        ?>
            <a class="text-center"><b>Valor Total do pedido:</b></a>
            <a class="text-center">R$: <?php echo number_format($Total, 2); ?></a><br><br>
        <?php
        }
        ?>

        <br><br>

    </div>

</body>

<!-- <script type="text/javascript"> -->
     <!-- window.print(); -->
 <!-- </script> -->

<!-- <script> -->
     <!-- window.close(); -->
<!-- </script> -->

<script>
    window.print();
    window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint();
</script>

<!-- <script type="text/javascript">  -->
     <!-- window.onload = function() { window.print(); }  -->
 <!-- </script> -->

<?php
// echo '<meta http-equiv="refresh" content="0;URL=/pdv/?view=todosPedidoBalcao" />';
?>

</html>