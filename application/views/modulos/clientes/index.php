<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li>Clientes</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Clientes</h3>
    </div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
                	<div class="row">
                		<div class="col-md-4">
                			<?php echo $this->load->view('layout/search.php'); ?>
                		</div>
						<div class="col-md-8" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
				                    <h4 class="panel-title">Clientes</h4>
				                    <a href="<?php echo site_url("clientes/criar/");?>" class="btn btn-primary pull-right"> Adicionar cliente </a>
				                </div>
								<div class="panel-body">
									<?php echo $this->load->view("layout/messages"); ?>
									<div class="table-responsive">
										<table class="display table" style="width: 100%; cellspacing: 0;">
											<thead>
												<tr>
													<th>Nome da empresa</th>
													<th>E-mail</th>
													<th class="td-actions" style="width:150px"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaClientes as $item): ?>
												<tr>
													<td><?php echo $item->nome_empresa; ?></td>
													<td><?php echo $item->email; ?></td>
													<td class="td-actions">
														<a href="<?php echo site_url('usuariosadicionais/index?clientes_id='.$item->id); ?>" class="btn btn-small btn-primary"><i class="btn-icon-only fa fa-user"> </i></a>
														<a href="<?php echo site_url('clientes/editar/'.$item->id); ?>" class="btn btn-small btn-success"><i class="btn-icon-only fa fa-pencil"> </i></a>
														<a href="<?php echo site_url("clientes/delete/".$item->id)?>" class="btn btn-danger btn-small"><i class="btn-icon-only fa fa-remove"> </i></a>
													</td>
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