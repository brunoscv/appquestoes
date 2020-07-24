<?php
class Cargos extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Cargos_model");
		
		//adicione os campos da busca
		$camposFiltros["c.id"] = "Id";
		$camposFiltros["c.descricao"] = "Descrição";

		$this->data['campos']    = $camposFiltros;
	}
	
	function index(){
		$perPage = '10';
		$offset = ($this->input->get("per_page")) ? $this->input->get("per_page") : "0";

		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		$countCargos = $this->db
							->select("count(c.id) AS quantidade")
							->from("cargos AS c")
							->get()->row();
		$quantidadeCargos = $countCargos->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultCargos = $this->db
									->select("*")
									->from("cargos AS c")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaCargos'] = $resultCargos->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("cargos/index")."?";
		$config['total_rows'] = $quantidadeCargos;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    function criar(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		//fim Campos relacionados
		
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('Cargos') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$cargo	= array();
				$cargo['id'] 		= $this->input->post('id', TRUE);
				$cargo['descricao'] 		= $this->input->post('descricao', TRUE);
				$this->db->insert("cargos", $cargo);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('cargos/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$cargo = $this->db
						->from("cargos AS m")
						->where("id", $id)->get()->row();

		if(!$cargo){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('cargos/index');
		} else {
			$this->data['item'] = $cargo;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Cargos') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$cargo	= array();
					$cargo['id']	= $this->input->post('id', true);
					$cargo['descricao']	= $this->input->post('descricao', true);

					$this->db->where("id",$id);
					$this->db->update("cargos",$cargo);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$cargo->id}</b> atualizado!");
					redirect('cargos/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$cargo = $this->db
						->from("cargos AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $cargo;
		
		if( !$cargo ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('cargos/index');
		} else {
			$this->data['item'] = $cargo;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $cargo->id);
				$this->db->delete("cargos");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('cargosindex');
			}
		}
	}
}

/* End of file Cargoses.php */
/* Location: ./system/application/controllers/Cargoses.php */