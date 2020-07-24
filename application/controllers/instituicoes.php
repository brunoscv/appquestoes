<?php
class Instituicoes extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Instituicoes_model");
		
		//adicione os campos da busca
		$camposFiltros["i.id"] = "Id";
		$camposFiltros["i.descricao"] = "Descrição";

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
		$countInstituicoes = $this->db
							->select("count(i.id) AS quantidade")
							->from("instituicoes AS i")
							->get()->row();
		$quantidadeInstituicoes = $countInstituicoes->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultInstituicoes = $this->db
									->select("*")
									->from("instituicoes AS i")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaInstituicoes'] = $resultInstituicoes->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("instituicoes/index")."?";
		$config['total_rows'] = $quantidadeInstituicoes;
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
			
			if( $this->form_validation->run('Instituicoes') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$instituicoe	= array();
				$instituicoe['id'] 		= $this->input->post('id', TRUE);
				$instituicoe['descricao'] 		= $this->input->post('descricao', TRUE);
				$this->db->insert("instituicoes", $instituicoe);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('instituicoes/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$instituicoe = $this->db
						->from("instituicoes AS m")
						->where("id", $id)->get()->row();

		if(!$instituicoe){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('instituicoes/index');
		} else {
			$this->data['item'] = $instituicoe;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Instituicoes') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$instituicoe	= array();
					$instituicoe['id']	= $this->input->post('id', true);
					$instituicoe['descricao']	= $this->input->post('descricao', true);

					$this->db->where("id",$id);
					$this->db->update("instituicoes",$instituicoe);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$instituicoe->id}</b> atualizado!");
					redirect('instituicoes/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$instituicoe = $this->db
						->from("instituicoes AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $instituicoe;
		
		if( !$instituicoe ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('instituicoes/index');
		} else {
			$this->data['item'] = $instituicoe;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $instituicoe->id);
				$this->db->delete("instituicoes");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('instituicoesindex');
			}
		}
	}
}

/* End of file Instituicoeses.php */
/* Location: ./system/application/controllers/Instituicoeses.php */