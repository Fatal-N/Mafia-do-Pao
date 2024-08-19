<?php

include('conectadb.php');
include('topo.php');

// COLETA O VALOR ID LÁ DA URL
$id = $_GET['id'];
$sql = "SELECT * FROM tb_clientes WHERE cli_id = '$id'";
$retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $cpf = $tbl[1]; 
        $nome = $tbl[2];
        $email = $tbl[3];
        $cel =  $tbl[4];
        $status = $tbl[5];
    }

// Realizar Update

if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $id = $_POST['id'];
    $cpf = $_POST['txtcpf'];
    $nome = $_POST['txtnome'];
    $email = $_POST['txtemail'];
    $cel = $_POST['txtcel'];
    $status = $_POST['status'];

    $sql = "UPDATE tb_clientes SET cli_nome= '$nome', cli_email= '$email', cli_cel= '$cel', cli_status= '$status' WHERE cli_id= '$id'";
    mysqli_query($link, $sql);

    echo"<script>window.alert('Cliente Alterado com Sucesso!');</script>";
    echo"<script>window.location.href='cliente-lista.php';</script>";

    exit();

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
    <a href="usuario-lista.php"><img src="icons/Navigation-left-01-256.png" width="16" height="16"></a>

    <form class="formulario" action="cliente-altera.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <label>CPF</label>
            <input type="text" name ="txtcpf" id="cpf" placeholder="000.000.000-00" maxlength="14" oninput="formatarCPF(this)" value ="<?=$cpf?>" disabled>
            <br>
            <label>Nome</label>
            <input type="text" name="txtnome" placeholder="Digite seu nome" value ="<?=$nome?>" required>
            <br>
            <label>Email</label>
            <input type="email" name="txtemail" placeholder="Digite seu email" value ="<?=$email?>" required>
            <br>
            <label>Celular</label>
            <input type="text" name="txtcel" id="telefone" placeholder="(00) 00000-0000" maxlength="15" value ="<?=$cel?>" required>
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