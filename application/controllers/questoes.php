<?php
class Questoes extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Questoes_model");
		$this->load->model("Provas_model");
		$this->load->model("Formacoes_model");


		//adicione os campos da busca
		$camposFiltros["q.id"] = "Id";
		$camposFiltros["q.tipo"] = "Tipo Questão";
		$camposFiltros["q.texto"] = "Texto Aux.";
		$camposFiltros["q.ano"] = "Ano Questão";
		$camposFiltros["q.imagem"] = "Imagem Aux.";
		$camposFiltros["q.enunciado"] = "Enunciado";
		$camposFiltros["q.dificuldade"] = "Dificuldade";
		$camposFiltros["q.bancas_id"] = "Bancas_id";
		$camposFiltros["q.instituicoes_id"] = "Instituicoes_id";
		$camposFiltros["q.cargos_id"] = "Cargos_id";
		$camposFiltros["q.provas_id"] = "Provas_id";
		$camposFiltros["q.formacoes_id"] = "Área Formação";

		$this->data['campos']    = $camposFiltros;
	}
	
	function index(){
		$id_prova = $this->input->get("prova_id");
		
		//carregar prova por id
		$prova = $this->db
						->select("*")
						->from("provas")
						->where("id",$id_prova)
						->get()->row();

		//se prova nao existe redireciona para a lista de provas
		if( !$prova ){
			redirect("provas/index");
		}
		//senao continua
		$this->data['prova'] = $prova;

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
		$countQuestoes = $this->db
							->select("count(q.id) AS quantidade")
							->from("questoes AS q")
							->join("instituicoes AS i", "i.id = q.instituicoes_id", "left")
							->join("bancas AS b", "b.id = q.bancas_id", "left")
							->join("cargos AS c", "c.id = q.cargos_id", "left")
							->join("provas AS p", "p.id = q.provas_id", "left")
							->join("formacoes AS f", "f.id = q.provas_id", "left")
							->where("p.id", $id_prova)
							->get()->row();
		$quantidadeQuestoes = $countQuestoes->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultQuestoes = $this->db
									->select("p.id as prova_id, p.descricao AS provas, i.descricao AS instituicoes")
									->select("q.tipo, q.texto, q.ano, q.enunciado, q.dificuldade")
									->select("c.descricao AS cargos, b.descricao AS bancas, q.id")
									->from("questoes AS q")
									->join("instituicoes AS i", "i.id = q.instituicoes_id", "left")
									->join("bancas AS b", "b.id = q.bancas_id", "left")
									->join("cargos AS c", "c.id = q.cargos_id", "left")
									->join("provas AS p", "p.id = q.provas_id", "left")
									->join("formacoes AS f", "f.id = q.provas_id", "left")
									->where("p.id", $id_prova)
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaQuestoes'] = $resultQuestoes->result();

		$this->data['dificuldadeQuestoes'] = $this->config->item("dificuldadeQuestoes");
		$this->data['tipoQuestoes'] = $this->config->item("tipoQuestoes");
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("questoes/index")."?";
		$config['total_rows'] = $quantidadeQuestoes;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    function criar(){
		$this->data['item'] = new stdClass();
		
		$id_prova = $this->input->get("prova_id");
		
		$controlaDivAlternativas = $this->uri->segment(2);
			if ($controlaDivAlternativas == "editar") {
				$this->data['status'] = "show()";
			} else {
					$this->data['status'] = "hide()";
			}
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamentos aqui
		$tipoQuestoes = $this->config->item('tipoQuestoes');
		$this->data['tipoQuestoes'] = array();
		$this->data['tipoQuestoes'][''] = "Selecione um tipo";
		foreach ($tipoQuestoes as $k=>$tipo) {
			$this->data['tipoQuestoes'][$k] = $tipo;
		}

		$dificuldadeQuestoes = $this->config->item('dificuldadeQuestoes');
		$this->data['dificuldadeQuestoes'] = array();
		$this->data['dificuldadeQuestoes'][''] = "Selecione uma dificuldade";
		foreach ($dificuldadeQuestoes as $k => $dificuldade) {
			$this->data['dificuldadeQuestoes'][$k] = $dificuldade;
		}

		$formacoes = $this->Formacoes_model->listaFormacoes();
		$this->data['listaFormacoes'] = array();
		$this->data['listaFormacoes'][''] = 'Selecione um cargo';
		foreach ($formacoes as $formacao) {
			$this->data['listaFormacoes'][$formacao->id] = $formacao->descricao;
		}
		//fim Campos relacionados
		
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('Questoes') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Seleciona alguns dados das provas
				$lista = $this->Provas_model->getListaProvas($id_prova);
				
				//Preenche objeto com as informações do formulário
				$questoe	                = array();
				$questoe['tipo'] 	        = $this->input->post('tipo', TRUE);
				$questoe['texto'] 		    = $this->input->post('texto', TRUE);
				$questoe['ano'] 		    = $this->input->post('ano', TRUE);
				// $questoe['imagem'] 		= $this->input->post('imagem', TRUE);
				$questoe['enunciado'] 		= $this->input->post('enunciado', TRUE);
				$questoe['dificuldade'] 	= $this->input->post('dificuldade', TRUE);
				
				$questoe['bancas_id'] 		= $lista->bancas_id;
				$questoe['instituicoes_id'] = $lista->instituicoes_id;
				$questoe['cargos_id'] 		= $lista->cargos_id;
				$questoe['provas_id'] 		= $lista->id;
				$questoe['formacoes_id'] 	= $lista->formacoes_id;
				$this->db->insert("questoes", $questoe);
				
				// arShow($questoe);exit;
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('questoes/index/?prova_id='.$lista->id);
			}
		} 
    	
    }


    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);
		$prova_id = $this->input->get("prova_id");

		$questoe = $this->db
						->select("*")
						->from("questoes AS m")
						->where("provas_id", $prova_id)
						->where("id", $id)->get()->row();

		$controlaDivAlternativas = $this->uri->segment(2);
		if ($controlaDivAlternativas == "editar") {
			$this->data['status'] = "show()";
		} else {
				$this->data['status'] = "hide()";
		}
		//Campos relacionados
		//caso seja necessario adicione os relacionamentos aqui
		$tipoQuestoes = $this->config->item('tipoQuestoes');
		$this->data['tipoQuestoes'] = array();
		foreach ($tipoQuestoes as $k=>$tipo) {
			$this->data['tipoQuestoes'][$k] = $tipo;
		}

		$dificuldadeQuestoes = $this->config->item('dificuldadeQuestoes');
		$this->data['dificuldadeQuestoes'] = array();
		foreach ($dificuldadeQuestoes as $k => $dificuldade) {
			$this->data['dificuldadeQuestoes'][$k] = $dificuldade;
		}

		$formacoes = $this->Formacoes_model->listaFormacoes();
		$this->data['listaFormacoes'] = array();
		foreach ($formacoes as $formacao) {
			$this->data['listaFormacoes'][$formacao->id] = $formacao->descricao;
		}
		//fim Campos relacionados


		if(!$questoe){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('questoes/index/?prova_id='.$prova_id);
		} else {
			$this->data['item'] = $questoe;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Questoes') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$questoe	                = array();
					$questoe['id']	            = $this->input->post('id', true);
					$questoe['tipo']	        = $this->input->post('tipo', true);
					$questoe['texto']	        = $this->input->post('texto', true);
					$questoe['ano']	            = $this->input->post('ano', true);
					$questoe['imagem']	        = $this->input->post('imagem', true);
					$questoe['enunciado']	    = $this->input->post('enunciado', true);
					$questoe['dificuldade']	    = $this->input->post('dificuldade', true);
					$questoe['bancas_id']	    = $this->input->post('bancas_id', true);
					$questoe['instituicoes_id']	= $this->input->post('instituicoes_id', true);
					$questoe['cargos_id']	    = $this->input->post('cargos_id', true);
					$questoe['provas_id']	    = $this->input->post('provas_id', true);

					$this->db->where("id",$id);
					$this->db->update("questoes",$questoe);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$questoe->id}</b> atualizado!");
					redirect('questoes/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$questoe = $this->db
						->from("questoes AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $questoe;
		
		if( !$questoe ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('questoes/index');
		} else {
			$this->data['item'] = $questoe;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $questoe->id);
				$this->db->delete("questoes");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('questoesindex');
			}
		}
	}
}

/* End of file Questoeses.php */
/* Location: ./system/application/controllers/Questoeses.php */