<?php
include("conectadb.php");
include('topo.php');
// include("header.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $codigo_cupom = $_POST['txtcodigo'];
    $desconto = $_POST['txtdesconto'];
    $tipo_desconto = $_POST['txttipodesconto'];
    $validade = $_POST['txtvalidade'];
    $status = $_POST['txtstatus'];

    //VALIDA SE O CLIENTE A CADASTRAR EXISTE
    $sql = "SELECT COUNT(id) FROM cupons
    WHERE codigo = '$codigo_cupom'";
    // RETORNO DO BANCO
    $retorno = mysqli_query($link, $sql);
    $contagem = mysqli_fetch_array($retorno) [0];

    //VERIFICAR SE O CLIENTE EXISTE
    if($contagem == 0)
    {
    $sql = "INSERT INTO cupons (codigo, desconto, tipo_desconto, validade, usado)
    VALUES ('$codigo_cupom', '$desconto', '$tipo_desconto', '$validade', '1')";
    mysqli_query($link, $sql);
    echo"<script>window.alert('CUPOM CADASTRADO COM SUCESSO!');</script>";
    echo"<script>window.location.href='backoffice.php';</script>";
    }
    else if($contagem >= 1){
        echo"<script>window.alert('CUPOM JÁ EXISTENTE');</script>";
    }
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
    <title>CADASTRO DE CUPONS</title>
</head>
<body>
<a href="backoffice.php"><img src="icons/Navigation-left-01-256.png" width="16" height="16"></a>

    <div class="container-global">
        
        <form class="formulario" action="cupom-cadastro.php" method="post">

            <label>Código</label>
            <input type="text" name ="txtcodigo" id="codigo" placeholder="Digite o código do cupom" maxlength="25" required>
            <br>
            <label>Desconto</label>
            <input type="decimal" name="txtdesconto" placeholder="Digite o valor" required>
            <br>
            <label>Tipo</label>
            <select name='txttipodesconto'>
                <option value="porcentagem">Porcentagem</option>
                <option value="fixo">Valor Fixo</option>
            </select>
            <br>
            <br>
            <label>Data de Validade</label>
            <input type="date" name="txtvalidade" id="validade" required>
            <br>
            <input type="submit" value="Cadastrar Cupom">
        </form>
        <script src="scripts/script.js"></script>
    </div>
</body>
</html>