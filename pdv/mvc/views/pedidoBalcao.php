<?php

$categoria = $_POST['categoria'];
$pesquisa = $_POST['pesquisa'];
$mesa = $_POST['mesa'];
$cliente = $_POST['cliente'];
?>

<div class="row">
    <div class="col-lg-1" style="height: 80px; color: #4D4D4D;"></div>
    <form method="POST" id="" action="" class="mb-10 text-center">
        <input type="text" name="pesquisa" id="pesquisa" placeholder="Digite o nome do produto"><label type="hidden" style="width: 10px;"></label>
        <input class="btn btn-outline-warning" type="submit" name="enviar" value="Pesquisar">
        <input type="hidden" name="categoria" id="categoria" value="<?php echo $categoria; ?>">
        <input type="hidden" name="mesa" id="mesa" value="<?php echo $mesa; ?>">
        <input type="hidden" name="cliente" id="cliente" value="<?php echo $cliente; ?>">
    </form>

    <div class="col-lg-1">
        <form action="mvc/model/ad_pedido_balcao.php" method="POST">
            <input class="btn btn-outline-success" type="submit" name="enviar" value="Finalizar Pedido">
    </div>

</div>


<?php
include "./mvc/model/conexao.php";

?>

<?php
if ($pesquisa == ' ') {

    $tab_produtos = "SELECT * FROM produtos ";

    $produtos = mysqli_query($conn, $tab_produtos);  ?>

    <div class="container-fluid">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Estoque</th>
                    <th>Preço Unitário</th>
                    <th>Adicionar</th>
                </tr>
            </thead>
            <?php
            while ($rows_produtos = mysqli_fetch_assoc($produtos)) { ?>
                <tbody>
                    <tr>
                        <td><?php echo ($rows_produtos['id']); ?></td>
                        <td><?php echo ($rows_produtos['codigo']); ?></td>
                        <td style="color: #4D4D4D;"><b><?php echo ($rows_produtos['nome']); ?></b></td>
                        <td><?php echo ($rows_produtos['categoria']); ?></td>
                        <td><?php echo ($rows_produtos['estoque_atual']); ?></td>
                        <td>R$ <?php echo ($rows_produtos['preco_venda']); ?></td>

                        <td>

                            <div data-app="product.quantity" id="quantidade">

                                <input value="-" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></input>
                                <input class="text-center" style="width:50px;" name="quantidade[<?= $index ?>][quantidade]" min="0" maxlength="5" name="quantity" value="0" type="number">
                                <input value="+" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"></input>

                            </div>



                        </td>

                        <!-- <td><button type="button" class="btn btn-info btn-icon-split btn-sm" data-idcliente="<?php echo $cliente; ?>" data-idnome="<?php echo $rows_produtos['nome']; ?>" data-idmesa="<?php echo $mesa; ?>" data-idpreco="<?php echo $rows_produtos['preco_venda']; ?>" data-toggle="modal" data-target="#adiciona">Selecionar</button></td> -->
                    </tr>
                </tbody>
            <?php } ?>


        </table>
    </div>

    <?php
} else {

    $tab_produtos = "SELECT * FROM produtos WHERE nome LIKE '%$pesquisa%' OR codigo LIKE '%$pesquisa%' OR categoria LIKE '%$pesquisa%'";

    $produtos = mysqli_query($conn, $tab_produtos);

    if (mysqli_num_rows($produtos) <= 0) { ?>

        <div class="container-fluid">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Estoque</th>
                        <th>Preço Unitário</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <td>000</td>
                    <td>"Nenhum encontrado..."</td>
                    <td>Nenhuma</td>
                    <td>000</td>
                    <td>R$ 0.00</td>
                    <td>
                        <div class="row">

                            <form method="POST" id="" action="" class="mb-10 text-center">
                                <input class="btn btn-outline-danger" type="submit" name="enviar" value="Voltar">
                                <input type="hidden" name="categoria" id="categoria" value="<?php echo ($categoria); ?>">
                                <input type="hidden" name="mesa" id="mesa" value="<?php echo ($mesa); ?>">
                                <input type="hidden" name="pesquisa" id="pesquisa" value=" ">
                                <input type="hidden" name="cliente" id="cliente" value="<?php echo ($cliente); ?>">
                            </form>
                        </div>
                    </td>
                </tbody>
            </table>
        </div>



    <?php
    } else {

    ?>

        <div class="row">
            <h4 class="col-lg-7">
                <label for="">Cliente:</label>
                <input autofocus type="text" class="form-control" width="100%" height="100%" name="cliente" id="cliente" value="" required >
            </h4>
        </div>


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
                                    <input name="detalhes[<?php echo $index ?>][pedido]" type="hidden" class="form-control" id="pedido" value="<?php echo $rows_produtos['nome']; ?>">
                                </td>
                                <td><?php echo ($rows_produtos['categoria']); ?></td>
                                <!-- <td><?php echo ($rows_produtos['estoque_atual']); ?></td> -->

                                <td>R$ <?php echo ($rows_produtos['preco_venda']); ?>
                                    <input name="detalhes[<?php echo $index ?>][preco_venda]" type="hidden" class="form-control" id="preco_venda" value="<?php echo ($rows_produtos['preco_venda']); ?>">

                                </td>
                                <!-- <td><button type="button" class="btn btn-info btn-icon-split btn-sm" data-idnome="<?php echo $rows_produtos['nome']; ?>" data-idmesa="<?php echo $mesa; ?>" data-idpreco="<?php echo $rows_produtos['preco_venda']; ?>" data-toggle="modal" data-target="#adiciona">Selecionar</button></td> -->
                                <td>

                                    <div data-app="product.quantity" id="quantidade">

                                        <input value="-" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></input>
                                        <input class="text-center" style="width:50px;" name="detalhes[<?php echo $index ?>][quantidade]" min="0" maxlength="5" name="quantity" value="0" type="number">
                                        <input value="+" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"></input>

                                    </div>

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


<?php

    }
}

?>






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