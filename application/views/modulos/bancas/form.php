<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("bancas")?>">Bancas</a></li>
        <li>Adicionar Banca </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Controle de Bancas</h3>
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
				                    <h4 class="panel-title">Bancas / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
				                    <a href="<?php echo site_url("bancas/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<form id="form_bancas" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
										<input name="id" type="hidden" id="id" value="<?php echo set_value("id", @$item->id) ?>" />
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
												<a href="<?php echo site_url("bancas"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/bancas/js.js"></script>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/bancas/validate.js"></script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>