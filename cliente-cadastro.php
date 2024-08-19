<?php
include("conectadb.php");
include('topo.php');
// include("header.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $cpf = $_POST['txtcpf'];
    $nome = $_POST['txtnome'];
    $email = $_POST['txtemail'];
    $cel = $_POST['txtcel'];

    //VALIDA SE O CLIENTE A CADASTRAR EXISTE
    $sql = "SELECT COUNT(cli_id) FROM tb_clientes
    WHERE cli_cpf = '$cpf'";
    // RETORNO DO BANCO
    $retorno = mysqli_query($link, $sql);
    $contagem = mysqli_fetch_array($retorno) [0];

    //VERIFICAR SE O CLIENTE EXISTE
    if($contagem == 0)
    {
    $sql = "INSERT INTO tb_clientes (cli_cpf, cli_nome, cli_email, cli_cel, cli_status)
    VALUES ('$cpf', '$nome', '$email', '$cel', '1')";
    mysqli_query($link, $sql);
    echo"<script>window.alert('CLIENTE CADASTRADO COM SUCESSO');</script>";
    echo"<script>window.location.href='login.php';</script>";
    }
    else if($contagem >= 1){
        echo"<script>window.alert('CLIENTE JÁ EXISTENTE');</script>";
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
    <title>CADASTRO DE CLIENTES</title>
</head>
<body>
<a href="backoffice.php"><img src="icons/Navigation-left-01-256.png" width="16" height="16"></a>

    <div class="container-global">
        
        <form class="formulario" action="cliente-cadastro.php" method="post">

            <label>CPF</label>
            <input type="text" name ="txtcpf" id="cpf" placeholder="000.000.000-00" maxlength="14" oninput="formatarCPF(this)" required>
            <br>
            <label>Nome</label>
            <input type="text" name="txtnome" placeholder="Digite seu nome" required>
            <br>
            <label>Email</label>
            <input type="email" name="txtemail" placeholder="Digite seu email" required>
            <br>
            <label>Celular</label>
            <input type="text" name="txtcel" id="telefone" placeholder="(00) 00000-0000" maxlength="15" required>
            <br>
            <input type="submit" value="Cadastrar Cliente">
        </form>
        <script src="scripts/script.js"></script>
    </div>
</body>
</html>