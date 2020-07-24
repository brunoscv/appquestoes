<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("alternativas")?>">Alternativas</a></li>
        <li>Adicionar Alternativa </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Controle de Alternativas</h3>
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
				                    <h4 class="panel-title">Alternativas / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
				                    <a href="<?php echo site_url("alternativas/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<form id="form_alternativas" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">

																					<div class="form-group">
												<label class="col-sm-2 control-label" for="id">id</label>
												<div class="col-sm-10">
													<input name="id" type="text" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
<?php echo form_error('id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="descricao">descricao</label>
												<div class="col-sm-10">
													<input name="descricao" type="text" id="descricao" class="form-control" value="<?php echo set_value("descricao", @$item->descricao) ?>" />
<?php echo form_error('descricao'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="ordem">ordem</label>
												<div class="col-sm-10">
													<input name="ordem" type="text" id="ordem" class="form-control" value="<?php echo set_value("ordem", @$item->ordem) ?>" />
<?php echo form_error('ordem'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="valor">valor</label>
												<div class="col-sm-10">
													<input name="valor" type="text" id="valor" class="form-control" value="<?php echo set_value("valor", @$item->valor) ?>" />
<?php echo form_error('valor'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="questoes_id">questoes_id</label>
												<div class="col-sm-10">
													<input name="questoes_id" type="text" id="questoes_id" class="form-control" value="<?php echo set_value("questoes_id", @$item->questoes_id) ?>" />
<?php echo form_error('questoes_id'); ?>
												</div>
											</div>
																															

										<div class="form-actions">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("alternativas"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/alternativas/js.js"></script>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/alternativas/validate.js"></script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>