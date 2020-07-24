<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li>Cargos</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Cargos</h3>
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
				                    <h4 class="panel-title">Controle de Cargos</h4>
				                    <a href="<?php echo site_url("cargos/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar Cargo </a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<table class="display table">
											<thead>
												<tr>
													<th>Id</th>
													<th>Descrição</th>
																										<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaCargos as $item): ?>
												<tr>
													<td><?php echo $item->id; ?></td>
													<td><?php echo $item->descricao; ?></td>
																										<td class="td-actions">
														<a href="<?php echo site_url("cargos/editar/".$item->id); ?>" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a>
														<a href="<?php echo site_url("cargos/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<div class="paginate">
											<?php echo (isset($paginacao)) ? $paginacao : ''; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/cargos/js.js"></script>