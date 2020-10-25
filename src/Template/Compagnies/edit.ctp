<div class="wrapper wrapper-content animated fadeIn faster ml-2">
	<div class="max-wh ibox">
		<div class="ibox-content">
			<?= $this->Form->create($compagnie,['class' => 'form','id' => 'form']) ?>

			<hr>
			<h3 class="text-center">Informations</h3>
			<hr>

			<div class="form-group">
				<label for="nom_societe">Nom de la société</label>
				<?= $this->Form->input('nom_societe', ['class' => 'form-control', 'id' => 'nom_societe', 'label' => false, 'placeholder' => "Nom de la societé (requis)"]) ?>
			</div>
			<div class="form-group">
				<label for="tva">Numéro de TVA</label>
				<?= $this->Form->input('tva', ['class' => 'form-control', 'id' => 'tva', 'label' => false, 'placeholder' => "Numéro de TVA"]) ?>
			</div>
			<div class="form-group">
				<label for="siren">SIREN, SIRET, ...</label>
				<?= $this->Form->input('siren', ['class' => 'form-control', 'id' => 'siren', 'label' => false, 'placeholder' => 'SIREN, SIRET, ...']) ?>
			</div>
			<div class="form-group">
				<label for="code">Code NAF, NACE, NOGA, ...</label>
				<?= $this->Form->input('code', ['class' => 'form-control', 'id' => 'code', 'label' => false, 'placeholder' => 'Code NAF, NACE, NOGA, ...']) ?>
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
				<?= $this->Form->input('coordonnee.adresse', ['class' => 'form-control', 'id' => 'adresse', 'label' => false, 'placeholder' => 'Adresse']) ?>
			</div>
			<div class="form-group">
				<label for="cpl_adresse">Complément d'adresse</label>
				<?= $this->Form->input('coordonnee.cpl_adresse', ['class' => 'form-control', 'id' => 'cpl_adresse', 'label' => false, 'placeholder' => "Complément d'adresse"]) ?>
			</div>
			<div class="form-group">
				<label for="code_postal">Code postal</label>
				<?= $this->Form->input('coordonnee.code_postal', ['type' => 'text', 'class' => 'form-control', 'id' => 'code_postal', 'label' => false, 'placeholder' => 'Code postal']) ?>
			</div>
			<div class="form-group">
				<label for="ville">Ville</label>
				<?= $this->Form->input('coordonnee.ville', ['class' => 'form-control', 'id' => 'ville', 'label' => false, 'placeholder' => 'Ville']) ?>
			</div>
			<div class="form-group">
				<label for="pays">Pays</label>
				<?= $this->Form->select('coordonnee.pays', $this->Custom->getCountries(), ['class' => 'form-control' ,'id' => 'pays', 'label' => false, 'placeholder' => 'Pays']) ?>
			</div>
			<div class="form-group">
				<label for="website">Site internet</label>
				<?= $this->Form->input('coordonnee.website', ['class' => 'form-control', 'id' => 'website', 'label' => false, 'placeholder' => 'Website']) ?>
			</div>
			<div class="form-group">
				<label for="tel">Numéro de téléphone</label>
				<?= $this->Form->input('coordonnee.telephone', ['class' => 'form-control', 'id' => 'telephone', 'label' => false, 'placeholder' => 'Numéro de téléphone']) ?>
			</div>	
			<input type="submit" value="Sauvegarder" class="btn btn-primary create">	
			<?= $this->Form->end() ?>	
		</div>
	</div>
</div>