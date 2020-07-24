<?php
class Clientes extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Clientes_model");
		
		//adicione os campos da busca
		$camposFiltros["c.nome_empresa"] = "Nome da empresa";
		$camposFiltros["c.email"] = "E-mail";

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
		$countClientes = $this->db
							->select("count(c.id) AS quantidade")
							->from("clientes AS c")
							->get()->row();
		$quantidadeClientes = $countClientes->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultClientes = $this->db
									->select("*")
									->from("clientes AS c")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaClientes'] = $resultClientes->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("clientes/index")."?";
		$config['total_rows'] = $quantidadeClientes;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    function criar(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		//fim Campos relacionados

		/*
		$this->load->model("Estados_model");
		$this->data['listaEstados'] = resultToOptions($this->Estados_model->listaTodos(),"id","nome");
		$this->data['listaCidades'] = array(""=>"- Selecione -");
		*/
		
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('Clientes') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				$cliente	= array();
				$cliente['nome_empresa'] 		= $this->input->post('nome_empresa', TRUE);
				$cliente['nome_responsavel'] 		= $this->input->post('nome_responsavel', TRUE);
				//$cliente['url'] 		= $this->input->post('url', TRUE);
				//$cliente['cidades_id'] 		= $this->input->post('cidades_id', TRUE);
				$cliente['telefone'] 		= $this->input->post('telefone', TRUE);
				$cliente['email'] 		= $this->input->post('email', TRUE);
				$cliente['createdAt'] = date("Y-m-d H:i:s");

				$configuracoes = array();
				$configuracoes['limite_usuarios'] 	= $this->input->post("limite_usuarios", TRUE);
				$configuracoes['color_main'] 		= $this->input->post("color_main", TRUE);
				$configuracoes['foto']				= $foto ? $foto : NULL;
				$cliente['configuracoes'] = json_encode($configuracoes);

				$this->db->insert("clientes", $cliente);

				$usuario = array();
				$usuario['usuario'] = $this->input->post('email', TRUE);
				$usuario['principal'] = TRUE;
				$usuario['nome'] = $this->input->post('nome_responsavel', TRUE);
				$usuario['email'] = $this->input->post('email', TRUE);
				$usuario['senha'] =  $this->encrypt->encode($this->input->post('senha', TRUE));
				$usuario['clientes_id'] = $this->db->insert_id();
				$usuario['createdAt'] = date("Y-m-d H:i:s");

				$this->db->insert("usuarios", $usuario);
				$this->db->insert('usuarios_perfis', array('usuarios_id' => $this->db->insert_id(), 'perfis_id' => 2));			
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('clientes/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		/*
		$this->load->model("Estados_model");
		$this->data['listaEstados'] = resultToOptions($this->Estados_model->listaTodos(),"id","nome");
		*/

		$cliente = $this->db
						->from("clientes AS m")
						->where("id", $id)->get()->row();

		if(!$cliente){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('clientes/index');
		} else {
			/*
			$this->load->model("Cidades_model");
			$cidade = $this->Cidades_model->getCidade($cliente->cidades_id);
			$cliente->estados_id = $cidade->estados_id;
			*/
			$cliente->configuracoes = json_decode($cliente->configuracoes);

			//$this->data['listaCidades'] = resultToOptions($this->Estados_model->listaCidades($cliente->estados_id), "id", "nome");

			$this->data['item'] = $cliente;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Clientes') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {

					$foto = $this->input->post('foto', TRUE);
					$m = date('m'); $Y = date('Y');

					if( $foto ){

						if( $this->input->post("id") ){
							$foto_db = $cliente->configuracoes->foto;
							$foto_db = explode("/", $foto_db);
							
							$m = $foto_db[1];
							$Y = $foto_db[0];
						}

						$target_dir = FCPATH . '../public/data/' . $Y . '/' . $m . '/';
						$source_dir = FCPATH . '../public/uploadify/temp/';
						if(!file_exists($target_dir)) mkdir($target_dir, 0777, true);
						if(file_exists($source_dir . $foto)) rename($source_dir . $foto, $target_dir . $foto);

					}
					
					$cliente	= array();
					$cliente['id']	= $this->input->post('id', true);
					$cliente['nome_empresa']	= $this->input->post('nome_empresa', true);
					$cliente['nome_responsavel']	= $this->input->post('nome_responsavel', true);
					$cliente['url']	= $this->input->post('url', true);
					//$cliente['cidades_id']	= $this->input->post('cidades_id', true);
					$cliente['telefone']	= $this->input->post('telefone', true);
					$cliente['email']	= $this->input->post('email', true);
					$usuario['updatedAt'] = date("Y-m-d H:i:s");

					$configuracoes = array();
					$configuracoes['limite_usuarios'] 	= $this->input->post("limite_usuarios", TRUE);
					$configuracoes['color_main'] 		= $this->input->post("color_main", TRUE);
					$configuracoes['foto']				= $foto ? $foto : NULL;

					$cliente['configuracoes'] = json_encode($configuracoes);

					$this->db->where("id",$id);
					$this->db->update("clientes",$cliente);

					$usuarioPrincial = $this->db->from("usuarios")
											->where("clientes_id", $cliente['id'])
											->where("principal",TRUE)
											->get()->row();

					$usuario['usuario'] = $cliente['email'];
					$usuario['nome'] = $cliente['nome_responsavel'];
					$usuario['email'] = $cliente['email'];
					
					if( $this->input->post("senha") )
						$usuario['senha'] =  $this->encrypt->encode($this->input->post('senha', TRUE));
					
					$usuario['updatedAt'] = date("Y-m-d H:i:s");

					$this->db->where("id", $usuarioPrincial->id);
					$this->db->update("usuarios", $usuario);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$cliente->id}</b> atualizado!");
					redirect('clientes/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$cliente = $this->db
						->from("clientes AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $cliente;
		
		if( !$cliente ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('clientes/index');
		} else {
			$this->data['item'] = $cliente;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $cliente->id);
				$this->db->delete("clientes");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('clientesindex');
			}
		}
	}
}

/* End of file Clienteses.php */
/* Location: ./system/application/controllers/Clienteses.php */