<div class="wrapper wrapper-content animated fadeIn faster ml-2">
	<h2 class="titles">Informations</h2>
	<div class="ibox max-wh border-top">
		<div class="ibox-content">
			<?php if(!is_null($client->fonction)): ?>
			<div class="info-item">
				<div class="info-label">
					Fonction :
				</div>
				<div class="info-content">
					<?= $client->fonction ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if(!is_null($client->mail)): ?>
			<div class="info-item">
				<div class="info-label">
					Adresse email :
				</div>
				<div class="info-content">
					<?= $client->mail ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if(!is_null($client->coordonnee->telephone)): ?>
			<div class="info-item">
				<div class="info-label">
					Numéro de téléphone :
				</div>
				<div class="info-content">
					<?= $client->coordonnee->telephone ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if(!is_null($client->compagny)): ?>
			<div class="info-item">
				<div class="info-label">
					Société :
				</div>
				<div class="info-content">
					<?= $client->compagny->nom_societe ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if(is_null($client->compagny)): ?>
				<?php if(!is_null($client->coordonnee->adresse) || !is_null($client->coordonnee->code_postal) || !is_null($client->coordonnee->ville)): ?>
				<div class="info-item">
					<div class="info-label">
						Adresse :
					</div>
					<div class="info-content">
						<?= (!is_null($client->coordonnee->adresse))?$client->coordonnee->adresse."<br>":"" ?>
						<?= (!is_null($client->coordonnee->code_postal))?$client->coordonnee->code_postal:"" ?>
						<?= (!is_null($client->coordonnee->ville))?$client->coordonnee->ville:"" ?>
					</div>
				</div>
				<?php endif; ?>
			<?php else: ?>
				<?php if(!is_null($client->compagny->coordonnee->adresse) || !is_null($client->compagny->coordonnee->code_postal) || !is_null($client->compagny->coordonnee->ville)): ?>
				<div class="info-item">
					<div class="info-label">
						Adresse:
					</div>
					<div class="info-content">
						<?= (!is_null($client->compagny->coordonnee->adresse))?$client->compagny->coordonnee->adresse."<br>":"" ?>
						<?= (!is_null($client->compagny->coordonnee->code_postal))?$client->compagny->coordonnee->code_postal:"" ?>
						<?= (!is_null($client->compagny->coordonnee->ville))?$client->compagny->coordonnee->ville:"" ?>
					</div>
				</div>
				<?php endif; ?>
			<?php endif; ?>
			<?php if(is_null($client->compagny) && !is_null($client->coordonnee->pays)): ?>
				<div class="info-item">
					<div class="info-label">
						Pays :
					</div>
					<div class="info-content">
						<?= $client->coordonnee->pays ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if(!is_null($client->compagny) && !is_null($client->compagny->coordonnee->pays)): ?>
				<div class="info-item">
					<div class="info-label">
						Pays :
					</div>
					<div class="info-content">
						<?= $client->compagny->coordonnee->pays ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if(!is_null($client->compagny) && !is_null($client->compagny->coordonnee->telephone)): ?>
				<div class="info-item">
					<div class="info-label">
						N° de tél. de la société :
					</div>
					<div class="info-content">
						<?= $client->compagny->coordonnee->telephone ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if(is_null($client->compagny) && !is_null($client->coordonnee->website)): ?>
				<div class="info-item">
					<div class="info-label">
						Site internet :
					</div>
					<div class="info-content">
						<?= $client->coordonnee->website ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if(!is_null($client->compagny) && !is_null($client->compagny->coordonnee->website)): ?>
				<div class="info-item">
					<div class="info-label">
						Site internet :
					</div>
					<div class="info-content">
						<?= $client->compagny->coordonnee->website ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if(!is_null($client->langue)): ?>
				<div class="info-item">
					<div class="info-label">
						Langue :
					</div>
					<div class="info-content">
						<?= $client->langue ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if(!is_null($client->note)): ?>
				<div class="info-item">
					<div class="info-label">
						Notes
					</div>
					<div class="info-content">
						<?= $client->note ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8">
			<?php if($devisCount > 0): ?>
				<h2 class="titles">Devis (<?= $devisCount ?>)</h2>
				<?php foreach($actions as $action): ?>
					<?php if($action->a_type == 'devis'): ?>
						<?= $this->element('icards/action',['action' => $action]) ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if($facturesCount > 0): ?>
				<h2 class="titles">Factures (<?= $facturesCount ?>)</h2>
				<?php foreach($actions as $action): ?>
					<?php if($action->a_type == 'factures'): ?>
						<?= $this->element('icards/action',['action' => $action]) ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if($acomptesCount > 0): ?>
				<h2 class="titles">Factures d'acomptes (<?= $acomptesCount ?>)</h2>
				<?php foreach($actions as $action): ?>
					<?php if($action->a_type == 'acomptes'): ?>
						<?= $this->element('icards/action',['action' => $action]) ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if($avoirsCount > 0): ?>
				<h2 class="titles">Avoirs (<?= $avoirsCount ?>)</h2>
				<?php foreach($actions as $action): ?>
					<?php if($action->a_type == 'avoirs'): ?>
						<?= $this->element('icards/action',['action' => $action]) ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>