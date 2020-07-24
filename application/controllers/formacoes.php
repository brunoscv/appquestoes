<?php
class Formacoes extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Formacoes_model");
		
		//adicione os campos da busca
		$camposFiltros["f.id"] = "Id";
		$camposFiltros["f.descricao"] = "Descrição";

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
		$countFormacoes = $this->db
							->select("count(f.id) AS quantidade")
							->from("formacoes AS f")
							->get()->row();
		$quantidadeFormacoes = $countFormacoes->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultFormacoes = $this->db
									->select("*")
									->from("formacoes AS f")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaFormacoes'] = $resultFormacoes->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("formacoes/index")."?";
		$config['total_rows'] = $quantidadeFormacoes;
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
			
			if( $this->form_validation->run('Formacoes') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário				
				$formacoe	= array();
				$formacoe['descricao'] 		= $this->input->post('descricao', TRUE);
				$formacoe['createdAt']      = date("YYYY-mm-dd H:i:s");
				$formacoe['updatedAt']      = date("YYYY-mm-dd H:i:s");
				$this->db->insert("formacoes", $formacoe);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('formacoes/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$formacoe = $this->db
						->from("formacoes AS m")
						->where("id", $id)->get()->row();

		if(!$formacoe){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('formacoes/index');
		} else {
			$this->data['item'] = $formacoe;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Formacoes') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$formacoe	= array();
					$formacoe['id']	= $this->input->post('id', true);
					$formacoe['descricao']	= $this->input->post('descricao', true);

					$this->db->where("id",$id);
					$this->db->update("formacoes",$formacoe);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$formacoe->id}</b> atualizado!");
					redirect('formacoes/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$formacoe = $this->db
						->from("formacoes AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $formacoe;
		
		if( !$formacoe ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('formacoes/index');
		} else {
			$this->data['item'] = $formacoe;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $formacoe->id);
				$this->db->delete("formacoes");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('formacoesindex');
			}
		}
	}
}

/* End of file Formacoeses.php */
/* Location: ./system/application/controllers/Formacoeses.php */