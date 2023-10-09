<?php
include_once('../components/header.php');

require '../../lib/conn.php';

$sqlClientes = $conn->query("SELECT * FROM CLIENTE");
$clientes = $sqlClientes->fetchAll(PDO::FETCH_OBJ);

$sqlModelos = $conn->query("SELECT * FROM MODELO");
$modelos = $sqlModelos->fetchAll(PDO::FETCH_OBJ);

$sqlFragrancias = $conn->query("SELECT * FROM FRAGRANCIA");
$fragrancias = $sqlFragrancias->fetchAll(PDO::FETCH_OBJ);
?>

<head>
  <link rel="stylesheet" href="../assets/css/style_cadPedido.css">
  <title>Cadastro Pedido</title>
</head>

<body>
  <div class="container_form d-flex flex-column align-items-center">
    <form action="./functions/func_cadPed.php" method="POST" class="content_form form_pedido">
      <h3>Novo Pedido</h3>
      <div class="content_form-cliente d-flex flex-column">
        <p class="divisoria m-0">Cliente</p>
        <input name="cliente" type="text" placeholder="Nome Completo" class="nome" id="nomeCli" onkeyup="filtroCli(this.value)">
        <div class="listagem_items" id="resultPesquisaCli"></div>
      <div class="d-flex justify-content-between">
          <label for="dataPag">Data de Pagamento</label>
          <input name="data_ped" type="date" class="data" id="dataPag">
        </div>
      </div>

      <div class="content_form-pedido  d-flex flex-column">
        <div class="content_pedido d-flex justify-content-between w-100">
          <p class="divisoria m-0">Pedido</p>

          <button type="button" class="btnAbrirModal produto_btn d-flex justify-content-between">
            Novo Produto
            <span class="produto_btn-add">+</span>
          </button>
        </div>

        <div class="produto_title d-flex justify-content-between">
          <span>Produto</span>
          <span>Quantidade</span>
        </div>

        <div class="container_produtos">
          <div class="produto_content d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center">
              <select name="modelo" id="modelo" class="modelos produto_select w-75">
                <option value="" selected>Selecione o Modelo</option>
                <?php
                foreach ($modelos as $modelo) {
                ?>
                  <option value="<?=$modelo->cod_modelo?>"><?=$modelo->nome_modelo?></option>
                <?php
                }
                ?>
              </select>
              <input type="number" name="quantidade" id="numModel" class="quantidade produto_input" placeholder="000">
            </div>
            <div class="d-flex justify-content-between align-items-center">
            <input name="fragrancia" type="text" placeholder="Nome da Fragrância" class="fragrancias nome" id="nomeFrag" onkeyup="filtroFrag(this.value, 0)">
            <div class="listagem_items resultPesquisaFrag"></div>
              <!-- lixeira -->
            </div>
          </div>
        </div>

        <div class="produto_title d-flex justify-content-between">
          <span class="w-25">Valor</span>
          <span class="w-75">Frete</span>
        </div>
        <div class="d-flex justify-content-between">
          <input name="valor" type="text" id="valor" class="preco produto_input">
          <input name="frete" type="text" id="frete" class="preco produto_input">
          <select name="estado_pedido" id="status" class="w-50">
            <option value="" selected>Status do Pedido</option>
            <option value="1">Pagamento Aprovado</option>
            <option value="2">Arte Finalizada</option>
            <option value="3">Em Produção</option>
            <option value="4">Enviado</option>
          </select>
        </div>
        <div class="btn-cadastro d-flex justify-content-end p-0 w-100">
          <button type="button" class="btn-cadastrar">CADASTRAR</button>
        </div>
      </div>
    </form>
  </div>
  <script src="../assets/js/style.js"></script>
  <script src="../assets/js/cadPedido.js"></script>
  <script src="../assets/js/filtroIn.js"></script>
</body>
</html>