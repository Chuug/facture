<div class="wrapper wrapper-content animated fadeIn faster ml-2">
	<h2 class="titles">Informations</h2>
	<div class="ibox max-wh border-top">
		<div class="ibox-content">
			<?php if(!is_null($compagnie->siren)): ?>
			<div class="info-item">
				<div class="info-label">
					Numéro d'entreprise :
				</div>
				<div class="info-content">
					<?= $compagnie->siren ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if(!is_null($compagnie->code)): ?>
			<div class="info-item">
				<div class="info-label">
					Code d'activité :
				</div>
				<div class="info-content">
					<?= $compagnie->code ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if(!is_null($compagnie->tva)): ?>
			<div class="info-item">
				<div class="info-label">
					Numéro de TVA :
				</div>
				<div class="info-content">
					<?= $compagnie->tva ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if(!is_null($compagnie->coordonnee->adresse) || !is_null($compagnie->coordonnee->code_postal) || !is_null($compagnie->coordonnee->ville)): ?>
			<div class="info-item">
				<div class="info-label">
					Adresse :
				</div>
				<div class="info-content">
					<?= (!is_null($compagnie->coordonnee->adresse))?$compagnie->coordonnee->adresse."<br>":"" ?>
					<?= (!is_null($compagnie->coordonnee->code_postal))?$compagnie->coordonnee->code_postal:"" ?>
					<?= (!is_null($compagnie->coordonnee->ville))?$compagnie->coordonnee->ville:"" ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if(!is_null($compagnie->coordonnee->pays)): ?>
			<div class="info-item">
				<div class="info-label">
					Pays :
				</div>
				<div class="info-content">
					<?= $compagnie->coordonnee->pays ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if(!is_null($compagnie->coordonnee->telephone)): ?>
			<div class="info-item">
				<div class="info-label">
					Numéro de téléphone :
				</div>
				<div class="info-content">
					<?= $compagnie->coordonnee->telephone ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if(!is_null($compagnie->coordonnee->website)): ?>
			<div class="info-item">
				<div class="info-label">
					Site internet :
				</div>
				<div class="info-content">
					<?= $compagnie->coordonnee->website ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if(!empty($compagnie->clients)): ?>

		<h2 class="mb-3 titles">Clients <span class="text-secondary font-weight-light">(<?= count($compagnie->clients) ?>)</span></h2>
		<div class="icards">
		<?php foreach($compagnie->clients as $client): ?>
			<?= $this->element('icards/client', ['client' => $client]) ?>
		<?php endforeach; ?>
		</div>
	<?php endif; ?>

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
