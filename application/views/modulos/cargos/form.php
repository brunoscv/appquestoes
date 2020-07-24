<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("cargos")?>">Cargos</a></li>
        <li>Adicionar Cargo </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Controle de Cargos</h3>
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
				                    <h4 class="panel-title">Cargos / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
				                    <a href="<?php echo site_url("cargos/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<form id="form_cargos" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">

																					<div class="form-group">
												<label class="col-sm-2 control-label" for="id">Id</label>
												<div class="col-sm-10">
													<input name="id" type="text" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
<?php echo form_error('id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="descricao">Descrição</label>
												<div class="col-sm-10">
													<input name="descricao" type="text" id="descricao" class="form-control" value="<?php echo set_value("descricao", @$item->descricao) ?>" />
<?php echo form_error('descricao'); ?>
												</div>
											</div>
																															

										<div class="form-actions">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("cargos"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/cargos/js.js"></script>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/cargos/validate.js"></script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>