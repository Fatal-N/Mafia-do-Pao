<?php
include("conectadb.php");
include("topo.php");

//COLETAR DADOS DO POST
$tipo_cupom = ""; //inicia a variável caso não tenha cupom

//verifica a data de validade do cupom
$data_atual = date('Y-m-a');
$data_validade = '200-01-01'; //inicia a variável caso nao tenha cupom
$desconto = ""; //inicia variável caso não tenha cupom


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idcliente = ($_POST['nomecliente']);
    //echo ">>>>".$idcliente;
    $codigo = ($_POST['codigo']);

    #PESQUISA O CUPOM
    $sqlcupom = "SELECT * FROM cupons WHERE codigo='$codigo'";
    $retornocupom = mysqli_query($link, $sqlcupom);
    while ($tblcupom = mysqli_fetch_array($retornocupom)) {
        $desconto = $tblcupom[2];
        $tipo_cupom = $tblcupom[3];
        $data_validade = $tblcupom[4];

    }

    #PESQUISA OS ITENS DA COMPRA
    $sql = "SELECT * FROM tb_item_venda WHERE iv_status = 1";

    #USADO PARA FAZER A REMOÇÃO DE ITENS DO INVENTÁRIO
    $retornoproduto = mysqli_query($link, $sql);

    #USADO PARA FAZER O TOTAL
    $total = 0;//inicializando a variavel
    $valortotal = "SELECT SUM(iv_valortotal) FROM tb_item_venda WHERE iv_status =1";
    $retornovalortotal = mysqli_query($link, $valortotal);
    //echo $valortotal;

    while ($tblvalortotal = mysqli_fetch_array($retornovalortotal)) {
        $total = $tblvalortotal[0];
    }

    #ADD CUPOM 
    if (strtotime($data_validade) >= strtotime($data_atual)) {
        //verifica se o cupom já foi usado pelo cliente
        $sqlclientecupom = "SELECT COUNT(fk_cli_id) FROM tb_venda WHERE cupom='$desconto'";
        $retornoclientecupom = mysqli_query($link, $sqlclientecupom);
        while ($tblclientecupom = mysqli_fetch_array($retornoclientecupom)) {
            $clientecupom = $tblclientecupom[0];
        }
        if ($clientecupom < 1 and $idcliente != 1) { //idcliente 1 = vazio
            echo 'cliente ok';
            //verifica o tipo de desconto
            if ($tipo_cupom == 'fixo') {
                $total -= $desconto;
            } else if ($tipo_cupom == 'porcentagem') {
                $total -= (($desconto * $total) / 100);
            } else {
                $total = $total;
            }
        }
    } else {
        $total = $total;
    }
    //Verifica se o desconto é maior que o total
    if ($total <0){
        $total = 0;
    }
        #usado para finalização da venda
    $retornocarrinho = mysqli_query($link, $sql);
    $usuario = $_SESSION['idusuario'];

    /////////////////////////REALIZAR CORREÇÃO DE VERIFICAÇÃO DE ITEM DO INVENTÁRIO ////////////////////////

    #REMOÇÃO DOS ITENS NO INVENTÁRIO
    while ($tblitem = mysqli_fetch_array($retornoproduto)) {
        $produto_id = $tblitem[4];
        $quantidade_item = $tblitem[2];
        //CONSULTA PARA OBTER A QUANTIDADE ATUAL DO PRODUTO 

        $sqlproduto = "SELECT pro_quantidade FROM tb_produtos WHERE pro_id = $produto_id";
        $retornoproduto_info = mysqli_query($link, $sqlproduto);

        //ATUALIZAÇÃO DA QUANTIDADE DO PRODUTO

        if ($row = mysqli_fetch_array($retornoproduto_info)) {
            $quantidade_produto = $row[0];
            $novaquantidade_produto = $quantidade_produto - $quantidade_item;
            $sql_update_produto = "UPDATE tb_produtos SET pro_quantidade = $novaquantidade_produto WHERE pro_id = $produto_id";
            $retorno_update_produto = mysqli_query($link, $sql_update_produto);
        }
    }
    #RETORNA A DATA E HORA ATUAL PARA FINALIZAR O CARRINHO
    $data = date("Y-m-d H:i:s");
    $tbl = mysqli_fetch_array($retornocarrinho);
    $sqlvenda = "INSERT INTO tb_venda (ven_datavenda, ven_totalvenda, fk_iv_cod_iv, fk_cli_id, fk_usu_id, cupom)
    VALUES ('$data', $total, '$tbl[3]', $idcliente, $usuario, '$codigo')";
    mysqli_query($link, $sqlvenda);

    echo $sqlvenda;

    #TROCAR O STATUS DA VENDA PARA FECHADO
    $sqlfechavenda = "UPDATE tb_item_venda SET iv_status = 0 WHERE iv_status = 1";
    mysqli_query($link, $sqlfechavenda);
    header("Location: backoffice.php");
}