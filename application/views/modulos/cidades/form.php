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
				<?php echo $this->load->view('layout/messages.php'); ?>
				<form id="form_cidades" class="form-horizontal" method="post" action="<?php echo current_url(); ?>">
					<fieldset>
												
						<input name="id" type="hidden" id="id" class="span6" value="<?php echo set_value("id", @$item->id) ?>" />
						
						<!-- /control-group -->
																		
						<div class="control-group">
							<label class="control-label" for="nome">Nome</label>
							<div class="controls">
								<input name="nome" type="text" id="nome" class="span6" value="<?php echo set_value("nome", @$item->nome) ?>" />								
								<?php echo form_error('nome'); ?>
							</div>
							
							<!-- /controls -->
						</div>
						
						<!-- /control-group -->
																		
						<div class="control-group">
							<label class="control-label" for="capital">Capital?</label>
							<div class="controls">
								<input name="capital" type="checkbox" id="capital" value="1" <?php echo set_checked("capital", @$item->capital == "1") ?> />								
								<?php echo form_error('capital'); ?>
							</div>
							
							<!-- /controls -->
						</div>
						
						<!-- /control-group -->
																		
						<div class="control-group">
							<label class="control-label" for="estados_id">Estado</label>
							<div class="controls">
								<?php echo form_dropdown('estados_id',$listaEstados, set_value("estados_id", @$item->estados_id)); ?>								
								<?php echo form_error('estados_id'); ?>
							</div>
							
							<!-- /controls -->
						</div>
						
						<!-- /control-group -->
												
						<div class="form-actions">
							<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
							<a href="<?php echo site_url("cidades"); ?>" class="btn">
								Cancelar
							</a>
						</div>
						<!-- /form-actions -->
					</fieldset>
				</form>
			</div>
			<!-- /widget-content -->
			<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/cidades/js.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/cidades/validate.js"></script>
		</div>
		<!-- /widget -->
	</div>
</div>