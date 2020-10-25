<div class="row dashboard-header white-bg p-0 ml-0">
	<div class="sub-menu <?= ($subNav == -1)?'sub-active':'' ?>">
			<?= $this->Html->link('Tous', ['controller' => 'Actions', 'action' => 'index',$type]) ?>
	</div>
	<div class="sub-menu <?= ($subNav == 1)?'sub-active':'' ?>">
			<?= $this->Html->link('Provisoires', ['action' => 'index',$type,1]) ?>
	</div>
	<div class="sub-menu <?= ($subNav == 2)?'sub-active':'' ?>">
			<?= $this->Html->link('Finalisés', ['action' => 'index',$type,2]) ?>
	</div>
	<?php if($type == 'devis'): ?>
	<div class="sub-menu <?= ($subNav == 0)?'sub-active':'' ?>">
			<?= $this->Html->link('Refusés', ['action' => 'index',$type,0]) ?>
	</div>
	<div class="sub-menu <?= ($subNav == 4)?'sub-active':'' ?>">
			<?= $this->Html->link("Signés", ['action' => 'index',$type,4]) ?>
	</div>
	<?php endif; ?>
	<?php if($type == 'factures' || $type == 'acomptes'): ?>
	<div class="sub-menu <?= ($subNav == 5)?'sub-active':'' ?>">
			<?= $this->Html->link("Payées", ['action' => 'index',$type,5]) ?>
	</div>
	<?php endif; ?>
</div>
<div class="wrapper wrapper-content animated fadeIn faster">
	<div class="row col-xl-8">
		<?php foreach($actions as $action): ?>
			<?= $this->element('icards/action',['action' => $action]) ?>
		<?php endforeach; ?>
	</div>
</div>