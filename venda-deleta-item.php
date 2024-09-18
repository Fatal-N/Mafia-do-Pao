<?php
include("conectadb.php");
$iddiv=$_GET['id'];
$sqldeleta="DELETE FROM tb_item_venda WHERE id_iv= $idiv";
$resultdo=mysqli_query($link,$sqldeleta);

header("Location: vendas.php");