<?php

$categoria = $_POST['categoria'];
$pesquisa = $_POST['pesquisa'];
$mesa = $_POST['mesa'];
$cliente = $_POST['cliente'];
?>



<div class="row">

    <input type="hidden" name="categoria" id="categoria" value="<?php echo $categoria; ?>">
    <input type="hidden" name="mesa" id="mesa" value="<?php echo $mesa; ?>">
    <input type="hidden" name="cliente" id="cliente" value="<?php echo $cliente; ?>">

    <div class="col-lg-1">
        <form action="mvc/model/ad_pedido_balcao.php" method="POST">
            <input class="btn btn-outline-success" type="submit" name="enviar" value="Finalizar Pedido">
    </div>

</div>
<br>
<div class="row">
    <h4 class="col-lg-7">
        <label for="">Cliente:</label>
        <input autofocus type="text" class="form-control" width="100%" height="100%" name="cliente" id="cliente" value="" required>
    </h4>
</div>
<br>

<?php
include "./mvc/model/conexao.php";

?>

<?php


$tab_produtos = "SELECT * FROM produtos ";

$produtos = mysqli_query($conn, $tab_produtos);  ?>

<div class="container-fluid">
                <div class="table-responsive" style="overflow: auto; height: 400px">
                    <table class="table table-striped table-sm">
                        <!-- <table class="table table-striped table-sm"> -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <!-- <th>Estoque</th> -->
                                <th>Preço Unitário</th>
                                <th class="text-center">Qtde.</th>
                                <th class="text-center">Observação</th>
                            </tr>
                        </thead>

                        <?php
                        $index = 0;
                        while ($rows_produtos = mysqli_fetch_assoc($produtos)) {
                        ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $rows_produtos['id']; ?>

                                    </td>
                                    <td><?php echo $rows_produtos['codigo']; ?></td>
                                    <td style="color: #4D4D4D;"><b><?php echo ($rows_produtos['nome']); ?></b>
                                        <input name="detalhes[<?php echo $index ?>][pedido]" type="hidden" class="form-control" id="pedido" value="<?php echo ($rows_produtos['nome']); ?>">
                                    </td>
                                    <td><?php echo ($rows_produtos['categoria']); ?></td>
                                    <!-- <td><?php echo ($rows_produtos['estoque_atual']); ?></td> -->

                                    <td>R$ <?php echo ($rows_produtos['preco_venda']); ?>
                                        <input name="detalhes[<?php echo $index ?>][preco_venda]" type="hidden" class="form-control" id="preco_venda" value="<?php echo ($rows_produtos['preco_venda']); ?>">

                                    </td>
                                    <!-- <td><button type="button" class="btn btn-info btn-icon-split btn-sm" data-idnome="<?php echo $rows_produtos['nome']; ?>" data-idmesa="<?php echo $mesa; ?>" data-idpreco="<?php echo $rows_produtos['preco_venda']; ?>" data-toggle="modal" data-target="#adiciona">Selecionar</button></td> -->
                                    <td>
                                            <input class="bg-gradient-danger" value="-" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></input>
                                            <input  class="bg-gradient-default text-center" style="width:50px;" name="detalhes[<?= $index ?>][quantidade]" min="0" maxlength="5" name="quantity" value="0" type="number">
                                            <input class="bg-gradient-success" value="+" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"></input>
                                    </td>

                                    <td>

                                        <textarea name="detalhes[<?php echo $index ?>][observacoes]" class="form-control" id="observacoes"></textarea>

                                    </td>

                                </tr>
                            </tbody>
                        <?php $index++;
                        } ?>
                    </table>


                </div>
                <br>
            </div>


</form>