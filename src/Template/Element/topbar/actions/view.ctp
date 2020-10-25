<div class="btn-top-group">
	<?php if($action->state == 1): ?>
		<?= $this->Html->link(
			'<span class="fa fa-check-square-o fa-2x"></span>', 
			['action' => 'finalize',$action->id],
			['class' => 'btn btn-success btn-top mr-2 finalize-action','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Finaliser', 'type' => $type]) 
		?>
		<?= $this->Html->link(
			'<span class="fa fa-edit fa-2x"></span>',
			['action' => 'edit',$action->a_type,$action->id],
			['class' => 'btn btn-primary btn-top mr-2','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Modifier']) 
		?>
	<?php elseif($action->state == 2): ?>
		<?= ($type == 'devis')?
				$this->Html->link(
				'<span class="fa fa-thumbs-o-up fa-2x"></span>',
				['action' => 'signed',$action->id],
				['class' => 'btn btn-primary btn-top mr-2 sign-action','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Marquer comme signé'])
		:'' ?>
		<?= ($type == 'devis')?
				$this->Html->link(
				'<span class="fa fa-thumbs-o-down fa-2x"></span>',
				['action' => 'refused',$action->id],
				['class' => 'btn btn-warning btn-top mr-2 refuse-action','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Marquer comme refusé'])
		:'' ?>
		<?= ($type == 'factures' || $type == 'acomptes')?
				$this->Html->link(
				'<span class="fa fa-money fa-2x"></span>',
				['action' => 'paid',$action->id],
				['class' => 'btn btn-primary btn-top mr-2 paid-action','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Marquer comme payée'])
		:'' ?>
	<?php elseif($action->state == 3): ?>
		<?= $this->Html->link(
			'<span class="fa fa-reply fa-2x"></span>', 
			['action' => 'refused',$action->id,2],
			['class' => 'btn btn-warning btn-top mr-2 cancel-refuse-devis','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Annuler le refus']) 
		?>
	<?php elseif($action->state == 4): ?>
		<?= $this->Html->link(
			'<span class="fa fa-reply fa-2x"></span>', 
			['action' => 'refused',$action->id,2],
			['class' => 'btn btn-warning btn-top mr-2 cancel-signature','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Annuler la signature']) 
		?>
		<?= (!$action->acomptes)?$this->Html->link(
			'<span class="fa fa-calendar-plus-o fa-2x"></span>', 
			['action' => 'edit','factures',$action->id,'nouveau'],
			['class' => 'btn btn-primary btn-top mr-2','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Créer une facture pour ce devis']):'' 
		?>
		<?= (!$action->factures)?$this->Html->link(
			'<span class="fa fa-calendar-plus-o fa-2x"></span>', 
			['action' => 'add','acomptes',$action->id],
			['class' => 'btn btn-success btn-top mr-2','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => "Créer une facture d'acompte pour ce devis"]):''
		?>
		<?= (!$action->factures && $solde)?$this->Html->link(
			'<span class="fa fa-calendar-plus-o fa-2x"></span>',
			['action' => 'edit','factures',$action->id,'solde'],
			['class' => 'btn btn-info btn-top mr-2','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Créer une facture de solde pour ce devis']):''
		?>
	<?php elseif($action->state == 5): ?>
		<?= $this->Html->link(
			'<span class="fa fa-reply fa-2x"></span>', 
			['action' => 'paid',$action->id,true],
			['class' => 'btn btn-warning btn-top mr-2 cancel-paid','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Annuler le paiement']) 
		?>
	<?php endif; ?>
	<?php if($action->state > 1): ?>
		<?= $this->Html->link(
			'<span class="fa fa-envelope-o fa-2x"></span>', 
			['controller' => 'Actions','action' => 'email',$action->a_type,$action->id],
			['class' => 'btn btn-secondary btn-top mr-2','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Envoyer par email']) 
		?>		
	<?php endif; ?>
		<?= $this->Html->link(
			'<span class="fa fa-cloud-download fa-2x"></span>', 
			['controller' => 'Files','action' => 'pdfview',$action->id],
			['class' => 'btn btn-secondary btn-top mr-2','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Télécharger', 'target' => '_blank']) 
		?>
	<?php if($action->state == 1): ?>
		<?= $this->Html->link(
			'<span class="fa fa-trash-o fa-2x"></span>', 
			['action' => 'delete',$action->id],
			['class' => 'btn btn-danger btn-top delete-action','escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Supprimer', 'type' => $type]) 
		?>
	<?php endif; ?>
</div>
<li class="ml-3">
	<div class="text-white">
		<button class="btn btn-lg btn-circle btn-default btn-outline top-menu-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-navicon"></i>
		</button>
		<?= $this->element('actions/menuDrop', ['action' => $action]) ?>
	</div>
</li>
