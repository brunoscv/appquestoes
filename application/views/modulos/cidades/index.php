<div class="row" data-container="all">
	<div class="span4">
		<?php echo $this->load->view('layout/search.php'); ?>
	</div>
	<div class="span8" data-container="main">
		<div class="widget widget-table action-table">
			<div class="widget-header">
				<i class="fa fa-user"></i>
				<h3>Cidade </h3>
				<a href="<?php echo site_url("cidades/criar/");?>" class="btn btn-primary right"> Adicionar </a>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<?php echo $this->load->view("layout/messages"); ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>id</th>
							<th>Nome</th>
							<th>Capital?</th>
							<th>Estado</th>
							<th class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($listaCidades as $item): ?>
						<tr>
							<td><?php echo $item->id; ?></td>
							<td><?php echo $item->nome; ?></td>
							<td><?php echo ($item->capital) ? "Sim" : "Não"; ?></td>
							<td><?php echo $item->estado; ?></td>
							<td class="td-actions"><a href="<?php echo site_url('cidades/editar/'.$item->id); ?>" class="btn btn-small btn-success"><i class="btn-icon-only fa fa-pencil"> </i></a><a href="<?php echo site_url("cidades/delete/".$item->id)?>" class="btn btn-danger btn-small"><i class="btn-icon-only fa fa-times"> </i></a></td>
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