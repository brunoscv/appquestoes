<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("questoes")?>">Questoes</a></li>
        <li>Adicionar Questoe </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Controle de Questoes</h3>
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
				                    <h4 class="panel-title">Questoes / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
				                    <a href="<?php echo site_url("questoes/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<form id="form_questoes" action="<?php echo current_url(); ?>?prova_id=<?php echo $this->input->get("prova_id"); ?>" class="form-horizontal" method="post">
												<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
				   									<?php echo form_error('id'); ?>
												
										<div class="form-group">
												<label class="col-sm-2 control-label" for="tipo">Tipo Questão</label>
												<div class="col-sm-10">
													<!--<input name="tipo" type="text" id="tipo" class="form-control" value="<?php echo set_value("tipo", @$item->tipo) ?>" />
													parametro 1 - name, 2-listaDeValores, 3- valorDefault, 4-extras -->
													<?php echo form_dropdown('tipo', $tipoQuestoes, set_value('tipoQuestoes', @$item->tipo), 'class="form-control"') ;?>
													<?php echo form_error('tipo'); ?>
												</div>
											</div>
										<div class="form-group">
												<label class="col-sm-2 control-label" for="texto">Texto Aux.</label>
												<div class="col-sm-10">
													<textarea name="texto" id="texto" class="form-control">
														<?php echo set_value("texto", @$item->texto);?>
													</textarea>
													<!-- <input name="texto" type="text" id="texto" class="form-control" value="<?php echo set_value("texto", @$item->texto) ?>" /> -->
													<?php echo form_error('texto'); ?>
												</div>
											</div>
										<div class="form-group">
												<label class="col-sm-2 control-label" for="ano">Ano Questão</label>
												<div class="col-sm-2">
													<input name="ano" type="text" id="ano" class="form-control" value="<?php echo set_value("ano", @$item->ano) ?>" maxlength="4"/>
													<?php echo form_error('ano'); ?>
												</div>
											</div>
										<div class="form-group">
												<label class="col-sm-2 control-label" for="imagem">Imagem Aux.</label>
												<div class="col-sm-10">
													<input name="imagem" type="file" id="imagem" class="form-control" value="<?php echo set_value("imagem", @$item->imagem) ?>" />
													<?php echo form_error('imagem'); ?>
												</div>
											</div>
										<div class="form-group">
												<label class="col-sm-2 control-label" for="enunciado">Enunciado</label>
												<div class="col-sm-10">
													<textarea name="enunciado" id="enunciado" class="form-control">
														<?php echo set_value("enunciado", @$item->enunciado);?>
													</textarea>
													<!-- <input name="enunciado" type="text" id="enunciado" class="form-control" value="<?php echo set_value("enunciado", @$item->enunciado) ?>" /> -->
													<?php echo form_error('enunciado'); ?>
												</div>
											</div>
										<div class="form-group">
												<label class="col-sm-2 control-label" for="dificuldade">Dificuldade</label>
												<div class="col-sm-10">
													<!-- <input name="dificuldade" type="text" id="dificuldade" class="form-control" value="<?php echo set_value("dificuldade", @$item->dificuldade) ?>" /> -->
													<?php echo form_dropdown('dificuldade', $dificuldadeQuestoes, set_value('dificuldadeQuestoes', @$item->dificuldade ), 'class="form-control"') ;?>
													<?php echo form_error('dificuldade'); ?>
												</div>
										</div>
										<div class="form-group">
												<label class="col-sm-2 control-label" for="bancas_id">Área Formação</label>
												<div class="col-sm-10">
													<?php echo form_dropdown('formacoes_id', $listaFormacoes, set_value('formacoes_id', @$item->formacoes_id), 'class="form-control"'); ?>
													<!-- <input name="bancas_id" type="text" id="bancas_id" class="form-control" value="<?php echo set_value("bancas_id", @$item->bancas_id) ?>" /> -->
											<?php echo form_error('bancas_id'); ?>
												</div>
											</div>
											
										<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
											<a href="<?php echo site_url("questoes"); ?>" class="btn">
													Cancelar
											</a>
									</form>
								</div>
							</div>
							<!-- Div para a seleção das alternativas -->
							<div class="alternativas" >
								<div class="panel panel-default">
									<div class="panel-heading clearfix">
					                    <h4 class="panel-title">Opções/ Alternativas </h4>
					                    <!-- <input type="button" class="btn btn-primary adicionarCampo pull-right" title="Adicionar item" value="Adicionar Campo"/> -->
					                    <a class="btn btn-primary pull-right adicionarCampo"><span class="fa fa-plus"></span>  Adicionar Campo</a>
					                </div>
									<div class="panel-body" style="margin-top:1em">
										<?php echo $this->load->view('layout/messages.php'); ?>
										<form id="form_questoes" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
													<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
					   									<?php echo form_error('id'); ?>
													
											<div class="form-group opcoes">
													<label class="col-sm-2 control-label" for="tipo">Opção</label>
													<div class="col-sm-6">
														<input name="tipo" type="text" id="tipo_{12}" class="form-control opcoes" value="<?php echo set_value("tipo", @$item->tipo) ?>" />
														<?php echo form_error('tipo'); ?>
													</div>
													<div class="col-sm-2">
														<select name="valor" class="form-control">
															<option value="0">F</option>
															<option value="1">V</option>
														</select>
														<!-- <input name="valor" type="text" id="valor" class="form-control" value="<?php echo set_value("tipo", @$item->tipo) ?>" placeholder="V ou F" maxlength="1"/> -->
														<?php echo form_error('valor'); ?>
													</div>
													<a href="salvar" class="btn btn-primary pull-right">salvar</a>
											</div>
										</form>
									</div>
								</div>
							</div>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/questoes/js.js"></script>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/questoes/validate.js"></script>
							<script type="text/javascript">
								$(document).ready(function() {
									$(".adicionarCampo").click(function () {
										novoCampo = $("div.opcoes:first").clone();
										novoCampo.find("input").val("");
										novoCampo.insertAfter("div.opcoes:last");
									});

									$(".alternativas").<?php echo $status;?>;
								});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
