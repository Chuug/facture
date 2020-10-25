<div class="wrapper wrapper-content animated fadeIn faster ml-2">
	<div class="max-wh ibox">
		<div class="ibox-content">
			<div class="client-head text-center">
				<div class="client-button clt-solo">
					<div class="client-logo">
						<i class="fa fa-user fa-lg"></i>
					</div>
					<div class="client-type">
						Particulier
					</div>
				</div>

				<div class="client-button ml-4 clt-comp">
					<div class="client-logo">
						<i class="fa fa-building fa-lg"></i>
					</div>
					<div class="client-type">
						Professionnel
					</div>
				</div>
			</div>

			<?= $this->Form->create($client, ['class' => 'form','id' => 'form']) ?>
			<?= $this->Form->input('type', ['class' => 'type d-none', 'value' => null, 'label' => false]) ?>

			<hr>
			<h3 class="text-center">Informations</h3>
			<hr>

			<div class="form-group">
				<label for="email">Adresse email</label>
				<?= $this->Form->input('mail',['class' => 'form-control','id' => 'mail', 'label' => false, 'placeholder' => 'Adresse email']) ?>
			</div>
			<div class="form-group">
				<label for="prenom">Prénom</label>
				<?= $this->Form->input('prenom', ['class' => 'form-control', 'id' => 'prenom', 'label' => false, 'placeholder' => 'Prénom (requis)', 'required']) ?>
			</div>
			<div class="form-group">
				<label for="nom">Nom</label>
				<?= $this->Form->input('nom',['class' => 'form-control','id' => 'nom','label' => false, 'placeholder' => 'Nom (requis)', 'required']) ?>
			</div>
			<div class="form-group">
				<label for="fonction">Fonction</label>
				<?= $this->Form->input('fonction', ['class' => 'form-control' ,'id' => 'fonction', 'label' => false, 'placeholder' => 'Fonction']) ?>
			</div>
			<div class="form-group">
				<label for="langue">Langue</label>
				<?= $this->Form->select('langue', $this->Custom->getLanguages(), ['class' => 'form-control', 'id' => 'langue', 'label' => false]) ?>
			</div>
		
			<hr>
			<h3 class="text-center">Coordonnées du client</h3>
			<hr>

			<div class="form-group particulier-group">
				<label for="adresse">Adresse</label>
				<?= $this->Form->input('coordonnee.adresse', ['class' => 'form-control' ,'id' => 'adresse', 'label' => false, 'placeholder' => 'Adresse']) ?>
			</div>
			<div class="form-group particulier-group">
				<label for="cpl_adresse">Complément d'adresse</label>
				<?= $this->Form->input('coordonnee.cpl_adresse', ['class' => 'form-control', 'id' => 'cpl_adresse' , 'label' => false, 'placeholder' => "Complément d'adresse"]) ?>
			</div>
			<div class="form-group particulier-group">
				<label for="code_postal">Code postal</label>
				<?= $this->Form->input('coordonnee.code_postal', ['class' => 'form-control', 'id' => 'code_postal', 'label' => false, 'placeholder' => "Code postal"]) ?>
			</div>	
			<div class="form-group particulier-group">
				<label for="ville">Ville</label>
				<?= $this->Form->input('coordonnee.ville', ['class' => 'form-control', 'id' => 'ville', 'label' => false, 'placeholder' => 'Ville']) ?>
			</div>
			<div class="form-group particulier-group">
				<label for="pays">Pays</label>
				<?= $this->Form->select('coordonnee.pays', $this->Custom->getCountries(), ['value' => 'Belgique', 'class' => 'form-control' ,'id' => 'pays', 'label' => false]) ?>
			</div>
			<div class="form-group particulier-group">
				<label for="website">Site internet</label>
				<?= $this->Form->input('coordonnee.website', ['class' => 'form-control', 'id' => 'website', 'label' => false, 'placeholder' => 'Site internet']) ?>
			</div>
			<div class="form-group">
				<label for="telephone">Numéro de téléphone</label>
				<?= $this->Form->input('coordonnee.telephone', ['class' => 'form-control', 'id' => 'telephone', 'label' => false, 'placeholder' => 'Numéro de téléphone']) ?>
			</div>


			<div class="societe-group mb-3">
				<hr>	
				<h3 class="text-center">Société</h3>
				<hr>
				<?= $this->Form->select('compagny.id', $this->Custom->getCompagnies() , ['empty' => 'Sélectionner une société', 'class' => 'form-control', 'id' => 'compagnie_id', 'label' => false]) ?>
			</div>

			<hr>
			<h3 class="text-center">Notes</h3>
			<hr>
			<div class="form-group">
				<?= $this->Form->textarea('note', ['class' => 'form-control', 'id' => 'note', 'label' => false]) ?>
			</div>
			<input type="submit" value="Enregister les modifications" class="btn btn-primary create">
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>


<?= $this->Html->script('clients/edit', ['block' => 'scriptBottom']) ?>
<?= $this->Html->script('clients/add', ['block' => 'scriptBottom']) ?>