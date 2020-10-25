<div class="card col-xl-12 mr-2 mb-2">		
	<div class="card-body p-1 pt-3">
		<div class="icard-header">
			<div class="icard-heading">
				<?= $this->Html->link((isset($action['custom_id']))?$action['custom_id']:'Provisoire',['controller' => 'Actions','action' => 'view',$action['a_type'],$action->id],['class' => 'font-weight-bold text-dark']) ?> <span class="devis-state"><?= ($action->state > 1)?$this->Custom->getDevisState($action->state):'' ?></span><br>
				<span class="devis-owner">
					<?= (isset($action['compagnie_id']) && is_null($action['client_id']))?$this->Html->link($action['compagny']['nom_societe'],['controller' => 'Compagnies','action' => 'view',$action['compagnie_id']]):$this->Html->link($action['client']['nom'].' '.$action['client']['prenom'],['controller' => 'Clients','action' => 'view',$action['client_id']]).((isset($action['client']['compagny']))?' - '.$this->Html->link($action['client']['compagny']['nom_societe'],['controller' => 'Compagnies','action' => 'view',$action['client']['compagny']['id']]):'') ?>
				</span>
			</div>
			<div class="icard-menu">
				<button class="btn btn-sm btn btn-outline-secondary btn-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="fa fa-navicon"></span>
				</button>
				<?= $this->element('actions/menuDrop', ['action' => $action]) ?>
			</div>
		</div>
		<div class="icard-content pb-3">
			<span title="Montant HT"><span class="fa fa-bank mr-2"></span><?= $this->Custom->deviseFormat((($action['a_type'] != 'acomptes')?$action['amounts']['total_ht_reduced']:$action['amounts']['acompte']),$action['devise']) ?></span>
			<span title="Crée le"><span class="fa fa-clock-o ml-3 mr-2"></span><?= $action['short_nice_created'] ?></span>
			<?php if($action->state == 4): ?>
			<span title="Signé le"><span class="fa fa-calendar-check-o ml-3 mr-2"></span><?= $action['short_nice_signed'] ?></span>
			<?php endif; ?>
			<?php if($action->state == 5): ?>
			<span title="Payée le"><span class="fa fa-calendar-check-o ml-3 mr-2"></span><?= $action['nice_paid'] ?></span>
			<?php endif; ?>
		</div>
	</div>	
</div>
