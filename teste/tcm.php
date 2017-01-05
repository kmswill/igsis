﻿<?php
@ini_set('display_errors', '1');
error_reporting(E_ALL); 
ini_set('max_execution_time', 300);

require "../funcoes/funcoesConecta.php";
require "../funcoes/funcoesGerais.php";
require "../funcoes/funcoesSiscontrat.php";


if(isset($_GET['inicio'])){
	$inicio = $_GET['inicio'];	
}

if(isset($_GET['fim'])){
	$fim = $_GET['fim'];	
}

function reloadAgendaTCM(){
	$mensagem = "";
	$con = bancoMysqli();
	//$novaTabela = "igsis_agenda_".date('YmdHis');
	//$sql_backup = "CREATE TABLE $novaTabela SELECT * FROM igsis_agenda";
	//$query_backup = mysqli_query($con,$sql_backup);
		$sql_limpa = "TRUNCATE TABLE igsis_agenda_tcm";
		if(mysqli_query($con,$sql_limpa)){
			$sql_auto = "ALTER TABLE igsis_agenda_tcm AUTO_INCREMENT = 1";
			$sql_query = mysqli_query($con,$sql_auto);
			mysqli_query($con,$sql_auto);		
	
	$sql_pesquisar = "SELECT ig_ocorrencia.idEvento, dataInicio, idTipoOcorrencia, local, horaInicio, idInstituicao, dataFinal, segunda, terca, quarta, quinta, sexta, sabado, domingo, idOcorrencia, idCinema, nomeEvento, ig_tipo_evento_idTipoEvento FROM ig_ocorrencia, ig_evento WHERE ig_evento.dataEnvio IS NOT NULL AND ig_evento.publicado = '1' AND ig_evento.idInstituicao IS NOT NULL AND ig_evento.publicado = '1' AND ig_evento.idEvento = ig_ocorrencia.idEvento AND ig_ocorrencia.publicado = '1' ORDER BY dataInicio, horaInicio";
	$query_pesquisar = mysqli_query($con,$sql_pesquisar);
	$data = "";
	$data_antigo = "1";
	while($evento = mysqli_fetch_array($query_pesquisar)){
		$idEvento = $evento['idEvento'];
		$sql_pedido = "SELECT * FROM igsis_pedido_contratacao WHERE estado IS NOT NULL AND idEvento = '$idEvento'";
		$query_pedido = mysqli_query($con,$sql_pedido);
		$event = recuperaDados("ig_evento",$idEvento,"idEvento");
		$dataInicio = $evento['dataInicio'];
		$dataFinal = $evento['dataFinal'];
		$local = $evento['local'];
		$idTipo = $evento['idTipoOcorrencia'];
		$hora = $evento['horaInicio'];
		$idInstituicao = $evento['idInstituicao'];
		$segunda = $evento['segunda'];
		$terca = $evento['terca'];
		$quarta = $evento['quarta'];
		$quinta = $evento['quinta'];
		$sexta = $evento['sexta'];
		$sabado = $evento['sabado'];
		$domingo = $evento['domingo'];
		$idOcorrencia = $evento['idOcorrencia'];
		$idCinema = $evento['idCinema'];
		$tipoEvento = $event['ig_tipo_evento_idTipoEvento'];
		$nomeEvento = $event['nomeEvento'];
	
	
		
		if($dataFinal == '0000-00-00' OR $dataFinal == $dataInicio){ //Evento de data única
	
		$sql = "INSERT INTO `igsis_agenda_tcm` (`idAgenda`, `idEvento`, `data`, `hora`, `idLocal`, `idInstituicao`, `idTipo`, `idOcorrencia`, `idCinema`,  `tipoEvento`, `nomeEvento`) 
		VALUES (NULL, '$idEvento', '$dataInicio', '$hora', '$local', '$idInstituicao', '$idTipo', '$idOcorrencia', '$idCinema','$tipoEvento','$nomeEvento');";
			$query = mysqli_query($con,$sql);
			if($query){
				//echo "Data importada na agenda.<br />";	
			}else{
				$mensagem = $mensagem."Erro.<br />";	
			}		
		}else{ // Evento de tempoarada
			while(strtotime($dataInicio) <=  strtotime($dataFinal)){
				$semana = diaSemanaBase($dataInicio);
				
				switch($semana){
				case 'segunda':
				if($segunda == '1'){
		$sql = "INSERT INTO `igsis_agenda_tcm` (`idAgenda`, `idEvento`, `data`, `hora`, `idLocal`, `idInstituicao`, `idTipo`, `idOcorrencia`, `idCinema`,  `tipoEvento`, `nomeEvento`) 
		VALUES (NULL, '$idEvento', '$dataInicio', '$hora', '$local', '$idInstituicao', '$idTipo', '$idOcorrencia', '$idCinema','$tipoEvento','$nomeEvento');";
	
					$query = mysqli_query($con,$sql);
					if($query){
						//echo "Data importada na agenda.<br />";	
					}else{
						$mensagem = $mensagem."Erro.<br />";	
					}		
					
				}
				break;
				case 'terca':
				
				if($terca == '1'){
		$sql = "INSERT INTO `igsis_agenda_tcm` (`idAgenda`, `idEvento`, `data`, `hora`, `idLocal`, `idInstituicao`, `idTipo`, `idOcorrencia`, `idCinema`,  `tipoEvento`, `nomeEvento`) 
		VALUES (NULL, '$idEvento', '$dataInicio', '$hora', '$local', '$idInstituicao', '$idTipo', '$idOcorrencia', '$idCinema','$tipoEvento','$nomeEvento');";
	
					$query = mysqli_query($con,$sql);
					if($query){
						//echo "Data importada na agenda.<br />";	
					}else{
						$mensagem = $mensagem."Erro.<br />";	
					}		
					
				}
				break;
				case 'quarta':
				if($quarta == '1'){
		$sql = "INSERT INTO `igsis_agenda_tcm` (`idAgenda`, `idEvento`, `data`, `hora`, `idLocal`, `idInstituicao`, `idTipo`, `idOcorrencia`, `idCinema`,  `tipoEvento`, `nomeEvento`) 
		VALUES (NULL, '$idEvento', '$dataInicio', '$hora', '$local', '$idInstituicao', '$idTipo', '$idOcorrencia', '$idCinema','$tipoEvento','$nomeEvento');";
	
					$query = mysqli_query($con,$sql);
					if($query){
						//echo "Data importada na agenda.<br />";	
					}else{
						$mensagem = $mensagem."Erro.<br />";	
					}		
					
				}
				break;
				case 'quinta':
				if($quinta == '1'){
		$sql = "INSERT INTO `igsis_agenda_tcm` (`idAgenda`, `idEvento`, `data`, `hora`, `idLocal`, `idInstituicao`, `idTipo`, `idOcorrencia`, `idCinema`,  `tipoEvento`, `nomeEvento`) 
		VALUES (NULL, '$idEvento', '$dataInicio', '$hora', '$local', '$idInstituicao', '$idTipo', '$idOcorrencia', '$idCinema','$tipoEvento','$nomeEvento');";
	
					$query = mysqli_query($con,$sql);
					if($query){
						//echo "Data importada na agenda.<br />";	
					}else{
						$mensagem = $mensagem."Erro.<br />";	
	
	
					}		
					
				}
				break;
				case 'sexta':
				if($sexta == '1'){
		$sql = "INSERT INTO `igsis_agenda_tcm` (`idAgenda`, `idEvento`, `data`, `hora`, `idLocal`, `idInstituicao`, `idTipo`, `idOcorrencia`, `idCinema`,  `tipoEvento`, `nomeEvento`) 
		VALUES (NULL, '$idEvento', '$dataInicio', '$hora', '$local', '$idInstituicao', '$idTipo', '$idOcorrencia', '$idCinema','$tipoEvento','$nomeEvento');";
	
					$query = mysqli_query($con,$sql);
					if($query){
						//echo "Data importada na agenda.<br />";	
					}else{
						$mensagem = $mensagem."Erro.<br />";	
					}		
					
				}
				break;
				case 'sabado':
				if($sabado == '1'){
	
		$sql = "INSERT INTO `igsis_agenda_tcm` (`idAgenda`, `idEvento`, `data`, `hora`, `idLocal`, `idInstituicao`, `idTipo`, `idOcorrencia`, `idCinema`,  `tipoEvento`, `nomeEvento`) 
		VALUES (NULL, '$idEvento', '$dataInicio', '$hora', '$local', '$idInstituicao', '$idTipo', '$idOcorrencia', '$idCinema','$tipoEvento','$nomeEvento');";
					$query = mysqli_query($con,$sql);
					if($query){
						//echo "Data importada na agenda.<br />";	
					}else{
						$mensagem = $mensagem."Erro.<br />";	
					}		
					
				}
				break;
				case 'domingo':
				
				if($domingo == '1'){
	
		$sql = "INSERT INTO `igsis_agenda_tcm` (`idAgenda`, `idEvento`, `data`, `hora`, `idLocal`, `idInstituicao`, `idTipo`, `idOcorrencia`, `idCinema`,  `tipoEvento`, `nomeEvento`) 
		VALUES (NULL, '$idEvento', '$dataInicio', '$hora', '$local', '$idInstituicao', '$idTipo', '$idOcorrencia', '$idCinema','$tipoEvento','$nomeEvento');";
					$query = mysqli_query($con,$sql);
					if($query){
						//echo "Data importada na agenda.<br />";	
					}else{
						$mensagem = $mensagem."Erro.<br />";	
					}		
					
				}
				break;
			}// fim da switch
	
			}
	
				$dataInicio = date('Y-m-d', strtotime("+1 days",strtotime($dataInicio)));
			}
			
	
		
		
		
	}	
	
		}
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
</head>

<?php 
$con = bancoMysqli();
//reloadAgendaTCM();
$i = 0;





	$sql = "SELECT DISTINCT idEvento FROM igsis_agenda WHERE data >= '$inicio' AND data <= '$fim' ORDER BY data, hora";
	$query = mysqli_query($con,$sql);
		
?>
<table border="1">
<tr>
<th>
<th>Dia</th>
<th>Hora</th>
<th>Atração</th>
<th>Local</th>
<th>SEI</th>
<th>valor</th>
</tr>
<?php
	while($dados = mysqli_fetch_array($query)){
		$evento = recuperaDados("ig_evento",$dados['idEvento'],"idEvento");
		$idEvento = $dados['idEvento'];
		$sql_pedido = "SELECT * FROM igsis_pedido_contratacao WHERE idEvento = '$idEvento' AND estado IS NOT NULL";
		$query_pedido = mysqli_query($con,$sql_pedido);
		while($pedido = mysqli_fetch_array($query_pedido)){	
				if($pedido['valor'] > 0){
					$sql_agenda = "SELECT * FROM igsis_agenda WHERE idEvento = '$idEvento'";
					$query_agenda = mysqli_query($con,$sql_agenda);
					while($agenda = mysqli_fetch_array($query_agenda)){
						$local = recuperaDados("ig_local",$agenda['idLocal'],"idLocal");
						$instituicao = recuperaDados("ig_instituicao",$agenda['idInstituicao'],"idInstituicao");
	?>

<tr>
<td><?php echo $i++ ?></td>
<td><?php echo exibirDataBr($agenda['data']); ?></td>
<td><?php echo $agenda['hora']; ?></td>
<td><?php echo retornaTipo($evento['ig_tipo_evento_idTipoEvento'])." - ".$evento['nomeEvento']; ?></td>
<td><?php echo $local['sala']." - ".$instituicao['sigla']; ?></td>
<td><?php echo $pedido['NumeroProcesso']?></td>
<td><?php echo $pedido['valor']?></td></tr>
<?php 
				}
			}
		} 

	}
	?>
</table>
<?php

/*
$status = atualizaEstado($idPedido);

$pedido = recuperaDados("igsis_pedido_contratacao",$idPedido,"idPedidoContratacao");
$estado = recuperaDados("sis_estado",$pedido['estado'],"idEstado");

echo "O pedido $idPedido tem o status ".$estado['estado']."<br /><br />";


var_dump($status);
*/
?>


<body>
</body>
</html>