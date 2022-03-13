<?php
session_start();
// include_once("conexao.php");
include "./mvc/model/conexao.php";
date_default_timezone_set('America/recife');

// print_r($_POST);
// exit();

$user =  $_SESSION['user'];
$hora_pedido = date('H:i');

$categoria = $_POST['categoria'];
$pesquisa = $_POST['pesquisa'];
$mesa = $_POST['mesa'];
$cliente = $_POST['cliente'];
// print_r($_POST);
?>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/js/mdb.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<div class="row">

    <div class="col-8"></div>
    <div class="col-4" id="mensagem" style="visibility: visible"><?php if (isset($_SESSION['msg'])) {
                                                                        echo $_SESSION['msg'];
                                                                        unset($_SESSION['msg']);
                                                                    } ?></div>
</div>

<br>

<?php

$tab_produtos = "SELECT * FROM produtos ";

$produtos = mysqli_query($conn, $tab_produtos);

if ($mesa == 'delivery') {
?>
    <form action="mvc/model/ad_pedido.php" method="POST">
        <input type="hidden" name="categoria" id="categoria" value="<?php echo $categoria; ?>">
        <input type="hidden" name="mesa" id="mesa" value="<?php echo $mesa; ?>">
        <!-- <input type="hidden" name="cliente" id="cliente" value="<?php echo $cliente; ?>"> -->
        <div class="row">
            <h4 class="col-lg-7">
                <label for="">Cliente:</label>
                <input autofocus type="text" class="form-control" width="100%" height="100%" name="cliente" id="cliente" value="<?php echo $cliente ?>">
            </h4>
        </div>

        <input class="btn btn-outline-success" type="submit" name="enviar" value="Finalizar Pedido">

    <?php

} else {

    ?>
        <form action="mvc/model/ad_pedido_balcao.php" method="POST">
            <input type="hidden" name="categoria" id="categoria" value="<?php echo $categoria; ?>">
            <input type="hidden" name="mesa" id="mesa" value="<?php echo $mesa; ?>">
            <!-- <input type="hidden" name="cliente" id="cliente" value="<?php echo $cliente; ?>"> -->
            <div class="row">
                <h4 class="col-lg-7">
                    <label for="">Cliente:</label>
                    <input autofocus type="text" class="form-control" width="100%" height="100%" name="cliente" id="cliente" value="" required>
                </h4>
            </div>

            <input class="btn btn-outline-success" type="submit" name="enviar" value="Finalizar Pedido">

        <?php
    }
        ?>
        <div class="row" style="justify-content:center; align-items: center; width: 100%; ">
            <!-- <div class="col-2"> -->
            <!-- <div class="flex-center flex-column"> -->
            <!-- <div class="card card-body"> -->

            <!-- <div class="table-responsive"> -->
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm reponsive" cellspacing="0" width="100%">
                <!-- <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> -->
                <thead>
                    <tr>

                        <th class="th-sm">#</th>
                        <th class="th-sm">Nome</th>
                        <th class="th-sm">Qtde.</th>
                        <th class="th-sm">Observação</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 0;
                    while ($rows_produtos = mysqli_fetch_assoc($produtos)) {
                    ?>

                        <tr>
                            <td><?php echo $rows_produtos['id']; ?>

                            </td>

                            <td style="color: #4D4D4D;"><?php echo ($rows_produtos['nome']); ?>
                                <input name="detalhes[<?php echo $index ?>][pedido]" type="hidden" class="form-control" id="pedido" value="<?php echo ($rows_produtos['nome']); ?>">
                                <p style="color: #4D4D4D;">
                                    <b>
                                        R$ <?php echo ($rows_produtos['preco_venda']); ?>
                                    </b>
                                </p>
                                <input name="detalhes[<?php echo $index ?>][preco_venda]" type="hidden" class="form-control" id="preco_venda" value="<?php echo ($rows_produtos['preco_venda']); ?>">
                            </td>
                            <td>
                                <input class="bg-gradient-danger" value="-" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></input>
                                <input class="bg-gradient-default text-center" style="width:50px;" name="detalhes[<?= $index ?>][quantidade]" min="0" maxlength="5" name="quantity" value="0" type="number">
                                <input class="bg-gradient-success" value="+" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"></input>
                            </td>

                            <td>

                                <textarea name="detalhes[<?php echo $index ?>][observacoes]" class="form-control" id="observacoes"></textarea>

                            </td>

                        </tr>

                    <?php $index++;
                    } ?>


                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                $('#dtBasicExample').DataTable({
                    // "pagingType": "simple", // "simple" option for 'Previous' and 'Next' buttons only
                    // "ordering": false, // false to disable sorting (or any other option)
                    "paging": false, // false to disable pagination (or any other option)
                });
            })
        </script>
        <script type="text/javascript">
            var var1 = document.getElementById("mensagem");
            setTimeout(function() {
                var1.style.display = "none";
            }, 5000)
        </script>
        </form>