<div class="wrapper wrapper-content animated fadeIn faster ml-2">
	<div class="icards">
	<?php foreach($clients as $client): ?>
		<?= $this->element('icards/client', ['client' => $client]) ?>
	<?php endforeach; ?>
	</div>
</div>



