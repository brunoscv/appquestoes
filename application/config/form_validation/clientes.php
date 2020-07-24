<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Clientes'] = array(
							array(
								'field' => "id",
								'label' => "",
								'rules' => ""
									),
							array(
								'field' => "nome_empresa",
								'label' => "Nome da empresa",
								'rules' => "required"
									),
							array(
								'field' => "nome_responsavel",
								'label' => "",
								'rules' => "required"
									),
							array(
								'field' => "url",
								'label' => "Url",
								'rules' => ""
									),
							array(
								'field' => "cidades_id",
								'label' => "Cidade",
								'rules' => ""
									),
							array(
								'field' => "telefone",
								'label' => "Telefone",
								'rules' => "required"
									),
							array(
								'field' => "email",
								'label' => "E-mail",
								'rules' => "required"
									),
);

/* End of file clientes.php */
/* Location: ./system/application/config/form_validation/clientes.php */