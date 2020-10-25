<?= $this->element('parameters/topmenu') ?>
<div class="wrapper wrapper-content animated fadeIn faster">
	<div class="row">
		<div class="col-xl-6">
			<div class="ibox">
				<?= $this->Form->create() ?>
					<div class="ibox-title">
						<b>Textes affichés sur les documents</b>
						<input type="submit" value="Enregistrer" class="btn btn-xs btn-primary create pull-right">
					</div>
					<div class="ibox-content">				
							<?= $this->Form->control('introduction',['type' => 'textarea', 'class' => 'form-control mb-3', 'label' => "Texte d'introduction par défaut", 'default' => $texts[0]['parameter']]) ?>
							<?= $this->Form->control('conclusion', ['type' => 'textarea', 'class' => 'form-control mb-3', 'label' => 'Texte de conclusion par défaut', 'default' => $texts[1]['parameter']]) ?>
							<!--
							<?= $this->Form->control('footer',['type' => 'textarea', 'class' => 'form-control mb-3', 'label' => 'Pied de page par défaut', 'default' => $texts[2]['parameter']]) ?>
							-->
							<?= ($subNav == 'devis')?$this->Form->control('conditions',['type' => 'textarea', 'class' => 'form-control mb-3', 'label' => 'Conditions générales de vente par défaut', 'default' => $texts[3]['parameter']]):'' ?>
					</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</div>