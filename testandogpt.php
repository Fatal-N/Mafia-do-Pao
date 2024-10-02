<?php
include("conectadb.php");
include("topo.php");
// Verificação do Post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = $_POST['produto'];

    // QUEBRAR A VARIÁVEL PRODUTO EM 3 OUTRAS VARIÁVEIS
    list($idproduto, $nomeproduto, $valorproduto) = explode(',', $produto);
    $qtditem = $_POST['qtditem'];

    // Verificar se a quantidade está vazia ou em branco
    if (empty($qtditem) || !is_numeric($qtditem) || $qtditem <= 0) {
        echo "<script>alert('Por favor, insira a quantidade corretamente.');</script>";
    } else {
        // CALCULAR O VALOR DOS ITENS
        $valorlista = $valorproduto * $qtditem;

        // VERIFICAR SE O CARRINHO ESTÁ ABERTO OU NÃO
        $sql = "SELECT COUNT(iv_status) FROM tb_item_venda WHERE iv_status = 1";
        $retorno = mysqli_query($link, $sql);

        while ($tbl = mysqli_fetch_array($retorno)) {
            $cont = $tbl[0];

            // SE NÃO EXISTIR CARRINHO ABERTO, CRIA UM NOVO
            if ($cont == 0) {
                // CRIA O CODIGO ITEM_VENDA
                $codigo_itemvenda = md5(rand(1, 999999) . date('h:i:s'));

                // INSERINDO O ITEM NA VENDA
                $sqlitem = "INSERT INTO tb_item_venda(iv_valortotal, iv_quantidade, iv_cod_iv, fk_pro_id, iv_status)
                            VALUES ($valorlista, $qtditem, '$codigo_itemvenda', $idproduto, '1')";
                mysqli_query($link, $sqlitem);
            } else { // Se o carrinho já existe, retorna o numero iv_cod_iv ativo e insere mais itens na venda
                $sql = "SELECT iv_cod_iv FROM tb_item_venda WHERE iv_status = 1";
                $carrinhoaberto = mysqli_query($link, $sql);
                $tbl = mysqli_fetch_array($carrinhoaberto);
                $codigo_itemvenda_ok = $tbl[0];

                // INSERINDO O ITEM NA VENDA
                $sqlitem = "INSERT INTO tb_item_venda(iv_valortotal, iv_quantidade, iv_cod_iv, fk_pro_id, iv_status)
                            VALUES ($valorlista, $qtditem, '$codigo_itemvenda_ok', $idproduto, '1')";
                mysqli_query($link, $sqlitem);
            }
        }
    }
}