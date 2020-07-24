<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Alternativas'] = array(
							array(
								'field' => "id",
								'label' => "id",
								'rules' => ""
									),
							array(
								'field' => "descricao",
								'label' => "descricao",
								'rules' => "required"
									),
							array(
								'field' => "ordem",
								'label' => "ordem",
								'rules' => ""
									),
							array(
								'field' => "valor",
								'label' => "valor",
								'rules' => "required"
									),
							array(
								'field' => "questoes_id",
								'label' => "questoes_id",
								'rules' => ""
									),
);

/* End of file alternativas.php */
/* Location: ./system/application/config/form_validation/alternativas.php */