<?php
include("conectadb.php");
include("topo.php");

//PREENCHIMENTO DOS TEXTOS
$id = $_GET['id'];
$sql = "SELECT * FROM tb_produtos WHERE pro_id = '$id'";
$retorno = mysqli_query ($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)){
    $nomeproduto = $tbl[1];
    $quantidade = $tbl[2];
    $unidade = $tbl[3];
    $preco = $tbl[4];
    $status = $tbl[5];
    $imagem = $tbl[6];
}


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/thebakery" rel="stylesheet">
                
    <title>Alteração do Cliente</title>
</head>
<body>
    <div class="container-global">
    <a href="produto-lista.php"><img src="icons/Navigation-left-01-256.png" width="16" height="16"></a>

    <form class="formulario" action="produto-altera.php" method="post" enctype="multipart/form-data">
    <label>Nome Produto</label>
            <input type="text" name="txtnome" placeholder="Digite o Nome do Produto" value = "<?= $nomeproduto?>"required>
            <br>
            <label>Quantidade</label>
            <input type="decimal" name="txtqtd" placeholder="Digite a Quantidade"  value = "<?= $quantidade?>" required>
            <br>
            <label>Unidade</label>
            <select name='txtunidade'>
                <option value=""><?=strtoupper($unidade)?></option>
                <option value="kg">KG</option>
                <option value="gr">G</option>                  
                <option value="un">UN</option>
                <option value="lt">LT</option>
            </select>
            <br>                                                                                                                                                                                                                                             
            <label>Preço</label>
            <input type="decimal" name="txtpreco" placeholder="Digite Preço" value = "<?= $preco?>" required>
            <br>
            <lavel> IMAGEM</label>
            <img src= "data:image/jpeg;base64,<?=$imagem?>" width="120" height = "120">
            <input type="file" name="imagem" id='imagem'>
            <br>

<!-- SELETOR DE ATIVO E INATIVO-->
 <div class="bullets">
<input type="radio" name="status" value ="1" <?= $status == "1"?"checked": ""?>>ATIVO
         <input type="radio" name="status" value ="0" <?= $status == "0"?"checked": ""?>>INATIVO
            <br>
            <input type="submit" value="CONFIRMAR">
    </form>

    </div>
    
</body>
</html>