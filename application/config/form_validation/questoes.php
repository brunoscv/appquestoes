<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Questoes'] = array(
							array(
								'field' => "id",
								'label' => "Id",
								'rules' => ""
									),
							array(
								'field' => "tipo",
								'label' => "",
								'rules' => ""
									),
							array(
								'field' => "texto",
								'label' => "Texto Aux.",
								'rules' => "required"
									),
							array(
								'field' => "ano",
								'label' => "",
								'rules' => "required"
									),
							array(
								'field' => "imagem",
								'label' => "Imagem Aux.",
								'rules' => ""
									),
							array(
								'field' => "enunciado",
								'label' => "Enunciado",
								'rules' => "required"
									),
							array(
								'field' => "dificuldade",
								'label' => "Dificuldade",
								'rules' => "required"
									),
							array(
								'field' => "bancas_id",
								'label' => "Bancas_id",
								'rules' => ""
									),
							array(
								'field' => "instituicoes_id",
								'label' => "Instituicoes_id",
								'rules' => ""
									),
							array(
								'field' => "cargos_id",
								'label' => "Cargos_id",
								'rules' => ""
									),
);

/* End of file questoes.php */
/* Location: ./system/application/config/form_validation/questoes.php */