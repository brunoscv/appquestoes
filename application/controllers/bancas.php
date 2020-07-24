<?php
class Bancas extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Bancas_model");
		
		//adicione os campos da busca
		$camposFiltros["b.id"] = "id";
		$camposFiltros["b.descricao"] = "Descrição";

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
		$countBancas = $this->db
							->select("count(b.id) AS quantidade")
							->from("bancas AS b")
							->get()->row();
		$quantidadeBancas = $countBancas->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultBancas = $this->db
									->select("*")
									->from("bancas AS b")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaBancas'] = $resultBancas->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("bancas/index")."?";
		$config['total_rows'] = $quantidadeBancas;
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
			
			if( $this->form_validation->run('Bancas') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$banca	= array();
				$banca['id'] 		= $this->input->post('id', TRUE);
				$banca['descricao'] 		= $this->input->post('descricao', TRUE);
				$banca['createdAt']	= date("Y-m-d H:i:s");
				$this->db->insert("bancas", $banca);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('bancas/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$banca = $this->db
						->from("bancas AS m")
						->where("id", $id)->get()->row();

		if(!$banca){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('bancas/index');
		} else {
			$this->data['item'] = $banca;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Bancas') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$banca	= array();
					$banca['id']	= $this->input->post('id', true);
					$banca['descricao']	= $this->input->post('descricao', true);
					$banca['updatedAt']	= date("Y-m-d H:i:s");

					$this->db->where("id",$id);
					$this->db->update("bancas",$banca);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$banca->id}</b> atualizado!");
					redirect('bancas/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$banca = $this->db
						->from("bancas AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $banca;
		
		if( !$banca ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('bancas/index');
		} else {
			$this->data['item'] = $banca;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $banca->id);
				$this->db->delete("bancas");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('bancas/index');
			}
		}
	}
}

/* End of file Bancases.php */
/* Location: ./system/application/controllers/Bancases.php */