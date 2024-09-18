<?php
session_start();
$nomeusuario = $_SESSION['nomeusuario'];
$idusuario = $_SESSION['idusuario'];
?>

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
            <a href="backoffice.php"><img src='icons/arrowhead-left-01.png' width=45px height=45px></a>
        </div>