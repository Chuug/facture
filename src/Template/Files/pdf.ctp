<div class="white-bg invoice">
	<div class="row">
		<div class="head">
			<span class="titles" style="font-size: 2em;"><?= $formatedType ?> <?= $action['custom_id'] ?></span><br>
			<span class="date"><?= (!is_null($date))?$date:'' ?></span>
		</div>
	</div>
	<div class="row">
		<div class="block">
			<h2 class="titles mb-4">Émetteur</h2>
			<div class="group">
				<div class="left">Votre contact:</div>
				<div class="right"><?= $emetteur[2]['parameter'].' '.$emetteur[1]['parameter'] ?></div>
			</div>
			<div class="group">
				<div class="left">Adresse:</div>
				<div class="right">
					<?= $emetteur[7]['parameter'] ?><br>
					<?= $emetteur[8]['parameter'].' '.$emetteur[9]['parameter'] ?>	
				</div>
			</div>
			<div class="group">
				<div class="left">Pays:</div>
				<div class="right"><?= $emetteur[10]['parameter'] ?></div>
			</div>
			<?php if(!is_null($emetteur[11]['parameter'])): ?>
				<div class="group">
					<div class="left">
						Numéro de téléphone:
					</div>
				</div>
			<?php endif; ?>
			<div class="group">
				<div class="left">Adresse email:</div>
				<div class="right"><?= $emetteur[0]['parameter'] ?></div>
			</div>
		</div>
		<div class="block">
			<h2 class="titles mb-4">Destinataire</h2>
			<div class="group">
				<?php if((!is_null($action['client']) && !is_null($action['client']['compagny'])) || !is_null($action['compagny'])): ?>
				<div class="left">Société:</div>
				<div class="right">
					<?= (!is_null($action['client']) && !is_null($action['client']['compagny']))?$action['client']['compagny']['nom_societe']:$action['compagny']['nom_societe'] ?>	
				</div>
				<?php endif; ?>			
			</div>
			<?php if(!is_null($action['client'])): ?>
			<div class="group">
				<div class="left">Nom:</div>
				<div class="right">
					<?= $action['client']['nom'].' '.$action['client']['prenom'] ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if((!is_null($action['client']['coordonnee']['adresse']) || !is_null($action['client']['coordonnee']['code_postal']) || !is_null($action['client']['coordonnee']['ville'])) || (!is_null($action['compagny']['coordonnee']['adresse']) || !is_null($action['compagny']['coordonnee']['code_postal']) || !is_null($action['compagny']['coordonnee']['ville']))): ?>
			<div class="group">
				<div class="left">Adresse:</div>
				<div class="right">
					<?php if(!is_null($action['client'])): ?>
						<?= (!is_null($action['client']['coordonnee']['adresse']))?$action['client']['coordonnee']['adresse'].'<br>':'' ?>
						<?= (!is_null($action['client']['coordonnee']['code_postal']))?$action['client']['coordonnee']['code_postal']:'' ?>
						<?= (!is_null($action['client']['coordonnee']['ville']))?$action['client']['coordonnee']['ville']:'' ?>
					<?php elseif(!is_null($action['compagny'])): ?>
						<?= (!is_null($action['compagny']['coordonnee']['adresse']))?$action['compagny']['coordonnee']['adresse'].'<br>':'' ?>
						<?= (!is_null($action['compagny']['coordonnee']['code_postal']))?$action['compagny']['coordonnee']['code_postal']:'' ?>
						<?= (!is_null($action['compagny']['coordonnee']['ville']))?$action['compagny']['coordonnee']['ville']:'' ?>						
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if(!is_null($action['client']['coordonnee']['pays']) || !is_null($action['compagny']['coordonnee']['pays']) || !is_null($action['client']['compagny']['coordonnee']['pays'])): ?>
			<div class="group">
				<div class="left">Pays:</div>
				<div class="right">
					<?= (!is_null($action['client']['compagny']['coordonnee']['pays']))?$action['client']['compagny']['coordonnee']['pays']:'' ?>
					<?= (!is_null($action['client']['coordonnee']['pays']) && is_null($action['client']['compagny']))?$action['client']['coordonnee']['pays']:'' ?>
					<?= (!is_null($action['compagny']) && !is_null($action['compagny']['coordonnee']['pays']))?$action['compagny']['coordonnee']['pays']:'' ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if((!is_null($action['client']) && !is_null($action['client']['compagny']) && !is_null($action['client']['compagny']['siren'])) || (!is_null($action['compagny']) && !is_null($action['compagny']['siren']))): ?>
				<div class="group">
					<div class="left">Numéro d'entreprise:</div>
					<div class="right">
						<?= (!is_null($action['client']) && !is_null($action['client']['compagny']) && !is_null($action['client']['compagny']['siren']))?$action['client']['compagny']['siren']:'' ?>
						<?= (!is_null($action['compagny']) && !is_null($action['compagny']['siren']))?$action['compagny']['siren']:'' ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if((!is_null($action['client']) && !is_null($action['client']['compagny']) && !is_null($action['client']['compagny']['code'])) || (!is_null($action['compagny']) && !is_null($action['compagny']['code']))): ?>
				<div class="group">
					<div class="left">Code d'activité:</div>
					<div class="right">
						<?= (!is_null($action['client']) && !is_null($action['client']['compagny']) && !is_null($action['client']['compagny']['code']))?$action['client']['compagny']['code']:'' ?>
						<?= (!is_null($action['compagny']) && !is_null($action['compagny']['code']))?$action['compagny']['code']:'' ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if((!is_null($action['client']) && !is_null($action['client']['compagny']) && !is_null($action['client']['compagny']['tva'])) || (!is_null($action['compagny']) && !is_null($action['compagny']['tva']))): ?>
				<div class="group">
					<div class="left">Numéro de TVA:</div>
					<div class="right">
						<?= (!is_null($action['client']) && !is_null($action['client']['compagny']) && !is_null($action['client']['compagny']['tva']))?$action['client']['compagny']['tva']:'' ?>
						<?= (!is_null($action['compagny']) && !is_null($action['compagny']['tva']))?$action['compagny']['tva']:'' ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if(!is_null($action['client']['coordonnee']['telephone']) || !is_null($action['compagny']['coordonnee']['telephone']) || !is_null($action['client']['compagny']['coordonnee']['telephone'])): ?>
			<div class="group">
				<div class="left">Numéro de téléphone:</div>
				<div class="right">
					<?= (!is_null($action['client']['compagny']['coordonnee']['telephone']))?$action['client']['compagny']['coordonnee']['telephone']:'' ?>
					<?= (!is_null($action['client']['coordonnee']['telephone']) && is_null($action['client']['compagny']))?$action['client']['compagny']['coordonnee']['telephone']:'' ?>
					<?= (!is_null($action['compagny']) && !is_null($action['compagny']['coordonnee']['telephone']))?$action['compagny']['coordonnee']['telephone']:'' ?>
				</div>
			</div>
			<?php endif; ?>
			<?php if((!is_null($action['client']) && !is_null($action['client']['mail']))): ?>
				<div class="group">
					<div class="left">Adresse email</div>
					<div class="right"><?= $action['client']['mail'] ?></div>
				</div>
			<?php endif; ?>
			<?php if(!is_null($action['client']['coordonnee']['website']) || !is_null($action['compagny']['coordonnee']['website']) || !is_null($action['client']['compagny']['coordonnee']['website'])): ?>
			<div class="group">
				<div class="left">Site internet:</div>
				<div class="right">
					<?= (!is_null($action['client']['compagny']['coordonnee']['website']))?$action['client']['compagny']['coordonnee']['website']:'' ?>
					<?= (!is_null($action['client']['coordonnee']['website']) && is_null($action['client']['compagny']))?$action['client']['compagny']['coordonnee']['website']:'' ?>
					<?= (!is_null($action['compagny']) && !is_null($action['compagny']['coordonnee']['website']))?$action['compagny']['coordonnee']['website']:'' ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="row ibox-content responsive border-0 pb-0 pl-0 black">
		<?= $this->Text->autoParagraph($action['text_introduction']) ?>
	</div>
	<div class="row">
		<?= $this->element('actions/detail') ?>
	</div>
	<div class="row">
		<div class="block">
			<h2 class="titles mb-4">Conditions</h2>
			<span class="black">
				<b>Conditions de règlement :</b> <?= $action['pay_conditions'] ?><br>
			</span>
			<span class="black">
				<b>Mode de règlement :</b> <?= $action['pay_type'] ?><br>
			</span>
			<?php if($action['pay_interest'] != "Pas d'intérêts"): ?>
				<span class="black">
					<b>Intérêt de retard : </b> <?= $action['pay_interest'] ?><br>
				</span>		
			<?php endif; ?>
			<?php if(!is_null($action['text_conclusion'])): ?>
				<span class="black">
					<b>Notes :</b><br>
					<?=	$this->Text->autoParagraph($action['text_conclusion']) ?>
				</span>
			<?php endif; ?>
		</div>
		<div class="block">
			<?php if($type == 'devis'): ?>

			<?php elseif($type == 'factures' || $type == 'acomptes'): ?>
				<h2 class="titles mb-4">RIB</h2>
				<b class="m-r">IBAN :</b> hello<?php debug($action); ?><br>
			<?php endif ?>
		</div>
	</div>
	<?php if(!is_null($action['text_conditions'])): ?>
	<div class="breakafter"></div>
	<div class="hello">
		<h2 class="titles mb-4">Conditions générales de vente</h2>
		<p class="text-conditions">
			<?= $this->Text->autoParagraph($action['text_conditions']) ?>
		</p>
	</div>
	<?php endif; ?>
</div>