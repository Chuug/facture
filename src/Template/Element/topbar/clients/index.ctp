<div class="text-white">
	<button class="btn btn-lg btn-circle btn-default btn-outline top-menu-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="fa fa-navicon"></i>
	</button>
	<div class="dropdown-menu dropdown-menu-right top-menu-dropdown">
		<?= $this->Html->link('Ajouter un client', ['controller' => 'Clients', 'action' => 'add'], ['class' => 'dropdown-item']) ?>
		<a class="dropdown-item" href="#">Exporter les clients /</a>
	</div>	
</div>