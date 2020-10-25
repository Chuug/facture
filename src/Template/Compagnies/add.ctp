<div class="wrapper wrapper-content animated fadeIn faster ml-2">
	<div class="max-wh ibox">
		<div class="ibox-content">
			<?php if(!is_null($id)): ?>
				<h2 class="titles">1. Client</h2>
				<p><span class="h6 mr-2"><?= $client->nom.' '.$client->prenom ?></span></p>
				<h2 class="titles mt-4">2. Création de la société</h2>
			<?php endif; ?>

			<?= $this->Form->create(null,['class' => 'form','id' => 'form']) ?>

			<hr>
			<h3 class="text-center">Informations</h3>
			<hr>

			<div class="form-group">
				<label for="nom_societe">Nom de la société (requis)</label>
				<?= $this->Form->control('nom_societe', ['type' => 'text','class' => 'form-control', 'id' => 'nom_societe', 'label' => false]) ?>
			</div>
			<div class="form-group">
				<label for="tva">Numéro de TVA</label>
				<?= $this->Form->control('tva', ['type' => 'text','class' => 'form-control', 'id' => 'tva', 'label' => false]) ?>
			</div>
			<div class="form-group">
				<label for="siren">SIREN, SIRET, ...</label>
				<?= $this->Form->control('siren', ['type' => 'text','class' => 'form-control', 'id' => 'siren', 'label' => false]) ?>
			</div>
			<div class="form-group">
				<label for="code">Code NAF, NACE, NOGA, ...</label>
				<?= $this->Form->control('code', ['type' => 'text','class' => 'form-control', 'id' => 'code', 'label' => false]) ?>
			</div>
			<div class="form-group">
				<label for="langue">Langue</label>
				<?= $this->Form->select('langue', $this->Custom->getLanguages() ,['class' => 'form-control', 'id' => 'langue']) ?>
			</div>

			<hr>
			<h3 class="text-center">Coordonnées de la société</h3>
			<hr>

			<div class="form-group">
				<label for="adresse">Adresse</label>
				<?= $this->Form->control('coordonnee.adresse', ['type' => 'text','class' => 'form-control', 'id' => 'adresse', 'label' => false]) ?>
			</div>
			<div class="form-group">
				<label for="cpl_adresse">Complément d'adresse</label>
				<?= $this->Form->control('coordonnee.cpl_adresse', ['type' => 'text','class' => 'form-control', 'id' => 'cpl_adresse', 'label' => false]) ?>
			</div>
			<div class="form-group">
				<label for="code_postal">Code postal</label>
				<?= $this->Form->control('coordonnee.code_postal', ['type' => 'text', 'class' => 'form-control', 'id' => 'code_postal', 'label' => false]) ?>
			</div>
			<div class="form-group">
				<label for="ville">Ville</label>
				<?= $this->Form->control('coordonnee.ville', ['type' => 'text','class' => 'form-control', 'id' => 'ville', 'label' => false]) ?>
			</div>
			<div class="form-group">
				<label for="pays">Pays</label>
				<?= $this->Form->select('coordonnee.pays', $this->Custom->getCountries(), ['value' => 'Belgique', 'class' => 'form-control' ,'id' => 'pays', 'label' => false]) ?>
			</div>
			<div class="form-group">
				<label for="website">Site internet</label>
				<?= $this->Form->control('coordonnee.website', ['type' => 'text','class' => 'form-control', 'id' => 'website', 'label' => false]) ?>
			</div>
			<div class="form-group">
				<label for="tel">Numéro de téléphone</label>
				<?= $this->Form->control('coordonnee.telephone', ['type' => 'text','class' => 'form-control', 'id' => 'telephone', 'label' => false]) ?>
			</div>	

			<hr>
			<h3 class="text-center">Lier des clients à cette société</h3>
			<hr>

			<?= $this->Form->select('clients',$Clients,['multiple' => 'multiple', 'class' => 'form-control select-client']) ?>

			<input type="submit" value="Créer la société" class="btn btn-primary create mt-3">	
			<?= $this->Form->end() ?>	
		</div>
	</div>
</div>

<?= $this->Html->css('plugins/select2/select2.css', ['block' => 'styleTop']) ?>
<?= $this->Html->script('plugins/select2/select2.full.min.js', ['block' => 'scriptBottom']) ?>

<?= $this->Html->script('compagnies/add.js',['block' => 'scriptBottom']) ?>
