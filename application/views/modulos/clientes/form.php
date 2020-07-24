<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("clientes")?>">Clientes</a></li>
        <li>Adicionar Cliente</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Clientes</h3>
    </div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-4">
							<?php echo $this->load->view('layout/search.php'); ?>
						</div>
						<div class="col-md-8" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
				                    <h4 class="panel-title">Clientes / <?php echo (@$item->id) ? "Editar" : "Novo"?></h4>
				                    <a href="<?php echo site_url("clientes/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Listagem de Clientes</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>

									<form id="form_clientes" class="form-horizontal" method="post" action="<?php echo current_url(); ?>" enctype="multipart/form-data">

										<div class="tabbable">
											<ul class="nav nav-tabs">
												<li class="active">
													<a href="#geral" data-toggle="tab">Informações Gerais</a>
												</li>
												<li>
													<a href="#configuracoes" data-toggle="tab">Configurações</a>
												</li>
											</ul>
											<div class="tab-content">
												<div class="tab-pane active" id="geral">
													<input name="id" type="hidden" id="id" value="<?php echo set_value("id", @$item->id) ?>" />
													<div class="form-group">
														<label class="col-sm-2 control-label" for="nome_empresa">Nome da empresa</label>
														<div class="col-sm-10">
															<input name="nome_empresa" type="text" id="nome_empresa" class="form-control" value="<?php echo set_value("nome_empresa", @$item->nome_empresa) ?>" />								
															<?php echo form_error('nome_empresa'); ?>
														</div>
													</div>
																									
													<div class="form-group">
														<label class="col-sm-2 control-label" for="nome_responsavel">Nome do responsável</label>
														<div class="col-sm-10">
															<input name="nome_responsavel" type="text" id="nome_responsavel" class="form-control" value="<?php echo set_value("nome_responsavel", @$item->nome_responsavel) ?>" />								
															<?php echo form_error('nome_responsavel'); ?>
														</div>
													</div>

													<? /*
													<div class="form-group">
														<label class="col-sm-2 control-label" for="url">Url Principal</label>
														<div class="col-sm-10">
															<div class="input-group">
																<span class="input-group-addon" id="basic-addon1">http://</span>
																<input name="url" type="text" id="url" class="form-control" value="<?php echo set_value("url", @$item->url) ?>" />
															</div>
															<p class="help-block">Insira a URL absoluta onde o sistema será instalado</p>
															<?php echo form_error('url'); ?>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-2 control-label" for="estados_id">Estado</label>
														<div class="col-sm-10">
															<?php echo form_dropdown("estados_id", $listaEstados, set_value("estados_id", @$item->estados_id), 'class="form-control" onchange="loadCidades(this.value, \'#cidades_id\');"'); ?>			
															<?php echo form_error('estados_id'); ?>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label" for="cidades_id">Cidade</label>
														<div class="col-sm-10">
															<?php echo form_dropdown("cidades_id", $listaCidades, set_value("cidades_id", @$item->cidades_id), 'class="form-control" id="cidades_id"'); ?>								
															<?php echo form_error('cidades_id'); ?>
														</div>
													</div>
													*/?>
																									
													<div class="form-group">
														<label class="col-sm-2 control-label" for="telefone">Telefone</label>
														<div class="col-sm-10">
															<input name="telefone" type="text" id="telefone" class="form-control" data-mask='(99) 9999-99999' value="<?php echo set_value("telefone", @$item->telefone) ?>" />								
															<?php echo form_error('telefone'); ?>
														</div>
														
														<!-- /controls -->
													</div>
													
													<!-- /control-group -->
													<div class="form-group">
														<label class="col-sm-2 control-label" for="email">E-mail</label>
														<div class="col-sm-10">
															<input name="email" type="text" id="email" class="form-control" value="<?php echo set_value("email", @$item->email) ?>" />								
															<?php echo form_error('email'); ?>
														</div>
														
														<!-- /controls -->
													</div>
																									
													<div class="form-group">
														<label class="col-sm-2 control-label" for="email">Senha</label>
														<div class="col-sm-10">
															<input name="senha" type="password" id="senha" class="form-control" value="<?php echo set_value("senha", @$item->senha) ?>" />								
															<?php echo form_error('email'); ?>
														</div>
														
														<!-- /controls -->
													</div>
																									
													<div class="form-group">
														<label class="col-sm-2 control-label" for="email">Senha novamente</label>
														<div class="col-sm-10">
															<input name="senha_re" type="password" id="senha_re" class="form-control" value="<?php echo set_value("senha_re", @$item->senha_re) ?>" />								
															<?php echo form_error('email'); ?>
														</div>
													</div>
												</div>
												<div class="tab-pane" id="configuracoes">
													<h3>Configurações Gerais</h3>
													<div class="form-group">
														<label class="col-sm-2 control-label" for="limite_usuarios">Limite de usuários</label>
														<div class="col-sm-10">
															<input name="limite_usuarios" type="text" id="limite_usuarios" class="form-control" value="<?php echo set_value("limite_usuarios", @$item->configuracoes->limite_usuarios) ?>" />								
															<?php echo form_error('limite_usuarios'); ?>
														</div>
														<!-- /controls -->
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label" for="logo">Logomarca</label>
														<div class="col-sm-10">
															<style type="text/css">
																.uploadify, .cadastro-img-preview img{ display: inline-block; width: 40% !important; }
															</style>

															<div id="queue"></div>
															<div class="cadastro-img-preview">
																<?php 
																	$foto = set_value("foto", @$item->configuracoes->foto);
																	$foto_arq = "";
																	if($foto){
																		echo '<img src="' . base_url() . '../public/uploads/' . $foto . '"/>';
																		strtok($foto, '/'); strtok('/'); $foto_arq = strtok('/');
																	}
																?>
															</div>
															<input type="hidden" id="foto" name="foto" value="<?php echo $foto_arq; ?>"/>
															
															<div id="myId" class="dropzone">
																<div class="fallback">
																	<input type="file" name="file" multiple="false">
																</div>
															</div>
														
															<script type="text/javascript">
																$(document).ready(function() {
																	
																	Dropzone.options.myId = { 
																		acceptedFiles: "image/*",
																		maxFilesize: 2,
																		uploadMultiple:false,
																		maxFiles:1,
																		dictDefaultMessage:"<img src='"+base_url+"assets/images/upload.png' alt=''>",
																		success:function(a, data){
																			console.log(data);
																			if( data.sucesso ){
																				console.log(data.arquivo);
																				$("#foto").val(data.arquivo.file_name);
																			}
																		}
																	};

																	Dropzone.autoDiscover = false;
																	$("div#myId").dropzone( 
																			{
																				url: base_url + "rest/upload"
																			}
																	);
																	
																});
															</script>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label" for="color_main">Cor principal do front</label>
														<div class="col-sm-10">
															<input name="color_main" type="text" id="color_main" class="form-control" value="<?php echo set_value("color_main", @$item->configuracoes->color_main) ?>" />								
															<?php echo form_error('color_main'); ?>
														</div>
														<!-- /controls -->
													</div>
													
												<div class="form-group">
													<div class="col-sm-10 col-offset-2">
														<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
														<a href="<?php echo site_url("clientes"); ?>" class="btn">
															Cancelar
														</a>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/clientes/js.js"></script>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/clientes/validate.js"></script>
								<script type="text/javascript">
								$(document).ready(function() {
									$('#color_main').colorpicker({
										format: 'hex'
									});
								})
								</script>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>