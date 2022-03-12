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

$produtos = mysqli_query($conn, $tab_produtos);  

include_once("table.php");

?>
    </form>