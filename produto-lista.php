<?php

include("conectadb.php");
include("topo.php");

//A PÁGINACARREGOU. O UQE ELA VAI TAZER?

//PÉSUISA NO BANCO TODOS OS PRODUTOS DO NANCO

$sql = "SELECT * FROM tb_produtos WHERE pro_status ='1'";
$retorno = mysqli_query($link, $sql);
$status = '1';

//FUNÇÃO APÓS CLICK DO RADIO ATIVO E INATIVO
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $status =$_POST['status'];
    if ($status == 1){
        $sql = "SELECT * FROM tb_produtos WHERE pro_status = '1'";
        $retorno = mysqli_query ($link, $sql);
    }
    else{
        $sql = "SELECT * FROM tb_produtos WHERE pro_status ='0'";
        $retorno = mysqli_query ($link, $sql);
    }
}


?>





<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/thebakery" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <title>LISTA PRODUTO</title>
</head>
<body>
<a href="backoffice.php"><img src="icons/Navigation-left-01-256.png" width="16" height="16"></a>


    <div class="container-listacliente">
        <!-- FAZER DEPOIS DO ROLÊ -->
        <form action="produto-lista.php" method="post">
            <input type="radio" name ="status" value="1" required onclick="submit()">
            <?$status=='1' ? "checked": ""?>ATIVOS
            <br>
            <input type="radio" name ="status" value="0" required onclick="submit()">
            <?$status=='0' ? "checked": ""?>INATIVOS
            <br>           
        </form>
        <!-- LISTAR A TABELA DE USUARIOS -->
        <table class="lista">
            <tr>
                <th>NOME PRODUTO</th>
                <th>QUANTIDADE</th>
                <th>UNIDADE</th>
                <th>PREÇO</th>
                <th>STATUS</th>
                <th>IMAGEM</th>
                <th>ALTERAR</th>
            </tr>

            <!-- Buscar no Banco todos os clientes -->
             <?php
                while($tbl = mysqli_fetch_array($retorno)){
                 ?>
                 <tr>
                    <td><?=$tbl[1]?></td> <!-- COLETA O NOME DO PRODUTO-->
                    <td><?=$tbl[2]?></td> <!-- COLETA A QUANTIDADE DO PRODUTO -->
                    <td><?=$tbl[3]?></td> <!-- COLETA A UNIDADE DO PRODUTO-->
                    <td><?=$tbl[4]?></td> <!-- COLETA O PREÇO-->
                    <td><?=$tbl[5] == '1' ? "ATIVO":"INATIVO" ?> </td> <!-- COLETA O STATUS DO CLIENTE-->
                    <td><img src='data:image/jpeg;base64,<?= $tbl[6]?>' width="120" height ="120"></td> <!-- COLETA A IMAGEM-->

                    <td><a href="produto-altera.php?id=<?=$tbl[0]?>">
                            <input type="button" value="ALTERAR">
                        </a>
                    </td>
                 </tr>
                 <?php
                }
                ?>
        </table>

    </div>
    
</body>
</html>