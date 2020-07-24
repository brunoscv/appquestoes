<div class="row" data-container="all">
	<div class="span4">
		<?php echo $this->load->view('layout/search.php'); ?>
	</div>
	<div class="span8" data-container="main">
		<div class="widget">
			<div class="widget-header">
				<i class="fa fa-user"></i>
				<h3>Cidade </h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<?php echo $this->load->view("layout/messages"); ?>
				<form id="form_usuario" class="form-horizontal" method="post">
					<fieldset>
						<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">
								×
							</button>
							<strong>Atenção!</strong> Esta ação não poderá ser desfeita.
						</div>
												<div class="control-group">
							<label class="control-label" for="id">id</label>
							<div class="controls">
								<input type="text" disabled="" value="<?php echo set_value("id", $item->id); ?>" class="span4" name="id" id="id">
							</div>
							<!-- /controls -->
						</div>
						<!-- /control-group -->
												<div class="control-group">
							<label class="control-label" for="nome">Nome</label>
							<div class="controls">
								<input type="text" disabled="" value="<?php echo set_value("nome", $item->nome); ?>" class="span4" name="nome" id="nome">
							</div>
							<!-- /controls -->
						</div>
						<!-- /control-group -->
												<div class="control-group">
							<label class="control-label" for="capital">Capital?</label>
							<div class="controls">
								<input type="text" disabled="" value="<?php echo set_value("capital", $item->capital); ?>" class="span4" name="capital" id="capital">
							</div>
							<!-- /controls -->
						</div>
						<!-- /control-group -->
												<div class="control-group">
							<label class="control-label" for="estados_id">Estado</label>
							<div class="controls">
								<input type="text" disabled="" value="<?php echo set_value("estados_id", $item->estados_id); ?>" class="span4" name="estados_id" id="estados_id">
							</div>
							<!-- /controls -->
						</div>
						<!-- /control-group -->
						
						<div class="form-actions">
							<input type="submit" name="submit" class="btn btn-danger" value="Apagar" />
							<a href="<?php echo site_url("cidades")?>" class="btn">
								Cancelar
							</a>
						</div>
						<!-- /form-actions -->
					</fieldset>
				</form>
			</div>
			<!-- /widget-content -->
		</div>
		<!-- /widget -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/cidades/js.js"></script>
	</div>
</div>