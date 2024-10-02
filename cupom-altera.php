<?php
include("conectadb.php");
include("topo.php");
 
// PREENCHIMENTO DOS TEXTOS
$id = $_GET['id'];
$sql = "SELECT * FROM cupons WHERE id = '$id'";
$retorno = mysqli_query($link, $sql);
 
while ($tbl = mysqli_fetch_array($retorno)){
    $codigo = $tbl[1];
    $desconto = $tbl[2];
    $tipo_desconto = $tbl[3];
    $validade = $tbl[4];
    $usado = $tbl[5];
}
 
// aperta o botão de alterar
if($_SERVER ['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $codigo = $_POST['txtcodigo'];
    $desconto = $_POST['txtdesconto'];
    $tipo_desconto = $_POST['txttipo'];
    $validade = $_POST['txtvalidade'];
    $usado = $_POST['usado'];
   
       
       
 
     $sql = "UPDATE cupons SET codigo = '$codigo', desconto = $desconto,
     tipo_desconto = '$tipo_desconto', validade = '$validade', usado ='$usado' WHERE id = $id";
 
        mysqli_query($link, $sql);
        //echo $sql;
 
        echo"<script>window.alert('CUPOM ALTERADO!');</script>";
        echo"<script>window.location.href='cupom-lista.php';</script>";
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

    <title>ALTERAÇÃO DE CUPOM</title>
</head>
<body>
   
    <div class="container-global">
       
        <form class="formulario" action="cupom-altera.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id?>">
 
            <label>CODIGO</label>
            <input type="text" name="txtcodigo" placeholder="DIGITE CODIGO DO CUPOM" value="<?= $codigo?>"  required>
            <br>
           
            <label>DESCONTO</label>
            <input type="decimal" name="txtdesconto" placeholder="DIGITE O DESCONTO" value="<?= $desconto?>" required>
            <br>
 
            <label>TIPO</label>
            <select name='txttipo'>
                <!-- <option value=""><?= strtoupper($tipo_desconto)?></option>  -->
                <option value="porcentagem">PORCENTAGEM</option>
                <option value="fixo">FIXO</option>
               
            </select>
            <br>
 
            <label>VALIDADE</label>
            <input type="date" name="txtvalidade" placeholder="DIGITE A VALIDADE" value="<?= $validade?>" required>
            <br>
           
            <!-- SELETOR DE ATIVO E INATIVO -->
             <div class="bullets">
                <input type="radio" name="usado"  value="1" <?= $usado == '1'?"checked" : ""?>>ATIVO
                <input type="radio" name="usado" value="0"<?= $usado == '0'?"checked" : ""?>>INATIVO
             </div>
            <br>
            <br>
            <input type="submit" value="CONFIRMAR">
        </form>
 
    </div>
 
    <script src="scripts/script.js"></script>
   
</body>
</html>