<div class="row" data-container="all">
	<div class="span4">
		<?php echo $this->load->view('layout/search.php'); ?>
	</div>
	<div class="span8" data-container="main">
		<div class="widget widget-table action-table">
			<div class="widget-header">
				<i class="fa fa-user"></i>
				<h3>Estado </h3>
				<a href="<?php echo site_url("estados/criar/");?>" class="btn btn-primary right"> Adicionar </a>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<?php echo $this->load->view("layout/messages"); ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>c&oacute;digo</th>
							<th>Nome</th>
							<th class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($listaEstados as $item): ?>
						<tr>
							<td><?php echo $item->id; ?></td>
							<td><?php echo $item->nome; ?></td>
							<td class="td-actions"><a href="<?php echo site_url('estados/editar/'.$item->id); ?>" class="btn btn-small btn-success"><i class="btn-icon-only fa fa-pencil"> </i></a><a href="<?php echo site_url("estados/delete/".$item->id)?>" class="btn btn-danger btn-small"><i class="btn-icon-only fa fa-times"> </i></a></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div class="paginate">
					<?php echo (isset($paginacao)) ? $paginacao : ''; ?>
				</div>
			</div>
			<!-- /widget-content -->
		</div>
		<!-- /widget -->
	</div>
</div>
<!-- /row -->