<?php
include("conectadb.php");
include("topo.php");
 
//a pagina carregou oq ele vai trazer?
 
//pesquisa no banco todos os produtos do banco
$sql= "SELECT * FROM cupons";
$retorno = mysqli_query($link, $sql);
$status = '1';
//função apos click do radio ativo e inativo
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = $_POST['status'];
 
    if($status == '1'){
        $sql = "SELECT * FROM cupons WHERE usado = '1'";
        $retorno = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT * FROM cupons WHERE usado = '0'";
        $retorno = mysqli_query($link, $sql);
    }
}
 
 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/thebakery" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
    <title>LISTA PRODUTO</title>
</head>
<body>
 
 
   
 
    <div class="container-listacliente">
    <form action="cupom-lista.php" method="post">
        <input type="radio" name="status" value="1" required onclick="submit()" <?= $status=='1' ? "checked": ""?>>Ativos
        <br>
        <input type="radio" name="status" value="0" required onclick="submit()" <?= $status=='0' ? "checked": ""?>>Inativos
        <br>
    </form>
   
    <table class="lista">
        <tr>
           
            <th>CUPOM</th>
            <th>DESCONTO</th>
            <th>TIPO</th>
            <th>VALIDADE</th>
            <th>STATUS</th>
            <th>ALTERAR</th>
           
           
        </tr>
 
        <?php
        while($tbl = mysqli_fetch_array($retorno)){
            ?>
            <tr>
               
                <td><?=$tbl[1]?></td>
                <td><?=$tbl[2]?></td>
                <td><?=$tbl[3]?></td>
                <td><?=$tbl[4]?></td>
                <td><?=$tbl[5] == '1'?"Ativo":"Inativo" ?></td>              
                <td><a href="cupom-altera.php?id=<?=$tbl[0]?>"><input type="button" value="ALTERAR"></a></td>
            </tr>
            <?php
        }
        ?>
    </table>
 
    </div>
 
 
 
</body>
</html>