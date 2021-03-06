﻿<?php


if(isset($_GET['id_ped'])){
$evento = recuperaDados("ig_evento",$_GET['id_ped'],"idEvento");
}


if(isset($_GET['action'])){
	$action = $_GET['action'];
}else{
	$action = "evento";
}
?>
 	<section id="list_items" class="home-section bg-white">
		<div class="container">
      			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2><?php echo $evento['nomeEvento'] ?></h2>
					<h4></h4>
                    <h5><?php if(isset($mensagem)){echo $mensagem;} ?></h5>
                 </div>
				  </div>
			  </div>  
<?php
$idEvento = $evento['idEvento'];
$chamado = recuperaAlteracoesEvento($idEvento);	
switch($action){
case "evento":

 ?>
			  <h5>Dados do evento | <a href="?perfil=contratos&p=evento&action=servicos&id_ped=<?php echo $_GET['id_ped']; ?>">Solicitação de serviços</a> | <a href="?perfil=contratos&p=evento&action=pedidos&id_ped=<?php echo $_GET['id_ped']; ?>">Pedidos de contratação</a>  | <?php 
					if($chamado['numero'] == '0'){
						echo "Chamados [0]";
					}else{
						echo "<a href='?perfil=chamado&p=evento&id=".$idEvento."' target='_blank'>Chamados [".$chamado['numero']."]</a>";	
					}
					
					?></h5>
			<div class="table-responsive list_info" >
            <h4></h4>
            <p align="left">
              <?php descricaoEvento($_GET['id_ped']); ?>
                  </p>      
            <h5>Ocorrências</h5>
            <?php echo resumoOcorrencias($_GET['id_ped']); ?><br /><br />
            <?php listaOcorrenciasTexto($_GET['id_ped']); ?>

			<h5>Especificidades</h5>

            <p align="left"><?php descricaoEspecificidades($_GET['id_ped'],$evento['ig_tipo_evento_idTipoEvento']); ?></p>

			<?php
		if($evento['subEvento'] == '1'){
		 ?>
		<h5>Sub-eventos</h5>
			<div class="left">
		<?php listaSubEventosCom($idEvento) ?>
			</div>
		<?php } ?>

<h5>Arquivos anexos</h5>
<p align="left">	<?php listaArquivosDetalhe($_GET['id_ped']) ?>	</p>			
			
			
			<?php
break;
case "pedidos":
$pedido = listaPedidoContratacao($_GET['id_ped']);
?>
			  <h5> <a href="?perfil=contratos&p=evento&action=evento&id_ped=<?php echo $_GET['id_ped']; ?>">Dados do evento </a>|<a href="?perfil=contratos&p=evento&action=servicos&id_ped=<?php echo $_GET['id_ped']; ?>">Solicitação de serviços</a> | Pedidos de contratação | <?php 
					if($chamado['numero'] == '0'){
						echo "Chamados [0]";
					}else{
						echo "<a href='?perfil=chamado&p=evento&id=".$idEvento."' target='_blank'>Chamados [".$chamado['numero']."]</a>";	
					}
					?>
					</h5>
			  <div class="table-responsive list_info" >
            <h4><?php echo $evento['nomeEvento'] ?></h4>

			  <?php for($i = 0; $i < count($pedido); $i++){
				  
			$dados = siscontrat($pedido[$i]);
			$pessoa = siscontratDocs($dados['IdProponente'],$dados['TipoPessoa']);
			?>
            <p align="left">
            Número do Pedido de Contratação:<b> <?php echo $pedido[$i]; ?></b><br />
			Nome ou Razão Social: <b><?php echo $pessoa['Nome'] ?></b><br />
			Tipo de pessoa: <b><?php echo retornaTipoPessoa($dados['TipoPessoa']);?></b><br />
			Dotação: <b><?php echo retornaVerba($dados['Verba']);?></b><br />
			Valor:<b>R$ <?php echo dinheiroParaBr($dados['ValorGlobal']);?></b><br />		
			 </p>      
<?php } // fechamento do for ?>

 
			<?php
break;
case "servicos":

?>    
			  <h5> <a href="?perfil=contratos&p=evento&action=evento&id_ped=<?php echo $_GET['id_ped']; ?>">Dados do evento </a>| Solicitação de serviços | <a href="?perfil=contratos&p=evento&action=pedidos&id_ped=<?php echo $_GET['id_ped']; ?>">Pedidos de contratação</a>| <?php 
					if($chamado['numero'] == '0'){
						echo "Chamados [0]";
					}else{
						echo "<a href='?perfil=chamado&p=evento&id=".$idEvento."' target='_blank'>Chamados [".$chamado['numero']."]</a>";	
					} ?>
					</h5>
			<div class="table-responsive list_info" >
            <h4><?php echo $evento['nomeEvento'] ?></h4>
            <div class="left">
            
            <h5>Previsão de serviços externos</h5>
            <?php listaServicosExternos($_GET['id_ped']); ?><br /><br />

			<h5>Serviços Internos</h5>
			<?php listaServicosInternos($_GET['id_ped']) ?>

            </div>
			<?php
break;
case "pendencias":
require_once("../funcoes/funcoesVerifica.php");
require_once("../funcoes/funcoesSiscontrat.php");
	$evento = recuperaDados("ig_evento",$_GET['id_ped'],"idEvento");
	$campos = verificaCampos($_GET['id_ped']);
	$ocorrencia = verificaOcorrencias($_GET['id_ped']);

?>   
			  <h5> <a href="?perfil=contratos&p=evento&action=pedidos">Dados do evento </a>| Solicitação de serviços | <a href="?perfil=contratos&p=evento&action=pedidos">Pedidos de contratação</a></h5>
			<div class="table-responsive list_info" >
            <h4><?php echo $evento['nomeEvento'] ?></h4>
            <div class="left">
            
<?php //print_r($evento);
if($campos['total'] > 0){
	echo "Há campos obrigatórios não preenchidos.";	
}else{
	echo "Todos os campos obrigatórios foram preenchidos";
}

?></p>
<p>
<?php //print_r($evento);
if($ocorrencia > 0){
	echo "Há ocorrências cadastradas.";	
}else{
	echo "Não há ocorrências cadastradas.";
}

?></p>
<p><?php prazoContratos($_GET['id_ped']); ?></p>

            </div>
<?php
break;
 } // fecha a switch action ?>	



