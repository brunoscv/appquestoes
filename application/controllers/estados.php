<?php
class Estados extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Estados_model");
		
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
		$countEstados = $this->db
							->select("count(e.id) AS quantidade")
							->from("estados AS e")
							->get()->row();
		$quantidadeEstados = $countEstados->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultEstados = $this->db
									->select("*")
									->from("estados AS e")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaEstados'] = $resultEstados->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("estados/index")."?";
		$config['total_rows'] = $quantidadeEstados;
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
			
			if( $this->form_validation->run('Estados') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$estado	= array();
				
				$estado['id'] 		= $this->input->post('id', TRUE);
				$estado['nome'] 		= $this->input->post('nome', TRUE);
				$this->db->insert("estados", $estado);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('estados/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$estado = $this->db
						->from("estados AS m")
						->where("id", $id)->get()->row();

		if(!$estado){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('estados/index');
		} else {
			$this->data['item'] = $estado;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Estados') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$estado	= array();
					$estado['id']	= $this->input->post('id', true);
					$estado['nome']	= $this->input->post('nome', true);

					$this->db->where("id",$id);
					$this->db->update("estados",$estado);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$estado->id}</b> atualizado!");
					redirect('estados/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$estado = $this->db
						->from("estados AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $estado;
		
		if( !$estado ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('estados/index');
		} else {
			$this->data['item'] = $estado;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $estado->id);
				$this->db->delete("estados");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('estadosindex');
			}
		}
	}
}

/* End of file Estadoses.php */
/* Location: ./system/application/controllers/Estadoses.php */