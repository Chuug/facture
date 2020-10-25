<div class="text-white">
	<button class="btn btn-lg btn-circle btn-default btn-outline top-menu-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="fa fa-navicon"></i>
	</button>
	<div class="dropdown-menu dropdown-menu-right top-menu-dropdown">
		<?= $this->Html->link('Modifier', ['controller' => 'Clients', 'action' => 'edit', $client->id],['class' => 'dropdown-item']) ?>
		<?= $this->Html->link('Supprimer', ['controller' => 'Clients', 'action' => 'delete', $client->id],['class' => 'dropdown-item delete-client']) ?>
		<div class="dropdown-divider"></div>
		<h6 class="dropdown-header">Pour ce client:</h6>
		<?= $this->Html->link('Créer un devis', ['controller' => 'Actions', 'action' => 'add','devis','client-'.$client->id],['class' => 'dropdown-item']) ?>
		<?= $this->Html->link('Créer une facture', ['controller' => 'Actions', 'action' => 'add','factures','client-'.$client->id],['class' => 'dropdown-item']) ?>
	</div>	
</div>