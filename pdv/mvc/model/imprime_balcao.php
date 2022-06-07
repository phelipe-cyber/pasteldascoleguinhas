<html lang="pt-br">
<title>Pedido - Balcão</title>
<?php
    date_default_timezone_set('America/Sao_Paulo');
// $data_hora = date('d/m/Y - H:i:s');
$hora_pedido = date('H:i');
include "conexao.php";

    // print_r($_POST);
    // exit();
    $id = $_POST['id'];
    $cliente = $_POST['cliente'];
   
    $pgto = $_POST['pgto'];
    // $data_pedido = $_POST['data_pedido'];


     $select_DB = "SELECT * FROM pedido WHERE numeropedido LIKE '$id'";

     $Result_pedido = mysqli_query($conn, $select_DB) or die(mysqli_error($conn));

     while ($rows_Result_pedido = mysqli_fetch_assoc($Result_pedido)) {
        //  $data_hora = $rows_Result_pedido['data'];
     $data_hora = date('d/m/Y H:i:s', strtotime( $rows_Result_pedido['data']));

     }
     
     ?>
<div style="text-align: center;">
    <label for="">PASTEL DAS COLEGUINHAS</label>
    <br>
    <label for="">CNPJ - 45.533.274/0001-84</label>
    <br>
    <label for="">R. das Ostras, 300 - Jardim Paraiso Barueri - SP</label>
    <br>
    <label for="">06412-250</label>
</div>

<h1 class="text-center col-lg-2"><b>Pedido #<?php echo $id ?></b> </h1>

<div class="row">
    <a class="text-center col-lg-2"><b>Forma de Pgto: </b><?php echo $pgto; ?></a><br>
    <!-- <a class="text-center"><b><?php echo $pgto; ?></b><br> -->
    <hr>


    <a class="text-center col-lg-2"><b>Cliente: </b><?php echo $cliente ?></a></br>
    <a class="text-center col-lg-2"><b>Data Hora: </b><?php echo $data_hora ?></a>
    <!-- <hr> -->
    <table BORDER RULES=rows id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"
        style="text-align: center">
        <thead>
            <tr >
                <th class="th-sm">#</th>
                <th class="th-sm">Descrição</th>
                <th class="th-sm">Valor Unit</th>
                <th class="th-sm">Qtde Unit</th>
                <th class="th-sm">Observação</th>
                <th class="th-sm">Total</th>
            </tr>
        </thead>
        <tbody>

            <?php

        include_once "conexao.php";

        $idpedido = '';
        $total = 0;
        $i = 0;
        $index = 1;

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
            $data_hora = $rows_clientes['data'];

            $subtotal = $valor * $quantidade;
            $total += $subtotal;

            $i++;

            $total = number_format($total, 2); ?>

            <tr  >

                <td class="th-sm"> <?php echo $index ?> </td>
                <td class="th-sm"> <?php echo $produto ?> </td>
                <td class="th-sm"> <?php echo $valor ?> </td>
                <td class="th-sm"> <?php echo $quantidade ?> un </td>
                <td class="th-sm"> <?php echo $obs ?> </td>
                <td class="th-sm"> <?php echo $total ?> </td>

            </tr>


            <!-- <a class="text-center col-lg-2"> # <?php echo $i; ?></a> -->
            <!-- </br> -->
            <!-- <b>
                    <a class="text-center"><?php echo $produto; ?></a>    
                </b>
                &nbsp;&nbsp;
            <a class="text-center col-lg-2">un.</a>
            <a class="text-center"> <b> <?php echo $quantidade ?></a> </b>
            &nbsp;&nbsp;
            <a class="text-center">R$ <b><?php echo $total ?></b> </a>
            </br>
                <a class="text-center col-lg-2">Obs : <?php echo $obs; ?></a>
             -->



            <?php
            $index ++;
           }
        ?>
        </tbody>
    </table>
    <!-- <hr> -->
    <?php
        $valorTotal = "SELECT sum( quantidade * valor ) AS totalValor FROM pedido WHERE numeropedido = '$id'";

        $pedido = mysqli_query($conn, $valorTotal);

        while ($rows_clientes = mysqli_fetch_assoc($pedido)) {
            $Total = $rows_clientes['totalValor'];
        ?>
    <a class="text-center"><b>Valor Total:</b></a>
    <a class="text-center">R$: <b><?php echo number_format($Total, 2); ?></b></a><br><br>
    <?php
        }
        ?>

</div>

</body>


<script>
    window.print();
    window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint();
</script>


</html>