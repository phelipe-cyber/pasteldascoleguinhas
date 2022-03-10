<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>App - Pedido</title>
</head>

<body>

  <link href="../common/css/bootstrap.min.css" rel="stylesheet" />
  <form method="POST" action="../model/app_gravadb.php">
    <?php

    $categoria = $_GET['categoria'];
    $mesa = $_GET['mesa'];
    $cliente = $_GET['cliente'];
    $id = $_GET['id'];


    include_once "../model/conexao.php";

    $tab_produtos = "SELECT * FROM produtos WHERE categoria = '$categoria'";

    $produtos = mysqli_query($conn, $tab_produtos);


    $i = $_SESSION['loginapp'];

    if ($i == 1) {


    ?>

      <div class="row" style="background: #2d3339; height: 13%;">

        <h3 class="mb-12 " style="background: #2d3339; width: 5%; "></h3>
        <a style="background: #2d3339; height: 100%; width: 23%; color: white; " type="button" href="app_categoria.php?id=<?php echo $id; ?>" class="btn btn-outline-light">
          <h4>voltar</h4>
        </a>
        <h3 class="mb-12 " style="background: #2d3339; width: 16%; "></h3>

        <h4 class="mb-12 text-center" style="color: white; width: 20%; ">Mesa <?php echo $id; ?></h4>

        <h3 class="mb-12 " style="background: #2d3339; width: 36%; "></h3>


      </div>

      <div class="row">
        <h4 class="col-lg-7">
          <label for="">Cliente:</label>
          <input autofocus type="text" class="form-control" width="100%" height="100%" name="cliente" id="cliente" value="" required>
        </h4>
      </div>

      <div class="mb-12 " style=" height: 5%;"></div>

      <input class="btn btn-outline-success" type="submit" name="enviar" value="Finalizar Pedido">

      <h3 class="col-lg-6 text-center" style="color: black;"><?php echo $categoria; ?></h3>



      <table class="table">
        <thead>
          <tr>

            <th class="col-lg-1 "><b>Nome</b> </th>
            <th class="col-lg-1 "><b>Estq</b> </th>
            <th class="col-lg-1 "><b>Preço Unitário</b> </th>
            <th class="col-lg-1 "><b>Qtde.</b> </th>
            <th class="col-lg-1 "><b>Obs.</b> </th>
          </tr>
        </thead>


        <?php
        $index = 0;
        while ($rows_produtos = mysqli_fetch_assoc($produtos)) { ?>
          <tbody>
            <tr>

              <td style="color: #ac4549;"><b><?php echo $rows_produtos['nome']; ?></b></td>

              <td><?php echo $rows_produtos['estoque_atual']; ?></td>
              <td>R$ <?php echo $rows_produtos['preco_venda']; ?></td>
              <td>

                <!-- <form method="GET" action="app_finalizar.php"> -->
                <!-- <form method="GET" action="app_gravadb.php"> -->

                <input type="hidden" name="detalhes[<?= $index ?>][id_produto]" id="id_produto" value="<?php echo $rows_produtos['id']; ?>">
                <input type="hidden" name="detalhes[<?= $index ?>][id]" id="id" value="<?php echo $id; ?>">
                <input type="hidden" name="detalhes[<?= $index ?>][nome]" id="nome" value="<?php echo utf8_encode($rows_produtos['nome']); ?>">
                <input type="hidden" name="detalhes[<?= $index ?>][mesa]" id="mesa" value="<?php echo "Mesa " . $mesa ?>">
                <input type="hidden" name="detalhes[<?= $index ?>][preco]" id="preco" value="<?php echo $rows_produtos['preco_venda']; ?>">
                <!-- <input type="hidden" name="detalhes[<?= $index ?>][cliente]" id="cliente" value="<?php echo $cliente; ?>"> -->
                <input type="hidden" name="detalhes[<?= $index ?>][categoria]" id="categoria" value="<?php echo $categoria; ?>">
                <!-- <button type="submit" class="btn btn-danger btn-icon-split btn-sm" >+</button> -->

                <input class="bg-gradient-success" value="+" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"></input>
                <input class="bg-gradient-default text-center" style="width:50px;" name="detalhes[<?= $index ?>][quantidade]" min="0" maxlength="5" name="quantity" value="0" type="number">
                <input class="bg-gradient-danger" value="-" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></input>

              </td>
              <td>
                <textarea name="detalhes[<?php echo $index ?>][observacoes]" class="form-control" id="observacoes"></textarea>

              </td>
  </form>
  </tr>
  </tbody>
<?php $index++;
        } ?>


</table>


<!-- Extra large modal -->
<div class="modal fade bd-example-modal-xl" id="sair" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      sair
    </div>
  </div>
</div>


<?php } else {
?>
  <script>
    window.location.href = 'app_login.php'
  </script>
<?php
      // header('Location: app_login.php');
    }
?>


<script src="../common/js/jquery-3.3.1.slim.min.js"></script>
<script src="../common/js/popper.min.js"></script>
<script src="../common/js/bootstrap.min.js"></script>

</body>

</html>