<?= $this->element('parameters/topmenu') ?>
<div class="wrapper wrapper-content animated fadeIn faster">
	<div class="row">
		<div class="col-xl-4">
			<div class="ibox">
				<?= $this->Form->create() ?>
				<div class="ibox-title">
					<b>Coordonnées de la société</b>
					<input type="submit" value="Enregistrer" class="btn btn-xs btn-primary create pull-right">
				</div>
				<div class="ibox-content">		
					<?= $this->Form->control('mail',['type' => 'email', 'class' => 'form-control mb-2', 'label' => 'Adresse email professionnelle','default' => (isset($labels[0]['parameter']))?$labels[0]['parameter']:$user['mail'], 'required']) ?>
					<?= $this->Form->control('prenom',['type' => 'text', 'class' => 'form-control mb-2', 'label' => "Prénom (requis)", 'default' => (isset($labels[1]['parameter']))?$labels[1]['parameter']:$user['prenom'],'required']) ?>
					<?= $this->Form->control('nom',['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'Nom (requis)', 'required', 'default' => (isset($labels[2]['parameter']))?$labels[2]['parameter']:$user['nom'],'required']) ?>
					<?= $this->Form->control('compagny',['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'Société', 'default' => $labels[3]['parameter']]) ?>
					<?= $this->Form->control('siret',['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'Siret', 'default' => $labels[4]['parameter']]) ?>
					<?= $this->Form->control('code',['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'Code', 'default' => $labels[5]['parameter']]) ?>
					<?= $this->Form->control('tva',['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'Numéro de TVA', 'default' => $labels[6]['parameter']]) ?>
					<?= $this->Form->control('Adresse',['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'Adresse (requis)', 'default' => $labels[7]['parameter'],'required']) ?>
					<?= $this->Form->control('postal',['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'Code postal (requis)', 'default' => $labels[8]['parameter'],'required']) ?>
					<?= $this->Form->control('ville',['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'Ville (requis)', 'default' => $labels[9]['parameter'],'required']) ?>
					<?= $this->Form->control('pays',['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'Pays (requis)', 'default' => $labels[10]['parameter'],'required']) ?>
					<?= $this->Form->control('telephone',['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'Numéro de téléphone', 'default' => $labels[11]['parameter']]) ?>
					<?= $this->Form->control('web',['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'Site internet', 'default' => $labels[12]['parameter']]) ?>
				</div>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</div>