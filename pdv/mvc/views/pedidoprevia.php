<?php

session_start();
// include_once("conexao.php");
// include "./mvc/model/conexao.php";


// print_r($_POST);
// exit();

// print_r($_POST);
?>
<!-- <h1 class="" id="div" > </h1> -->

<!-- <div id="div"> -->

<!-- <div class="col-xl-6 col-md-6 mb-4"> -->
        <div class="row" style="padding: 1%;">
            <div class="form-group col-md-12">
                <label for="recipient-name" class="col-xl-12 text-center"
                    style="font-size: 25px; background: gray; color: white; ">Valor Total do Pedido Previsto</label>
                <input id="pagamento" style="font-size: 25px" class="col-xl-12 col-md-6 mb-4 text-center" type="reset"
                    name="pagamento" value="0.00" disabled>

                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm reponsive"
                        cellspacing="0" width="auto">
                            
        
        <?php

    include_once "../model/conexao.php";
    
    
    $selectSQL = ("SELECT * FROM `pedido_previa` where quantidade <> ''  GROUP BY id_produto order by id ASC ");
    
    $recebidos = mysqli_query($conn, $selectSQL);
    $index = 1;
    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
        
        // echo "<tbody>";
        echo "<tr>";

        echo "<td>";
            echo "#" ." ".$index ;
        echo "</td>";

        echo "<td>";
        echo $produto = "<b>" . $row_usuario['quantidade'] ."x" . "</b> ( " . $row_usuario['produto'] . " )";
        echo "<br>";
        echo $observacao = $row_usuario['observacao'];
        echo "</td>";
        
        // echo $quantidade = $row_usuario['quantidade'];
        // echo "<br>";
        echo "<td>";
        echo "R$ ". $row_usuario['valor'];
        echo "</td>";
        
         $valor[] = $row_usuario['valor'];
        // echo "<br>";

        echo "</tr>";

        // echo "<tbody>";
        $index ++;
    }
    
    ?>
                    </table>

<script>


        document.getElementById("pagamento").value = "R$ " +  <?php echo array_sum( $valor ) ?>

</script>

</div>
        </div>
</div>
