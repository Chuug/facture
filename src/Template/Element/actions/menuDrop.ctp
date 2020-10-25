<div class="dropdown-menu dropdown-menu-right body-dropdown">
	<?php if($action->state == 1): ?>
		<?= $this->Html->link('Finaliser', ['action' => 'finalize',$action->id],['class' => 'dropdown-item finalize-action', 'type' =>$action->a_type]) ?>
		<?= $this->Html->link('Modifier', ['action' => 'edit',$action->a_type,$action->id],['class' => 'dropdown-item']) ?>
		<?= $this->Html->link('Supprimer', ['action' => 'delete',$action->id],['class' => 'dropdown-item delete-action', 'type' => $action->a_type]) ?>
	<?php elseif($action->state == 2): ?>
		<?= ($type == 'devis')?$this->Html->link('Marquer comme signé', ['action' => 'signed',$action->id],['class' => 'dropdown-item sign-action']):'' ?>
		<?= ($type == 'devis')?$this->Html->link('Marquer comme refusé', ['action' => 'refused',$action->id],['class' => 'dropdown-item refuse-action']):'' ?>
		<?= ($type == 'factures' || $action->a_type == 'acomptes')?$this->Html->link('Marquer comme payée', ['action' => 'paid',$action->id],['class' => 'dropdown-item paid-action']):'' ?>
	<?php elseif($action->state == 3): ?>
		<?= $this->Html->link('Annuler le refus', ['action' => 'refused',$action->id,2],['class' => 'dropdown-item cancel-refuse-action']) ?>
	<?php else: ?>
		<?= $this->Html->link('Annuler la signature', ['action' => 'refused',$action->id,2],['class' => 'dropdown-item cancel-signature']) ?>
	<?php endif; ?>
	<div class="dropdown-divider"></div>
	<?= $this->Html->link('Télécharger', ['controller' => 'Files','action' => 'pdfview',$action->id],['class' => 'dropdown-item','target' => '_blank']) ?>
	<?= ($action->state > 1)?$this->Html->link('Envoyer par email', ['controller' => 'Actions', 'action' => 'email',$action->a_type,$action->id],['class' => 'dropdown-item']):'' ?>

	<?php if($action->a_type != 'acomptes'): ?>
		<div class="dropdown-divider"></div>
		<h6 class="dropdown-header">Pour ce <?= strtolower($action->formated_type) ?>:</h6>
		<?php if($action->state == 4): ?>
		<?= (!$action->acomptes)?$this->Html->link('Créer une facture', ['action' => 'edit','factures',$action->id,'nouveau'],['class' => 'dropdown-item']):'' ?>
		<?= (!$action->factures)?$this->Html->link("Créer une facture d'acompte", ['action' => 'add','acomptes',$action->id] , ['class' => 'dropdown-item']):'' ?>
		<!--<?= (!$action->factures && $solde)?$this->Html->link("Créer une facture de solde", ['action' => 'edit','factures',$action->id,'solde'], ['class' => 'dropdown-item']):'' ?>-->
				<div class="dropdown-divider"></div>
		<?php endif; ?>
		<?= $this->Html->link('Dupliquer '.(($action->a_type == 'devis')?'le':'en').' devis', ['action' => 'edit','devis',$action->id,'dupliquer'], ['class' => 'dropdown-item']) ?>
		<?= $this->Html->link('Dupliquer '.(($action->a_type == 'factures')?'la':'en').' facture', ['action' => 'edit','factures',$action->id,'dupliquer'], ['class' => 'dropdown-item']) ?>
	<?php endif; ?>

</div>