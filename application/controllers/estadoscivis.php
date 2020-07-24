<?php
class EstadosCivis extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("EstadosCivis_model");
		
		//adicione os campos da busca
		$camposFiltros["e.id"] = "Código";
		$camposFiltros["e.nome"] = "Nome";

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
		$countEstadosCivis = $this->db
							->select("count(e.id) AS quantidade")
							->from("estados_civis AS e")
							->get()->row();
		$quantidadeEstadosCivis = $countEstadosCivis->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultEstadosCivis = $this->db
									->select("*")
									->from("estados_civis AS e")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaEstadosCivis'] = $resultEstadosCivis->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("estados_civis/index")."?";
		$config['total_rows'] = $quantidadeEstadosCivis;
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
			
			if( $this->form_validation->run('EstadosCivis') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$estadoCivi	= array();
				
				$estadoCivi['id'] 		= $this->input->post('id', TRUE);
				$estadoCivi['nome'] 		= $this->input->post('nome', TRUE);
				$this->db->insert("estados_civis", $estadoCivi);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('estadoscivis/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$estadoCivi = $this->db
						->from("estados_civis AS m")
						->where("id", $id)->get()->row();

		if(!$estadoCivi){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('estadoscivis/index');
		} else {
			$this->data['item'] = $estadoCivi;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('EstadosCivis') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$estadoCivi	= array();
					$estadoCivi['id']	= $this->input->post('id', true);
					$estadoCivi['nome']	= $this->input->post('nome', true);

					$this->db->where("id",$id);
					$this->db->update("estados_civis",$estadoCivi);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$estadoCivi->id}</b> atualizado!");
					redirect('estadoscivis/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$estadoCivi = $this->db
						->from("estados_civis AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $estadoCivi;
		
		if( !$estadoCivi ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('estadoscivis/index');
		} else {
			$this->data['item'] = $estadoCivi;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $estadoCivi->id);
				$this->db->delete("estados_civis");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('estadoscivisindex');
			}
		}
	}
}

/* End of file Estados_civises.php */
/* Location: ./system/application/controllers/Estados_civises.php */