<?php
include("conectadb.php");
include("topo.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nomeproduto = $_POST['txtnome'];
    $quantidade = $_POST['txtqtd'];
    $unidade = $_POST['txtunidade'];
    $preco = $_POST['txtpreco'];


    //Ajustando Imagem para o Banco

    if(isset($_FILES['imagem']) && $_FILES ['imagem']['error'] === UPLOAD_ERR_OK)
    {
        $imagem_temp = $_FILES['imagem']['tmp_name'];
        $imagem = file_get_contents($imagem_temp);
        //Criptografia imagem em base64
        $imagem_base64 = base64_encode($imagem);
    };
    //Verifica de Pão de Queijo Existe
    $sql = "SELECT COUNT(pro_id) FROM tb_produtos WHERE pro_nome = '$nomeproduto'";
    $retorno = mysqli_query($link, $sql);
    $contagem = mysqli_fetch_array($retorno)[0];

    if ($contagem == 0){
        $sql = "INSERT INTO tb_produtos(pro_nome, pro_quantidade, pro_unidade, pro_preco, pro_status, pro_imagem)
        VALUES ('$nomeproduto', $quantidade, '$unidade', $preco, '1', '$imagem_base64')";
        $retorno = mysqli_query($link, $sql); 
        echo"<script>window.alert('PRODUTO CADASTRADO');</script>";
        echo"<script>window.location.href='produto-lista.php';</script>";
    }
    else{
        echo"<script>window.alert('PRODUTO JÁ EXISTENTE!');<script/>";

    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>CADASTRA PRODUTOS</title>
</head>
<body>
<a href="backoffice.php"><img src="icons/Navigation-left-01-256.png" width="16" height="16"></a>
    <div class = "container-global">
        <form class="formulario" action="produto-cadastro.php" method="post" enctype="multipart/form-data">
        <label>Nome Produto</label>
            <input type="text" name="txtnome" placeholder="Digite o Nome do Produto" required>
            <br>
            <label>Quantidade</label>
            <input type="decimal" name="txtqtd" placeholder="Digite a Quantidade" required>
            <br>
            <label>Unidade</label>
            <select name='txtunidade'>
                <option value="kg">KG</option>
                <option value="gr">G</option>
                <option value="un">UN</option>
                <option value="lt">LT</option>
            </select>
            <br>
            <label>Preço</label>
            <input type="decimal" name="txtpreco" placeholder="Digite Preço" required>
            <br>
            <lavel> IMAGEM</label>
            <input type="file" name="imagem" id='imagem'>
            <br>
            

            <input type="submit" value="Cadastrar Produto">
            <br>

    </div>

    
</body>
</html>