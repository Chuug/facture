<?= $this->element('parameters/topmenu') ?>

<div class="wrapper wrapper-content animated fadeIn faster">
	<div class="row">
		<div class="col-xl-4">
			<div class="ibox">
				<?= $this->Form->create() ?>
				<div class="ibox-title">
					<b>Format</b>
					<input type="submit" value="Enregistrer" class="btn btn-xs btn-primary create pull-right">
				</div>
				<div class="ibox-content">					
					<?= $this->Form->control('format',['type' => 'text','class' => 'form-control format mb-3','default' => $format->parameter]) ?>
					<?= $this->Form->control('apercu', ['type' => 'text', 'class' => 'form-control example mb-3', 'readonly', 'label' => 'Aperçu pour une facture']) ?>
					<?= $this->Form->control('size', ['type' => 'number', 'class' => 'form-control size', 'label' => 'Taille du compteur','default' => $size->parameter, 'min' => 1, 'max' => 10]) ?>
				</div>
				<?= $this->Form->end() ?>
			</div>
			<div class="ibox">
				<?= $this->Form->create() ?>
				<div class="ibox-title">
					<b>Préfixes</b>
					<input type="submit" value="Enregistrer" class="btn btn-xs btn-primary create pull-right">
				</div>
				<div class="ibox-content">
					<?= $this->Form->control('devis', ['type' => 'text', 'class' => 'form-control mb-3 devis', 'label' => 'Devis','default' => $devis->parameter, 'required']) ?>
					<?= $this->Form->control('factures', ['type' => 'text', 'class' => 'form-control mb-3 factures', 'label' => 'Factures', 'default' => $factures->parameter, 'required']) ?>
					<?= $this->Form->control('avoirs', ['type' => 'text', 'class' => 'form-control mb-3 avoirs', 'label' => 'Avoirs','default' => $avoirs->parameter, 'required']) ?>
					<?= $this->Form->control('acomptes', ['type' => 'text', 'class' => 'form-control acomptes', 'label' => "Factures d'acompte", 'default' => $acomptes->parameter, 'required']) ?>	
				</div>
				<?= $this->Form->end() ?>
			</div>
		</div>	
	</div>
</div>
<?= $this->Html->script('parameters/numerotation', ['block' => 'scriptBottom']) ?>