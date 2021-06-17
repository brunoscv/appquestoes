<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['SimOuNao']			= array(FALSE=>"Não",TRUE=>"Sim");
$config['Sexos']			= array("M"=>"Masculino","F"=>"Feminino");
$config['tipoTransporte']	= array("NAO POSSUI"=>"Não possui","BICICLETA"=>"Bicicleta", "CARRO" => "Carro", "MOTO" => "Moto");
$config['IdiomasNiveis']	= array("Basico" => "Básico", "Intermediario" => "Intermediário", "Avancado" => "Avançado");
$config['Turnos']			= array("M" => "Manhã", "T" => "Tarde", "N" => "Noite", "I" => "Integral");
$config['SituacoesProcessos']	= array("ABERTO" => "Aberto", "ANDAMENTO" => "Em Andamento", "CONCLUIDO" => "Concluído");

$config['mesesAno'] = array('',"Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

$config['tipoQuestoes'] = array("1"=>"Multipla Escolha", "2"=>"V/F");
$config['dificuldadeQuestoes'] = array("1"=>"Baixa", "2"=>"Média", "3"=>"Alta");


$config['smtp_host'] = "";
$config['smtp_port'] = "587";
$config['smtp_user'] = "";
$config['smtp_pass'] = "";

$config['sms_url'] 	 	= FALSE;
$config['sms_user']		= "25"; //codigo
$config['sms_pass'] 	= ""; //token

/* End of file config.php */
/* Location: ./application/config/my_config.php */
