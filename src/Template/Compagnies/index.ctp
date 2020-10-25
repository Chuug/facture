<div class="wrapper wrapper-content animated fadeIn faster ml-2">
	<div class="icards">
		<?php foreach($Compagnies as $compagnie): ?>
			<?php $nbClient = count($compagnie->clients); ?>
			<div class="icard">
				<div class="icard-body">
					<div class="icard-header">
						<div class="icard-heading">
							<?= $this->Html->link($compagnie->nom_societe, ['controller' => 'Compagnies', 'action' => 'view',$compagnie->id],['class' => 'card-title mb-0 mt-0 h4 text-body']) ?>
							<div class="mt-0">
								<?= $nbClient.' client'.(($nbClient > 1)?'s':'') ?>
							</div>
						</div>
						<div class="icard-menu">
							<button class="btn btn-sm btn btn-outline-secondary circled-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-navicon"></i>
							</button>
							<?= $this->element('dropdown/compagnies',['compagnie' => $compagnie]) ?>
						</div>
					</div>
					<div class="icard-content">
					<?php if(!is_null($compagnie->coordonnee)): ?>
						<div class="icard-item">
							<span><i class="fa fa-map-marker mr-2 ml-1"></i></span>
							<?= (!is_null($compagnie->coordonnee->adresse))?$compagnie->coordonnee->adresse.'<br>':'' ?>
							<?= ((!is_null($compagnie->coordonnee->code_postal))?$compagnie->coordonnee->code_postal:'').' '.((!is_null($compagnie->coordonnee->ville))?$compagnie->coordonnee->ville:'').((!is_null($compagnie->coordonnee->code_postal) || !is_null($compagnie->coordonnee->ville))?'<br>':'') ?>
							<?= $compagnie->coordonnee->pays ?>
						</div>
						<?php if(!empty($compagnie->coordonnee->telephone)): ?>
							<div class="icard-item">
								<span><i class="fa fa-phone mr-2 ml-1"></i></span>
								<?= $compagnie->coordonnee->telephone ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
					</div>				
				</div>			
			</div>
		<?php endforeach; ?>
	</div>
</div>
