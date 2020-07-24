<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Provas'] = array(
							array(
								'field' => "id",
								'label' => "Id",
								'rules' => ""
									),
							array(
								'field' => "descricao",
								'label' => "",
								'rules' => "required"
									),
							array(
								'field' => "ano",
								'label' => "Ano Prova",
								'rules' => ""
									),
							array(
								'field' => "bancas_id",
								'label' => "Id Banca",
								'rules' => "required"
									),
							array(
								'field' => "instituicoes_id",
								'label' => "Id Instituicao",
								'rules' => "required"
									),
							array(
								'field' => "cargos_id",
								'label' => "Id Cargo",
								'rules' => "required"
									),
);

/* End of file provas.php */
/* Location: ./system/application/config/form_validation/provas.php */