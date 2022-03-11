<?php

$categoria = $_POST['categoria'];
$pesquisa = $_POST['pesquisa'];
$mesa = $_POST['mesa'];
$cliente = $_POST['cliente'];
$nomecliente = $_POST['nomecliente'];
$pedido = $_POST['pedido'];

?>

<div class="row">
    <h4 class="col-lg-3">
        <label for="">Pedido: <?php echo $pedido ?></label>
    </h4>
</div>

<div class="row">
    <!-- <div class="col-lg-1" style="height: 80px; color: #4D4D4D;"></div> -->
    <form method="POST" id="" action="" class="mb-10 text-center">
        <!-- <input type="text" name="pesquisa" id="pesquisa" placeholder="Digite o nome do produto"><label type="hidden" style="width: 10px;"></label> -->
        <!-- <input class="btn btn-outline-warning" type="submit" name="enviar" value="Pesquisar"> -->
        <input type="hidden" name="categoria" id="categoria" value="<?php echo $categoria; ?>">
        <input type="hidden" name="mesa" id="mesa" value="<?php echo $mesa; ?>">
        <input type="hidden" name="cliente" id="cliente" value="<?php echo $cliente; ?>">
    </form>

    <div class="col-lg-1">
        <form action="mvc/model/ad_pedido_balcao.php" method="POST">
            <input class="btn btn-outline-success" type="submit" name="enviar" value="Incluir no Pedido">
    </div>

</div>
<br>

<?php
include "./mvc/model/conexao.php";

?>
<input type="hidden" name="pedido" value="<?php echo $pedido ?>">
<input type="hidden" name="nomecliente" value="<?php echo $nomecliente ?>">

<?php

$tab_produtos = "SELECT * FROM produtos ";

$produtos = mysqli_query($conn, $tab_produtos);  ?>

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
                        <!-- <th class="th-sm">Codigo</th> -->
                        <th class="th-sm">Nome</th>
                        <th class="th-sm">Categoria</th>
                        <th class="th-sm">Preço Unitário</th>
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
                            <!-- <td><?php echo $rows_produtos['codigo']; ?></td> -->
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

    <!-- CRIA O SCRIPT JQUERY PARA TRATAR DOS DADOS QUE VEEM COM A CHAMADA DA REQUIZIÇÃO DO MODAL -->
    <script type="text/javascript">
        $('#adiciona').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget) // Button that triggered the modal

            var recipientmesa = button.data('idmesa')
            var recipientnome = button.data('idnome')
            var recipientpreco = button.data('idpreco')
            var recipientcliente = button.data('idcliente')



            var modal = $(this)
            modal.find('.modal-title').text('Mesa  ' + recipientmesa)
            modal.find('#pedido').val(recipientnome)
            modal.find('#preco_venda').val(recipientpreco)
            modal.find('#id_mesa').val(recipientmesa)
            modal.find('#cliente').val(recipientcliente)

        })
    </script>
    </form>