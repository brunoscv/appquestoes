		<div class="panel panel-default" data-container="search">
			<div class="panel-heading clearfix">
				<h4 class="panel-title"><i class="fa fa-search"></i>Pesquisa</h4>
			</div>
			<div class="panel-body">
				<form class="form-inline" style="margin-top:10px;" action="<?php echo site_url( strtolower(get_active_class()) ); ?>">
					<div class="form-group">
						<?php echo form_dropdown('filtro_field', $campos, $this->input->get("filtro_field"), 
						'class="form-control m-b-sm"')?>
					</div>
					<div class="input-group m-b-sm">
						<input name="filtro_valor" value="<?php echo $this -> input -> get("filtro_valor"); ?>" placeholder="Digite sua busca" class="form-control" type="text">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
					<div class="form-group">
						<a class="ajax" href="<?php echo site_url( strtolower(get_active_class()) ); ?>"><span class="fa fa-eraser"></span> Limpar Filtro</a>
					</div>
				</form>
			</div>
		</div>