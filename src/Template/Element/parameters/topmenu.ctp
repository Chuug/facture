<div class="row dashboard-header white-bg p-0 ml-0">
	<div class="sub-menu <?= ($subNav == 'general')?'sub-active':'' ?>">
		<?= $this->Html->link('Général', ['controller' => 'Parameters', 'action' => 'general']) ?>
	</div>
	<div class="sub-menu <?= ($subNav == 'users')?'sub-active':'' ?>">
		<?= $this->Html->link('Coordonnées', ['controller' => 'Parameters', 'action' => 'users']) ?>
	</div>	
	<div class="sub-menu <?= ($subNav == 'numerotation')?'sub-active':'' ?>">
		<?= $this->Html->link('Numérotation', ['controller' => 'Parameters', 'action' => 'numerotation']) ?>
	</div>
	<div class="sub-menu <?= ($subNav == 'rib')?'sub-active':'' ?>">
		<?= $this->Html->link('Comptes bancaires', ['controller' => 'Parameters', 'action' => 'rib']) ?>
	</div>
	<div class="sub-menu <?= ($subNav == 'devis')?'sub-active':'' ?>">
			<?= $this->Html->link('Devis', ['controller' => 'Parameters', 'action' => 'actionsTexts','devis']) ?>
	</div>
	<div class="sub-menu <?= ($subNav == 'factures')?'sub-active':'' ?>">
			<?= $this->Html->link('Factures', ['controller' => 'Parameters', 'action' => 'actionsTexts','factures']) ?>
	</div>
	<div class="sub-menu <?= ($subNav == 'avoirs')?'sub-active':'' ?>">
			<?= $this->Html->link('Avoirs', ['controller' => 'Parameters', 'action' => 'actionsTexts','avoirs']) ?>
	</div>
	<div class="sub-menu <?= ($subNav == 'acomptes')?'sub-active':'' ?>">
			<?= $this->Html->link("Factures d'acompte", ['controller' => 'Parameters', 'action' => 'actionsTexts','acomptes']) ?>
	</div>
</div>