<div class="top-search-response">
	<?php if(!empty($clients)): ?>
		<div class="category">
			<div class="name">Clients</div>
			<?php foreach($clients as $client): ?>
				<div class="result" id="clients-<?= $client->id ?>">
					<div class="title"><?= $client->nom ?> <?= $client->prenom ?></div>
					<?php if(!is_null($client->compagnies['nom_societe'])): ?>
						<div class="description"><?= $client->compagnies['nom_societe'] ?></div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php if(!empty($compagnies)): ?>
		<div class="category">
			<div class="name">Société</div>
			<?php foreach($compagnies as $compagny): ?>
				<div class="result" id="compagnies-<?= $compagny->id ?>">
					<div class="title"><?= $compagny['nom_societe'] ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	
	<?php if(!empty($actions)): ?>
		<div class="category">
			<div class="name"><?= ucfirst($type) ?></div>
			<?php foreach($actions as $action): ?>
				<?php $name = (!is_null($action['clients']['prenom']))?$action['clients']['prenom'].' '.$action['clients']['nom']:$action['compagnies']['nom_societe'];	?>
				<div class="result" id="action-<?= $type ?>-<?= $action['id'] ?>">
					<div class="title"><?= $action['custom_id'] ?></div>
					<div class="description">
						<?= number_format($action['total_ht'],2,',',' ').' '.$action['devise'] ?> pour <?= $name ?>
					</div>
				</div>
			<?php endforeach; ?>	
		</div>
	<?php endif; ?>

	<!-- EXAMPPLE
    <div class="category">
        <div class="name">Name</div>
        <div class="result">
            <div class="title">result title</div>
            <div class="description">result description</div>
        </div>
        <div class="result">result2</div>
    </div>
	-->
</div>
           