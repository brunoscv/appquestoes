<?php

/**
 * Conta
 * 
 * This class has been auto-generated by the Code Igniter Generator Framework
 * 
 */
class Clientes_model extends CI_Model
{
	public $table = "clientes";

	public function __construct()
	{
		parent::__construct();
	}

	public function listaTodos(){
		return $this->db->select("*")
					->from("clientes")
					->order_by("id ASC")
					->get()
					->result();
	}

	public function getCliente($id){
		$cliente = $this->db->select("*")
							->from("clientes")
							->where("id", $id)
							->get()
							->row();
		if( $cliente ){

			$cliente->configuracoes = json_decode($cliente->configuracoes);

			return $cliente;
		}
		return FALSE;
	}

	public function getClienteByHost($host){
		$cliente = $this->db->select("*")
							->from("clientes")
							->where("url", $host)
							->get()
							->row();
		if( $cliente ){

			$cliente->configuracoes = json_decode($cliente->configuracoes);

			return $cliente;
		}
		return FALSE;
	}
	
}