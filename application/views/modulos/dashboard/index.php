                <div class="page-breadcrumb">
                    <ol class="breadcrumb container">
                    	<li><a href="/">Home</a></li>
                        <li>Dashboard</li>
                    </ol>
                </div>
                <div class="page-title">
                    <div class="container">
                        <h3>Dashboard</h3>
                    </div>
                </div>
                <div id="main-wrapper" class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-white">
								<div class="panel-heading">
									<h4 class="panel-title"><i class="fa fa-line-chart"></i> Cadastrados Recentemente</h4>
									<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
								</div>
								<div class="panel-body">
									<canvas id="chart-1" width="420" height="300"></canvas>
									<div class="legenda-div">
										<div class="legenda">
											<div class="cor" style="background-color:rgba(151,187,205,.2);border:2px solid rgba(151,187,205,1);"></div>
											<div class="rotulo">CADASTRADOS</div>
										</div>
										<div class="legenda">
											<div class="cor" style="background-color:rgba(220,220,220,.2);border:2px solid rgba(220,220,220,1);"></div>
											<div class="rotulo">ATUALIZADOS</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                        <div class="col-md-6">
                            <div class="panel panel-white">
								<div class="panel-heading">
									<i class="fa fa-pie-chart"></i> Processos seletivos
								</div>
								<div class="panel-body">
									<canvas id="chart-2" width="420" height="300"></canvas>
									<div class="legenda-div"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-white">
								<div class="panel-heading">
									<i class="fa fa-users"></i> Últimos candidatos cadastrados
								</div>
								<div class="panel-body">
									<?php $i = 0; foreach ($ultimos_candidatos as $candidato) { $i++; ?>
										<div class="box-ultimos" <?php if ($i == 1) { ?> style="border-top: none;" <?php } ?> >
											<div class="picture">
												
												<?php $foto = $candidato->foto ? 
													'../public/data/' . $candidato->foto : 'assets/img/default-user.png'; ?>
												<img src="<?php echo base_url() . $foto; ?>"/>
												
											</div>
											<div class="info">
												<p><b><?php echo $candidato->nome;?></b></p>
												<p><?php echo calculaIdade($candidato->data_nascimento); ?> anos | <?php echo $candidato->email;?></p>
												<a title="Editar candidato" href="<?php echo site_url('candidatos/editar/'.$candidato->id); ?>"><i class="fa fa-pencil"></i></a>
												<a title="Imprimir currículo" href="<?php echo site_url('candidatos/imprimir/'.$candidato->id); ?>" target="_blank"><i class="fa fa-print"></i></a>
											</div>
										</div>
									<? } ?>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-white">
								<div class="panel-heading">
									<i class="fa fa-th-large"></i> Últimos processos seletivos
								</div>
								<div class="panel-body">
									<?php $i = 0; foreach ($ultimos_processos as $processo) { $i++; ?>
										<div class="box-ultimos" <?php if ($i == 1) { ?> style="border-top: none;" <?php } ?> >
											<div class="info-2">
												<p><b>Processo: </b><?php echo $processo->titulo;?></p>
												<p><b>Área de atuação: </b><?php echo $processo->area_atuacao;?> | <b>Cargo: </b><?php echo $processo->cargo;?></p>
												<p><b>Data de início: </b><?php echo date('d/m/Y', strtotime($processo->data_inicio));?> | <b>Data de término: </b><?php echo date('d/m/Y', strtotime($processo->data_termino));?></p>
												<p><b>Número de vagas: </b><?php echo $processo->vagas;?> vagas</p>
												<div style="float:right;">
													<a style="margin-right:8px;" href="<?php echo site_url('processosseletivos/painel/'.$processo->id); ?>" class="btn btn-small btn-primary"><i class="fa fa-bars"></i></a>
													<a href="<?php echo site_url('processosseletivos/editar/'.$processo->id); ?>" class="btn btn-small btn-success"><i class="fa fa-pencil"></i></a>
												</div>
											</div>
										</div>
									<? } ?>
								</div>
							</div>
						</div>
						<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/dashboard/js.js"></script>
					</div>
                </div>