<?= $this->element('parameters/topmenu') ?>
<div class="wrapper wrapper-content animated fadeIn faster">
	<div class="col-md-8 col-lg-6 col-xl-4">
		<div class="ibox">
			<div class="ibox-title">
				<b><?= $titleParam ?></b>
						<?= $this->Html->link('<span class="fa fa-arrow-left mr-2"></span> Retour',['controller' => 'Parameters', 'action' => 'general'],['class' => 'btn btn-xs btn-primary pull-right','escape' => false]) ?>
			</div>
			<div class="ibox-content">

						<?php foreach ($params as $param): ?>
							<div class="param form-inline mb-1">
								<div style="width:50%"><?= $param['parameter'] ?></div>
								<?= (!$param['bool'])?$this->Html->link('<span class="fa fa-trash"></span>', ['controller' => 'Parameters', 'action' => 'deleteParam',$param['id'],$param['label']],['class' => 'btn btn-xs btn-danger ml-2 pb-2 delete d-none','escape' => false]):'' ?>
							</div>
						<?php endforeach; ?>
						<?= $this->Form->create(null,['class' => 'mt-3']) ?>

							<div class="form-inline">
								<?= $this->Form->input('newParam', ['class' => 'form-control','label' => false, 'required']) ?>
								<?= $this->Form->submit('Ajouter',['class' => 'btn btn-primary ml-1']) ?>
							</div>
						<?= $this->Form->end() ?>

				
			</div>
		</div>		
	</div>
</div>
<?= $this->Html->script('parameters/editParam', ['block' => 'scriptBottom']) ?>