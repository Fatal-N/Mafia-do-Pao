<?php
include("conectadb.php");
include("topo.php");
 
// A PÁGINA CARREGOU..... O QUE ELA VAI FAZER?
 
$id = $_GET['id'];
$sql = "SELECT pro.pro_id, pro.pro_nome, pro.pro_imagem, pro.pro_preco,
iv.iv_quantidade, iv.iv_valortotal,iv.iv_id, iv.iv_cod_iv
FROM tb_produtos pro
JOIN tb_item_venda iv ON pro.pro_id = fk_pro_id
WHERE iv.iv_cod_iv = '$id'";
$retorno = mysqli_query($link, $sql);
?>
 
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/thebakery" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <title>VISUALIZAR VENDAS</title>
</head>
<body>
    <div class="container-listaproduto">
        <!-- LISTAR A TABELA DE PRODUTUS-->
        <table class="lista">
            <tr>
               
            <tr>
                <th>ID</th>
                <th>NOME DO PRODUTO</th>
                <th>VALOR UN.</th>
                <th>QUANTIDADE</th>
                <th>IMAGEM</th>
            </tr>

            </tr>
 
            <!-- O CHORO É LIVRE! CHOLA MAIS -->
            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS PRODUTOS -->
             <?php
                while($tbl = mysqli_fetch_array($retorno)){
                 ?>
                 <tr>
                    <td><?= $tbl[0] ?></td> <!-- COLETA O ID DO PRODUTO-->
                    <td><?= $tbl[1] ?></td> <!-- COLETA O NOME PRODUTO-->
                    <td><?= $tbl[5] ?></td> <!-- COLETA O VALOR UNIDADE-->
                    <td><?= $tbl[4] ?></td> <!-- COLETA A QUANTIDADE-->
                    <td><img src='data:image/jpeg;base64,<?=$tbl[2] ?>' width="120px" height="120px"></td> <!-- COLETA A IMAGEM-->
 
                    </td>
                </tr>
                 <?php
                }
                ?>
        </table>
 
    </div>
   
</body>
</html>