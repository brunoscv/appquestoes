<?php

/**
 * Conta
 * 
 * This class has been auto-generated by the Code Igniter Generator Framework
 * 
 */
class Bancas_model extends CI_Model
{
	public $table = "bancas";

	public function __construct()
	{
		parent::__construct();
	}

	public function listaBancas()
	{
		return $this->db->query("  SELECT id, descricao 
								   FROM bancas
								   ORDER BY descricao DESC")
				 		->result();
	}
	
}
