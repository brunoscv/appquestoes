<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Cidades'] = array(
							array(
								'field' => "id",
								'label' => "id",
								'rules' => ""
									),
							array(
								'field' => "nome",
								'label' => "Nome",
								'rules' => "required"
									),
							array(
								'field' => "capital",
								'label' => "Capital?",
								'rules' => ""
									),
							array(
								'field' => "estados_id",
								'label' => "Estado",
								'rules' => "required"
									),
);

/* End of file cidades.php */
/* Location: ./system/application/config/form_validation/cidades.php */