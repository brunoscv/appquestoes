<?php
class Cidades extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Cidades_model");
		
		//adicione os campos da busca
		$camposFiltros["c.id"] = "id";
		$camposFiltros["c.nome"] = "Nome";
		$camposFiltros["c.capital"] = "Capital?";
		$camposFiltros["c.estados_id"] = "Estado";

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
		$countCidades = $this->db
							->select("count(c.id) AS quantidade")
							->from("cidades AS c")
							->join("estados as e", "e.id = c.estados_id")
							->get()->row();
		$quantidadeCidades = $countCidades->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultCidades = $this->db
									->select("c.*, e.nome AS estado")
									->from("cidades AS c")
									->join("estados as e", "e.id = c.estados_id")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaCidades'] = $resultCidades->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("cidades/index")."?";
		$config['total_rows'] = $quantidadeCidades;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    function criar(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$this->load->model("Estados_model");
		$listaEstados = $this->Estados_model->listaTodos();
		
		$this->data['listaEstados'][''] = '- Selecione um estado -';
		foreach($listaEstados as $estado){
			$this->data['listaEstados'][$estado->id] = $estado->nome; 
		}
		//fim Campos relacionados
		
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('Cidades') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$cidade	= array();
				$cidade['id'] 		= $this->input->post('id', TRUE);
				$cidade['nome'] 		= $this->input->post('nome', TRUE);
				$cidade['capital'] 		= $this->input->post('capital', TRUE);
				$cidade['estados_id'] 		= $this->input->post('estados_id', TRUE);
				$this->db->insert("cidades", $cidade);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('cidades/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$cidade = $this->db
						->from("cidades AS m")
						->where("id", $id)->get()->row();

		if(!$cidade){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('cidades/index');
		} else {
			//carregando estados para o select
			$this->load->model("Estados_model");
			$listaEstados = $this->Estados_model->listaTodos();
			
			$this->data['listaEstados'][''] = '- Selecione um estado -';
			foreach($listaEstados as $estado){
				$this->data['listaEstados'][$estado->id] = $estado->nome; 
			}
			
			$this->data['item'] = $cidade;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Cidades') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$cidade	= array();
					$cidade['id']	= $this->input->post('id', true);
					$cidade['nome']	= $this->input->post('nome', true);
					$cidade['capital']	= $this->input->post('capital', true);
					$cidade['estados_id']	= $this->input->post('estados_id', true);

					$this->db->where("id",$id);
					$this->db->update("cidades",$cidade);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$cidade->id}</b> atualizado!");
					redirect('cidades/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$cidade = $this->db
						->from("cidades AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $cidade;
		
		if( !$cidade ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('cidades/index');
		} else {
			$this->data['item'] = $cidade;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $cidade->id);
				$this->db->delete("cidades");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('cidadesindex');
			}
		}
	}
}

/* End of file Cidadeses.php */
/* Location: ./system/application/controllers/Cidadeses.php */