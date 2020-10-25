<div class="wrapper wrapper-content animated fadeIn faster ml-2">
	<div class="row">
		<div class="col-lg-6">
			<h2 class="titles mt-0">Statistiques</h2>
			<div class="ibox">
				<div class="ibox-content">
					<div class="date h3 mb-3">
						<span class="month"><?= $months[1][1] ?></span> <span class="year"><?= $years[1] ?></span>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="widget navy-bg no-padding">
								<div class="p-m">
									<h1 class="m-xs"><?= $this->Custom->deviseFormat(($bilan['unpaidTot'] - $bilan['avoirTot']),'€') ?></h1>
									<h3 class="font-bold no-margins">
										Chiffre d'affaire
									</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="widget lazur-bg no-padding">
								<div class="p-m">
									<h1 class="m-xs"><?= $this->Custom->deviseFormat($bilan['unpaidTot'],'€') ?></h1>
									<h3 class="font-bold no-margins">
										au total pour <?= $bilan['factureCount'] ?> facture<?= ($bilan['factureCount'] > 1)?'s':'' ?>
									</h3>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="widget lazur-bg no-padding">
								<div class="p-m">
									<h1 class="m-xs"><?= $this->Custom->deviseFormat($bilan['paidTot'],'€') ?></h1>
									<h3 class="font-bold no-margins">
										<?= $bilan['paidFactureCount'] ?> <?= ($bilan['paidFactureCount'] > 1)?'factures payées':'facture payée' ?>
									</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="widget yellow-bg no-padding">
								<div class="p-m">
									<h1 class="m-xs"><?= $this->Custom->deviseFormat($bilan['devisTot'],'€') ?></h1>
									<h3 class="font-bold no-margins">
										au total pour <?= $bilan['devisTotCount'] ?> devis
									</h3>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="widget yellow-bg no-padding">
								<div class="p-m">
									<h1 class="m-xs"><?= $this->Custom->deviseFormat($bilan['devisSignedTot'],'€') ?></h1>
									<h3 class="font-bold no-margins">
										<?= $bilan['devisSignedTotCount'] ?> devis signé<?= ($bilan['devisSignedTotCount'] > 1)?'s':'' ?>
									</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="widget red-bg no-padding">
								<div class="p-m">
									<h2 class="m-xs mb-1"><?= $this->Custom->deviseFormat($bilan['avoirTot'],'€') ?></h2>
									<h4 class="font-bold no-margins">
										<?= $bilan['avoirCount'] ?> avoir<?= ($bilan['avoirCount'] > 1)?'s':'' ?>
									</h4>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="widget red-bg no-padding">
								<div class="p-m">
									<h2 class="m-xs mb-1"><?= $bilan['clientCount'] ?></h2>
									<h4 class="font-bold no-margins">
										Nouveau<?= ($bilan['clientCount'] > 1)?'x':'' ?> client<?= ($bilan['clientCount'] > 1)?'s':'' ?>
									</h4>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="widget red-bg no-padding">
								<div class="p-m">
									<h2 class="m-xs mb-1"><?= $bilan['compagnyCount'] ?></h2>
									<h4 class="font-bold no-margins">
										Nouvelle<?= ($bilan['compagnyCount'] > 1)?'s':'' ?> société<?= ($bilan['compagnyCount'] > 1)?'s':'' ?>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<h2 class="titles">Générer des documents</h2>
			<div class="ibox">
				<div class="ibox-content">
					<?= $this->Form->create() ?>
						<div class="form-inline">
							<span class="font-weight-bold">De</span>
							<?= $this->Form->select('startMonth',$months[0],['class' => 'form-control col-lg-2 mr-1 ml-2','default' => 1]) ?>
							<?= $this->Form->select('startYear',$years[0],['class' => 'form-control col-lg-2 mr-2','default' => $years[1]]) ?>
							<span class="font-weight-bold">à</span>
							<?= $this->Form->select('endMonth',$months[0],['class' => 'form-control col-lg-2 mr-1 ml-2','default' => 12]) ?>
							<?= $this->Form->select('endYear',$years[0],['class' => 'form-control col-lg-2 mr-2','default' => $years[1]]) ?>
							<?= $this->Form->submit('Générer',['class' => 'btn btn-primary','escape' => false]) ?>	
						</div>
					<?= $this->Form->end() ?>		
				</div>
			</div>
		</div>		
	</div>
</div>
