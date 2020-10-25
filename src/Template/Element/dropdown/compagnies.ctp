<div class="dropdown-menu dropdown-menu-right body-dropdown">
	<?= $this->Html->link('Modifier',['controller' => 'Compagnies','action' => 'edit',$compagnie->id],['class' => 'dropdown-item']) ?>
	<?= $this->Html->link('Supprimer', ['controller' => 'Compagnies', 'action' => 'delete',$compagnie->id],['class' => 'dropdown-item delete-compagny']) ?>
	<div class="dropdown-divider"></div>
	<h6 class="dropdown-header">Pour cette société:</h6>
	<?= $this->Html->link('Créer un client', ['controller' => 'Clients', 'action' => 'add',$compagnie->id],['class' => 'dropdown-item']) ?>
	<?= $this->Html->link('Créer un devis', ['controller' => 'Actions', 'action' => 'add','devis','compagny-'.$compagnie->id],['class' => 'dropdown-item']) ?>
	<?= $this->Html->link('Créer une facture', ['controller' => 'Actions', 'action' => 'add','factures','compagny-'.$compagnie->id],['class' => 'dropdown-item']) ?>
</div>