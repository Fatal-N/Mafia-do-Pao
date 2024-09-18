<?php
include('conectadb.php');
include('topo.php');
// include('header.php');

// Consultar Clientes Cadastrados
$sql = "SELECT * FROM tb_clientes WHERE cli_status = '1'";
$retorno = mysqli_query($link, $sql);
$status = '1';

// ENVIANDO PARA O SERVIDOR O SELETOR RADIO 0 E 1
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $status =$_POST['status'];
    if($status == 1)
    {
        $sql = "SELECT * FROM tb_clientes WHERE cli_status = '1'";
        $retorno = mysqli_query($link, $sql);
    }
    else 
    {
        $sql = "SELECT * FROM tb_clientes WHERE cli_status = '0'";
        $retorno = mysqli_query($link, $sql);
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
    <title>LISTA DE USUARIOS</title>
</head>
<body>
<a href="backoffice.php"><img src="icons/Navigation-left-01-256.png" width="16" height="16"></a>


    <div class="container-listacliente">
        <!-- FAZER DEPOIS DO ROLÊ -->
        <form action="cliente-lista.php" method="post">
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
                <th>CPF</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>CELULAR</th>
                <th>STATUS</th>
                <th>ALTERAR</th>
            </tr>

            <!-- Buscar no Banco todos os clientes -->
             <?php
                while($tbl = mysqli_fetch_array($retorno)){
                 ?>
                 <tr>
                    <td><?=$tbl[1]?></td> <!-- COLETA O CPF DO CLIENTE-->
                    <td><?=$tbl[2]?></td> <!-- COLETA O NOME DO CLIENTE -->
                    <td><?=$tbl[3]?></td> <!-- COLETA O EMAIL DO CLIENTE-->
                    <td><?=$tbl[4]?></td> <!-- COLETA O CELULAR DO CLIENTE-->
                    <td><?=$tbl[5] == '1' ? "ATIVO":"INATIVO" ?> </td> <!-- COLETA O STATUS DO CLIENTE-->
                    <td><a href="cliente-altera.php?id=<?=$tbl[0]?>">
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