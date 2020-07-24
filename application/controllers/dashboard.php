<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct(){
		parent::__construct();		
		$this->_auth();		
	}

	public function index(){

	}

	public function alterarSenha(){
		$this->load->model("Usuarios_model");
		$rules = array(
				array(
					'field' => "senha_antiga",
					'label' => "Senha Antiga",
					'rules' => "required"
						),
				array(
					'field' => "nova_senha",
					'label' => "",
					'rules' => "required"
						)
				);
		$this->form_validation->set_rules($rules);
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run() === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				if( $usuario = $this->Usuarios_model->getUsuarioById($this->data['userdata']['id']) ){
					if( $this->encrypt->decode($usuario->senha) == $this->input->post("senha_antiga", TRUE) ){
						$user = array();
						$user['senha'] = $this->encrypt->encode( $this->input->post("nova_senha") );
						$user['updatedAt'] = date("Y-m-d H:i:s");

						$this->db->where("id", $usuario->id);
						$this->db->update("usuarios", $user);

						$this->session->set_flashdata("msg_success", "Senha atualizada com sucesso");
						redirect("dashboard/alterarSenha");
					} else {
						$this->data['msg_error'] = "Senha Incorreta";	
					}
				} else {
					echo $this->db->last_query();exit;
					$this->data['msg_error'] = "Usuário não encontrado";
				}
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */