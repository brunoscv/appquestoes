<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("provas")?>">Provas</a></li>
        <li>Adicionar Prova </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Controle de Provas</h3>
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
				                    <h4 class="panel-title">Provas / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
				                    <a href="<?php echo site_url("provas/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<form id="form_provas" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
												<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
                                                 <?php echo form_error('id'); ?>
										<div class="form-group">
												<label class="col-sm-2 control-label" for="descricao">Descrição</label>
												<div class="col-sm-10">
													<input name="descricao" type="text" id="descricao" class="form-control" value="<?php echo set_value("descricao", @$item->descricao) ?>" />
                                                 <?php echo form_error('descricao'); ?>
												</div>
											</div>
												<div class="form-group">
												<label class="col-sm-2 control-label" for="ano">Ano Prova</label>
												<div class="col-sm-10">
													<input name="ano" type="text" id="ano" class="form-control" value="<?php echo set_value("ano", @$item->ano) ?>" />
                                                 <?php echo form_error('ano'); ?>
												</div>
											</div>
												<div class="form-group">
												<label class="col-sm-2 control-label" for="bancas_id">Banca</label>
												<div class="col-sm-10">
													<?php echo form_dropdown('bancas_id', $listaBancas, set_value('banca_id', @$item->bancas_id), 'class="form-control"'); ?>
													<!-- <input name="bancas_id" type="text" id="bancas_id" class="form-control" value="<?php echo set_value("bancas_id", @$item->bancas_id) ?>" /> -->
<?php echo form_error('bancas_id'); ?>
												</div>
											</div>
												<div class="form-group">
												<label class="col-sm-2 control-label" for="instituicoes_id">Instituicao</label>
												<div class="col-sm-10">
													<?php echo form_dropdown('instituicoes_id', $listaInstituicoes, set_value('instituicoes_id', @$item->instituicoes_id), 'class="form-control"'); ?>
													
<?php echo form_error('instituicoes_id'); ?>
												</div>
											</div>
												<div class="form-group">
												<label class="col-sm-2 control-label" for="cargos_id">Cargo</label>
												<div class="col-sm-10">
													<?php echo form_dropdown('cargos_id', $listaCargos, set_value('cargo_id', @$item->cargos_id), 'class="form-control"'); ?>
													
<?php echo form_error('cargos_id'); ?>
												</div>
											</div>
																															

										<div class="form-actions">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("provas"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/provas/js.js"></script>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/provas/validate.js"></script>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>