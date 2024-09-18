<?php
session_start();
$nomeusuario = $_SESSION['nomeusuario'];

// include ("header.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/thebakery" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <title>HOME PRINCIPAL</title>
</head>
<body>
    <div class="container-home">
    <!-- TOPO SEM MOBILE -->
        <div class="topo">
            <?php
            if ($nomeusuario != null) {
            ?>
            <label>BEM VINDO <?= strtoupper ($nomeusuario)?></label></li>
            <?php
            }
            else{
                echo"<script>window.alert('USUARIO NÃO LOGADO');
                window.location.href='login.php';</script>";
            }
            ?>
            <a href="logout.php"><img src='./icons/Exit-02-WF-256.png' width=45px height=45px></a>
        </div>
  
        <!-- BOTÕES DE MENU -->
         <div class="menu">
            <a href="usuario-cadastro.php"><span class="tooltiptext">Cadastro de Usuários</span><img src="./icons/user-add.png"></a>
            <a href="usuario-lista.php"><span class="tooltiptext">Listar Usuário</span><img src="./icons/user-find.png"></a>
            <a href="produto-cadastro.php"><span class="tooltiptext">Cadastro Produto</span><img src="./icons/box.png"></a>
            <a href="produto-lista.php"><span class="tooltiptext">Listar Produto</span><img src="./icons/gantt.png"></a>
            <a href="cliente-cadastro.php"><span class="tooltiptext">Cadastro Clientes</span><img src="./icons/customer.png" heigth= 200px width= 200px></a>
            <a href="cliente-lista.php"><span class="tooltiptext">Listar Cliente</span><img src="./icons/people.png"></a>
            <a href="vendas.php"><span class="tooltiptext">Vendas</span><img src="./icons/shopping-cart-02.png"  heigth= 200px width= 200px></a>
            <a href="vendas-lista.php"><span class="tooltiptext">Listar Vendas</span><img src="./icons/sales-order.png"  heigth= 200px width= 200px></a>
            <a href="cupom-cadastro.php"><span class="tooltiptext">Cadastro Cupons</span><img src="./icons/money.png"  heigth= 200px width= 200px></a>
            <a href="cupom-lista.php"><span class="tooltiptext">Listar Cupons</span><img src="./icons/money-credit-card.png"  heigth= 200px width= 200px></a>
         </div>
    </div>
    
</body>
</html>