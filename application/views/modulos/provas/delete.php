<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("usuarios")?>">Provas</a></li>
        <li>Remover Prova </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Provas</h3>
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
				                    <h4 class="panel-title">Controle de Provas / Remover</h4>
				                    <a href="<?php echo site_url("provas/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view("layout/messages"); ?>
									<form id="form_usuario" class="form-horizontal" method="post">
										<div class="alert alert-danger" role="alert">
					                    	<strong>Atenção!</strong> 
					                    	Esta ação não poderá ser desfeita.
					                	</div>
					                											<div class="form-group">
											<label class="col-sm-2 control-label" for="id">Id</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("id", $item->id); ?>" name="id" id="id">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="descricao">Descri��o</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("descricao", $item->descricao); ?>" name="descricao" id="descricao">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="ano">Ano Prova</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("ano", $item->ano); ?>" name="ano" id="ano">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="bancas_id">Id Banca</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("bancas_id", $item->bancas_id); ?>" name="bancas_id" id="bancas_id">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="instituicoes_id">Id Instituicao</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("instituicoes_id", $item->instituicoes_id); ?>" name="instituicoes_id" id="instituicoes_id">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="cargos_id">Id Cargo</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("cargos_id", $item->cargos_id); ?>" name="cargos_id" id="cargos_id">
											</div>
										</div>
										
										<div class="form-group">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-danger" value="Apagar" />
												<a href="<?php echo site_url("provas")?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
			</div>
			<!-- /widget-content -->
		</div>
		<!-- /widget -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/provas/js.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/provas/validate.js"></script>
	</div>
</div>