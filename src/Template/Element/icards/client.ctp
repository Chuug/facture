<div class="icard">		
	<div class="icard-body">
		<div class="icard-header">
			<div class="icard-heading">
				<?= $this->Html->link($client->nom.' '.$client->prenom, ['controller' => 'Clients', 'action' => 'view',$client->id],['class' => 'card-title mb-0 mt-0 h6 text-body']) ?>		
				<div class="mt-0">
					<?= (!is_null($client->compagny))?$this->Html->link($client->compagny->nom_societe,['controller' => 'Compagnies', 'action' => 'view',$client->compagny->id],['class' => 'text-secondary']):'<span class="text-secondary">Particulier</span><br>' ?>
				</div>
			</div>
			<div class="icard-menu">
				<button class="btn btn-sm btn btn-outline-secondary circled-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-navicon"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-right body-dropdown">
					<?= $this->Html->link('Modifier', ['controller' => 'Clients', 'action' => 'edit',$client->id],['class' => 'dropdown-item']) ?>
					<?= $this->Html->link('Supprimer', ['controller' => 'Clients', 'action' => 'delete',$client->id],['class' => 'dropdown-item delete-client']) ?>
					<div class="dropdown-divider"></div>
					<h6 class="dropdown-header">Pour ce client:</h6>
					<?= $this->Html->link('Créer un devis', ['controller' => 'Actions', 'action' => 'add','devis','client-'.$client->id],['class' => 'dropdown-item']) ?>
					<?= $this->Html->link('Créer une facture', ['controller' => 'Actions', 'action' => 'add','factures','client-'.$client->id],['class' => 'dropdown-item']) ?>
				</div>			
			</div>	
		</div>
		<div class="icard-content">
		<?php if(!is_null($client->mail)): ?>
			<div class="icard-item">
				<i class="fa fa-envelope mr-2 mt-1"></i> <?= $client->mail ?>
			</div>
			<?php if(!is_null($client->coordonnee) && !is_null($client->coordonnee->telephone)): ?>
			<div class="icard-item">
				<i class="fa fa-phone mr-2 mt-1"></i> <?= $client->coordonnee->telephone ?>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		</div>
	</div>							
</div>