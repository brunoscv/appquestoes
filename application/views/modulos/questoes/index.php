<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li>Questoes</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Questoes</h3>
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
				                    <h4 class="panel-title">Controle de Questoes da Prova:  
				                    						<?php echo $prova->descricao;?></h4>
				                    <a href="<?php echo site_url("questoes/criar/?prova_id=".$prova->id);?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar Questoe </a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<table class="display table">
											<thead>
												<tr>
													<th>Questão</th>
													<th width="100">Tipo</th>
													<th width="100">Dificuldade</th>
													<th width="120" class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaQuestoes as $item): ?>
												<tr>
													<td>
														<strong><?php echo $item->instituicoes;?> (<?php echo $item->ano ?>)</strong><br />
														<?php echo $item->enunciado; ?>										
													</td>
													<td><?php echo $tipoQuestoes[$item->tipo]; ?></td>
													<td><?php echo $dificuldadeQuestoes[$item->dificuldade]; ?></td>
													<td class="td-actions">
														<a href="<?php echo site_url("questoes/editar/".$item->id."?prova_id=".$item->prova_id); ?>" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a>
														<a href="<?php echo site_url("questoes/delete?questao_id=".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/questoes/js.js"></script>