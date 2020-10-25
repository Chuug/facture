<div class="text-white">
	<button class="btn btn-lg btn-circle btn-default btn-outline top-menu-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="fa fa-navicon"></i>
	</button>
	<div class="dropdown-menu dropdown-menu-right top-menu-dropdown">
		<?= $this->Html->link('Créer un'.(($type == 'devis' || $type == 'avoirs')?' ':'e ').strtolower($this->Custom->getFormatedType($type)), ['controller' => 'Actions', 'action' => 'add',$type], ['class' => 'dropdown-item']) ?>
		<!--<a class="dropdown-item" href="#">Exporter les <?= strtolower($this->Custom->getFormatedType($type)) ?> /</a>-->
	</div>	
</div>