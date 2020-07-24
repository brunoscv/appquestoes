<?php

function abrev($string){
	$string = strtoupper($string);
	$s = explode(" ", $string);
	$r = "";
	foreach($s as $st){
		$r .= $st{0};
	}
	return $r;
}

function mask($val, $mask){
	$maskared = '';
	$k = 0;
	for($i = 0; $i<=strlen($mask)-1; $i++){
			if($k >= strlen($val) && $mask[$i] == '#')
				break;
			
			if($mask[$i] == '#'){
				if(isset($val[$k]))
					$maskared .= $val[$k++];
			} else {
				if(isset($mask[$i]))
					$maskared .= $mask[$i];
			}
		
	}
	return $maskared;
}

function userHasSetor($setorId){
	$CI = &get_instance();
	if( !in_array(1,$CI->data['userdata']['perfis']) ){
		$setores = $CI->data['userdata']['setores'];
		if( !in_array($setorId, $setores) ){
			return false;
		}
		return true;
	}
	return true;
}

function isUsuarioMaster(){
	$CI = &get_instance();
	if( in_array(1, $CI->data['userdata']['perfis']) ){
		return true;
	}
	return false;	
}

function hasPerfil($perfil){
	$CI = &get_instance();
	if( in_array($perfil, $CI->data['userdata']['perfis']) ){
		return true;
	}
	return false;	
}

function filtraRespostas($respostaPorPessoa, $alternativasFiltro = array()){
		
		$respostas = array();
		foreach($respostaPorPessoa as $listaRespostas){
			foreach($listaRespostas as $resposta){
				if( !empty($resposta->valores_id) ){
					$respostas[$resposta->pessoas_id][$resposta->questoes_id][$resposta->alternativas_id][$resposta->valores_id] = TRUE;
				} else {
					$respostas[$resposta->pessoas_id][$resposta->questoes_id][$resposta->alternativas_id] = TRUE;
				}
			}
		}
	
		foreach($respostas as $pessoa_id => $resposta){
			foreach($alternativasFiltro as $filtro){
				if( empty($filtro->valores_id) ){
					if( !isset($resposta[$filtro->questoes_id][$filtro->alternativas_id]) ){
						unset($respostaPorPessoa[$pessoa_id]);
						break;
					}
				} else {
					if( !isset($resposta[$filtro->questoes_id][$filtro->alternativas_id][$filtro->valores_id]) ){
						unset($respostaPorPessoa[$pessoa_id]);
						break;
					}
				}
			}
		}

		return $respostaPorPessoa;
}

function ordenaCandidatosNome($a, $b) {
    return (strnatcmp($a->candidato, $b->candidato) < 1) ? -1 : 1;
}

function mascara_cpf($cpf){
	$cpf = preg_replace("/([^0-9])/", "", $cpf);
	$cpf = substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9, 2);
	return $cpf;
}

function escapeItem(&$item1,$key){
	#$item1 = htmlentities($item1, ENT_QUOTES);
	#$item1 = str_replace(''1'', "'", $subject)($item1, ENT_QUOTES);
	$item1 = str_replace("'", "'", $item1);
}

function parseJson($array){
	array_walk($array, "escapeItem");
	$encode = str_replace("'", "\'",json_encode($array));
	return str_replace("\"", '&#034;', $encode);
}

function calculaIdade($dataNascimento){
	list($dia, $mes, $ano) = explode("/", _date($dataNascimento,"d/m/Y"));
	$idade = date("Y") - $ano;
	if( date("m") <= $mes ){
		if( date("d") < $dia ){
			$idade--;
		}
	}
	return $idade;
}

function resultToOptions($result, $opValue, $opText, $first = "- Selecione -"){
	$list = array();
	$list[''] = $first;
	foreach($result as $r){
		if( is_object($r) ){
			$list[$r->$opValue] = $r->$opText;
		} else {
			$list[$r[$opValue]] = $r[$opText];
		}
		
	}
	return $list;
}

function formPerfilList($name, $perfilList, $values = array(), $extra=""){
	$str = "<ul {$extra}>";
	foreach($perfilList as $perfil){
		$checked = ( in_array($perfil->id, $values) ) ? 'checked="checked"' : '';
		$str .= '<li><label><input '.$checked.' name="'.$name.'" value="'.$perfil->id.'" type="checkbox" /> '.$perfil->descricao.'</label>';
		$str .= "</li>";
	}
	$str .= "</ul>";
	return $str;	
}

function recursiveFormMenuList($name, $menuList, $values = array(), $extra=""){
	$str = "<ul {$extra}>";
	foreach($menuList as $menu){
		$checked = ( in_array($menu->id, $values) ) ? 'checked="checked"' : '';
		$str .= '<li><label><input '.$checked.' name="'.$name.'" value="'.$menu->id.'" type="checkbox" /> '.$menu->descricao.'</label>';
		if( count($menu->filhos) > 0 ){
			$str .= recursiveFormMenuList($name, $menu->filhos, $values);
		}
		$str .= "</li>";
	}
	$str .= "</ul>";
	return $str;	
}

function recursiveMenuNav($menuList, $extra = ""){
	$ci = &get_instance();
	$str = "<ul {$extra}>";
	foreach($menuList as $menu){
		$hasSubmenu = (count($menu->filhos) > 0);
		
		$class = "";
		if( !empty($menu->url) && preg_match("|^".$menu->url."|", "/".$ci->uri->uri_string) ){
			$class .= " active";
		}
		
		$classLink = "";
		$arrow = "";
		if( $hasSubmenu ){
			$class .= " dropdown";
			$classLink = 'class="droplink"'; 
			$arrow = '<span class="arrow"></span>';
		}
		
		$url = ( empty($menu->url) ) ? "javascript:;" : site_url($menu->url);
		
		if( $hasSubmenu ){
			$str .= "<li class=\"{$class}\"><a href=\"{$url}\" {$classLink}><span class=\"menu-icon {$menu->icone}\"></span><p>" . $menu->descricao."</p><span class=\"arrow\"></span></a>";
			$str .= recursiveMenuNav($menu->filhos,'class="sub-menu"');
		} else {
			$str .= "<li class=\"{$class}\"><a href=\"{$url}\" {$classLink}><span class=\"menu-icon {$menu->icone}\"></span><p>" . $menu->descricao."</p></a>";
		}
		$str .= "</li>";
	}
	$str .= "</ul>";
	return $str;
}

/*************************
 * @Core Functions
 */
 
function moneyIt($valor, $moeda = "R$"){
	return $moeda . " " .number_format($valor,2,",",".");
}
 
function zerofill($value, $len){
    $times = ( $len - strlen($value) < 0 ) ? 0 : $len - strlen($value);
    return str_repeat('0', $times) . $value;
}
 

function set_checked($field, $default = '') {
    $field = str_replace("]", "", $field);
    if (count($_POST) > 0) {
        $field = explode('[', $field);
        $post = $_POST;
        foreach ($field as $f) {
            $post = @$post[$f];
        }
        if ($post != "")
            return 'checked="checked"';
        return '';
    } else {
        if (!empty($default))
            return 'checked="checked"';
        return '';
    }
}

 
function _date($date, $format) {
	$date = trim($date);
    if (empty($date) || $date == '00/00/0000' || $date == '0000-00-00' || $date == '__/__/____' )
        return "";
	
	if( preg_match("/( )/", $date) ){
		list($date,$time) = explode(" ",$date);
		$date = _date($date,'Y-m-d') . " " . $time;
	}

    if (preg_match('/^\s*(\d\d?)[^\w](\d\d?)[^\w](\d{1,4}\s*$)/', $date, $match)) {
        $date = $match[2] . '/' . $match[1] . '/' . $match[3];
    }
    
    return date($format, strtotime($date));
}
 
function revertCamelCase($string){
	$attr = "";
	for($i=0;$i<strlen($string);$i++){
		if($i == 0)
			$string{$i} = strtolower($string{$i});
		
		if( $string{$i} == strtoupper($string{$i}) ){
			$attr .= "_";	
		}
		$attr .= $string{$i};
	}
	return $attr;
}

function get_active_class() {
   $controllerClassUse = & load_class('Router');
   return ucwords($controllerClassUse->fetch_class());
}

 function get_active_method() {
   $RTR = & load_class('Router');
   return $RTR->fetch_method();
}

function get_paginate_url()
{
	parse_str($_SERVER['QUERY_STRING'], $arr);
	array_unique($arr);
	unset($arr['per_page']);

	return  '/?' . http_build_query($arr);
}

function redirect_paginacao($url)
{
	$CI = &get_instance();

	if( !preg_match('/\/$/', $url) ) $url .= '/';
	$parsedUrl = parse_url($url);
	
	$qStringPagination = ( !preg_match('/^\?$/', $CI->session->userdata('qStringPagination')) ) ? $CI->session->userdata('qStringPagination') : $CI->session->userdata('qStringPagination');
	if( !empty($parsedUrl['query']) ){
		parse_str($CI->session->userdata('qStringPagination'), $queryArray);
		parse_str($parsedUrl['query'], $tempArray);
		foreach($tempArray as $key => $value){
			$queryArray[$key] = $value;
		}
		$qStringPagination = "?" . http_build_query($queryArray); 
	}
	

	redirect($url . $CI->session->userdata('qStringPagination'));
}

function arShow($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}
/** 
 * @function myException
 * Gatilho para salvar todas as exceções em arquivo, salva em log/exceptions os arquivos.html
 */ 
function myException($exception){
	$string = "";
	$string .= "Erro encontrado: ";
	$string .= $exception->getMessage() . "\n";
	$string .= $exception->getTraceAsString();

	echo "<textarea readonly='' cols='120' rows='30'>{$string}</textarea>";
	
	#TODO
	#1) Comunicar administradores do sistema que o erro aconteceu
	#2) Guardar em arquivo todos os erros que aconteceram
}

set_exception_handler('myException');