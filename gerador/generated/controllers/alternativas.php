<?php
class Alternativas extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Alternativas_model");
		
		//adicione os campos da busca
		$camposFiltros["a.id"] = "id";
		$camposFiltros["a.descricao"] = "descricao";
		$camposFiltros["a.ordem"] = "ordem";
		$camposFiltros["a.valor"] = "valor";
		$camposFiltros["a.questoes_id"] = "questoes_id";

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
		$countAlternativas = $this->db
							->select("count(a.id) AS quantidade")
							->from("alternativas AS a")
							->get()->row();
		$quantidadeAlternativas = $countAlternativas->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultAlternativas = $this->db
									->select("*")
									->from("alternativas AS a")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaAlternativas'] = $resultAlternativas->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("alternativas/index")."?";
		$config['total_rows'] = $quantidadeAlternativas;
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
			
			if( $this->form_validation->run('Alternativas') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$alternativa	= array();
				$alternativa['id'] 		= $this->input->post('id', TRUE);
				$alternativa['descricao'] 		= $this->input->post('descricao', TRUE);
				$alternativa['ordem'] 		= $this->input->post('ordem', TRUE);
				$alternativa['valor'] 		= $this->input->post('valor', TRUE);
				$alternativa['questoes_id'] 		= $this->input->post('questoes_id', TRUE);
				$this->db->insert("alternativas", $alternativa);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('alternativas/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$alternativa = $this->db
						->from("alternativas AS m")
						->where("id", $id)->get()->row();

		if(!$alternativa){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('alternativas/index');
		} else {
			$this->data['item'] = $alternativa;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Alternativas') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$alternativa	= array();
					$alternativa['id']	= $this->input->post('id', true);
					$alternativa['descricao']	= $this->input->post('descricao', true);
					$alternativa['ordem']	= $this->input->post('ordem', true);
					$alternativa['valor']	= $this->input->post('valor', true);
					$alternativa['questoes_id']	= $this->input->post('questoes_id', true);

					$this->db->where("id",$id);
					$this->db->update("alternativas",$alternativa);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$alternativa->id}</b> atualizado!");
					redirect('alternativas/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$alternativa = $this->db
						->from("alternativas AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $alternativa;
		
		if( !$alternativa ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('alternativas/index');
		} else {
			$this->data['item'] = $alternativa;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $alternativa->id);
				$this->db->delete("alternativas");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('alternativasindex');
			}
		}
	}
}

/* End of file Alternativases.php */
/* Location: ./system/application/controllers/Alternativases.php */