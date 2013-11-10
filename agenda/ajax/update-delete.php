<?php
session_start();
$dirRoot = '../../';
require_once $dirRoot."_funcoes/funcoes.php";

require_once $dirRoot.'model/agenda.class.php';
require_once $dirRoot.'model/horarios.class.php';
require_once $dirRoot.'model/convenios.class.php';
require_once $dirRoot.'model/clientes.class.php';
include_once $dirRoot.'model/fluxodecaixa.class.php';

$ModelClientes = new ModelClientes();
$ModelAgenda = new ModelAgenda();

if($_GET['atualizar'] == '1')
{
	$Agenda = new Agenda();
	$Agenda->set('cod_agenda', $_GET['agenda']);
	$Agenda->set('atendido', '1');
	
	if($ModelAgenda->marcarComoAtendido($Agenda))
	{
		$Agenda = $ModelAgenda->loadById( $_GET['agenda'] );
		
		if($Agenda->get('valorconsulta') > 0)
		{
			$Cliente = new Cliente();
			$Cliente = $ModelClientes->loadById($Agenda->get('cod_paciente'));
			
			$FluxoDeCaixa = new FluxoDeCaixa();
			$FluxoDeCaixa->set('codpessoa', $Agenda->get('cod_paciente'));
			$FluxoDeCaixa->set('qtdparcelas', '1');
			$FluxoDeCaixa->set('dataentrada', date('Y-m-d'));
			$FluxoDeCaixa->set('valortotal', valorparaobanco($Agenda->get('valorconsulta')));
			$FluxoDeCaixa->set('codagenda', $Agenda->get('cod_agenda'));
			$FluxoDeCaixa->set('descricao', "Consulta c�d.: ".$Agenda->get('cod_agenda')." - ".$Cliente->get('nomecliente'));
			$FluxoDeCaixa->set('formapagamento', 3);
			$FluxoDeCaixa->set('tipopagamento', 1);
			$FluxoDeCaixa->set('categoriamovimentacao', 9);
			$FluxoDeCaixa->set('codconta', 'null');
				
			$FluxoDeCaixaModel = new FluxoDeCaixaModel();
			$FluxoDeCaixaModel->insertFluxo($FluxoDeCaixa);
		}
		echo "Encerrado com sucesso!";
	}else{
		echo "Erro ao atualizar a agenda!";
	}
}
if($_GET['excluir'] == '1')
{
	$Agenda = new Agenda();	
	$Agenda->set('cod_agenda', $_GET['agenda']);

	if($ModelAgenda->delete($Agenda))
	{
		echo "Excluido com sucesso!";
	}else{
		echo "Erro !";
	}
}