<?php

/**
 * Conta
 * 
 * This class has been auto-generated by the Code Igniter Generator Framework
 * 
 */
class Cidades_model extends CI_Model
{
	public $table = "cidades";

	public function __construct()
	{
		parent::__construct();
	}

	public function getCidade($cidadeId){
		return $this->db->select("*")
				->from("cidades")
				->where("id", $cidadeId)
				->get()->row();
	}
	
}