<?php
class Provas extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Provas_model");
		$this->load->model("Bancas_model");
		$this->load->model("Cargos_model");
		$this->load->model("Instituicoes_model");
		$this->load->model("Formacoes_model");
		
		//adicione os campos da busca
		$camposFiltros["p.id"] = "Id";
		$camposFiltros["p.descricao"] = "Descrição Prova";
		$camposFiltros["p.ano"] = "Ano Prova";
		$camposFiltros["b.descricao"] = "Banca";
		$camposFiltros["i.descricao"] = "Instituicao";
		$camposFiltros["c.descricao"] = "Cargo";
		

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
		$countProvas = $this->db
							->select("count(p.id) AS quantidade")
							->from("provas AS p")
							->join("instituicoes AS i", "i.id = p.instituicoes_id", "left")
							->join("bancas AS b", "b.id = p.bancas_id", "left")
							->join("cargos AS c", "c.id = p.cargos_id", "left")
							->get()->row();
		$quantidadeProvas = $countProvas->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultProvas = $this->db
							->select("p.id, p.descricao, p.ano, i.descricao AS instituicoes")
							->select("c.descricao AS cargos, b.descricao AS bancas")
							->from("provas AS p")
							->join("instituicoes AS i", "i.id = p.instituicoes_id", "left")
							->join("bancas AS b", "b.id = p.bancas_id", "left")
							->join("cargos AS c", "c.id = p.cargos_id", "left")
							->limit($perPage,$offset)
							->get();
		
		$this->data['listaProvas'] = $resultProvas->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("provas/index")."?";
		$config['total_rows'] = $quantidadeProvas;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    function criar(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$bancas = $this->Bancas_model->listaBancas();
		$this->data['listaBancas'] = array();
		$this->data['listaBancas'][''] = "Selecione uma banca";
		foreach ($bancas as $banca) {
			$this->data['listaBancas'][$banca->id] = $banca->descricao;
		}

		$instituicoes = $this->Instituicoes_model->listaInstituicoes();
		$this->data['listaInstituicoes'] = array();
		$this->data['listaInstituicoes'][''] = 'Selecione uma instituição';
		foreach ($instituicoes as $instituicao) {
			$this->data['listaInstituicoes'][$instituicao->id] = $instituicao->descricao;
		}

		$cargos = $this->Cargos_model->listaCargos();
		$this->data['listaCargos'] = array();
		$this->data['listaCargos'][''] = 'Selecione um cargo';
		foreach ($cargos as $cargo) {
			$this->data['listaCargos'][$cargo->id] = $cargo->descricao;
		}
		//fim Campos relacionados
		
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('Provas') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário							
				$prova	= array();
				$prova['id'] 		= $this->input->post('id', TRUE);
				$prova['descricao'] 		= $this->input->post('descricao', TRUE);
				$prova['ano'] 		= $this->input->post('ano', TRUE);
				$prova['bancas_id'] 		= $this->input->post('bancas_id', TRUE);
				$prova['instituicoes_id'] 		= $this->input->post('instituicoes_id', TRUE);
				$prova['cargos_id'] 		= $this->input->post('cargos_id', TRUE);
				$this->db->insert("provas", $prova);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('provas/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		//$id = $this->uri->segment(3);
		$id = $this->input->get("prova_id");

		$prova = $this->db
						->from("provas AS m")
						->where("id", $id)->get()->row();

		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$bancas = $this->Bancas_model->listaBancas();
		$this->data['listaBancas'] = array();
		foreach ($bancas as $banca) {
			$this->data['listaBancas'][$banca->id] = $banca->descricao;
		}

		$instituicoes = $this->Instituicoes_model->listaInstituicoes();
		$this->data['listaInstituicoes'] = array();
		foreach ($instituicoes as $instituicao) {
			$this->data['listaInstituicoes'][$instituicao->id] = $instituicao->descricao;
		}

		$cargos = $this->Cargos_model->listaCargos();
		$this->data['listaCargos'] = array();
		foreach ($cargos as $cargo) {
			$this->data['listaCargos'][$cargo->id] = $cargo->descricao;
		}
		//fim Campos relacionados

		if(!$prova){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('provas/index');
		} else {
			$this->data['item'] = $prova;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Provas') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					$prova	= array();
					$prova['id']	= $this->input->post('id', true);
					$prova['descricao']	= $this->input->post('descricao', true);
					$prova['ano']	= $this->input->post('ano', true);
					$prova['bancas_id']	= $this->input->post('bancas_id', true);
					$prova['instituicoes_id']	= $this->input->post('instituicoes_id', true);
					$prova['cargos_id']	= $this->input->post('cargos_id', true);

					arShow($prova);
					exit;
					// $this->db->where("id",$id);
					// $this->db->update("provas",$prova);
				
					// $this->session->set_flashdata("msg_success", "Registro <b>#{$prova->id}</b> atualizado!");
					// redirect('provas/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$prova = $this->db
						->from("provas AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $prova;
		
		if( !$prova ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('provas/index');
		} else {
			$this->data['item'] = $prova;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $prova->id);
				$this->db->delete("provas");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('provasindex');
			}
		}
	}
}

/* End of file Provases.php */
/* Location: ./system/application/controllers/Provases.php */