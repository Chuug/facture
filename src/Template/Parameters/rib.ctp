<?= $this->element('parameters/topmenu') ?>
<div class="wrapper wrapper-content animated fadeIn faster">
	<div class="row">
		<div class="col-xl-6">
			<div class="ibox">
				<div class="ibox-title">
					<b>Comptes bancaires</b>
					<?= $this->Html->link('Ajouter',['action' => 'rib','add'], ['class' => 'btn btn-xs btn-primary create pull-right']) ?>
				</div>
				<div class="ibox-content">
					<?php if(empty($ribs->toArray())): ?>
						<p>Pas de comptes bancaires enregistrés</p>
					<?php else: ?>
						<table class="table">
							<thead>
								<th>IBAN</th>
								<th>BIC</th>			
								<th>Titulaire</th>
								<th>Libellé</th>
							</thead>
							<tbody>
								<?php foreach($ribs as $rib): ?>
									<tr>
										<td><?= $rib->iban ?></td>
										<td><?= $rib->bic ?></td>
										<td><?= $rib->titulaire ?></td>
										<td><?= $rib->libel ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php if($add): ?>
			<div class="col-xl-4">
				<div class="ibox">
					<?= $this->Form->create() ?>
					<div class="ibox-title">
						<b>Ajouter un compte bancaire</b>
						<input type="submit" value="Enregistrer" class="btn btn-xs btn-primary create pull-right">
					</div>
					<div class="ibox-content">						
						<?= $this->Form->control('iban', ['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'IBAN', 'required']) ?>
						<?= $this->Form->control('bic', ['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'BIC', 'required']) ?>
						<?= $this->Form->control('titulaire', ['type' => 'text', 'class' => 'form-control mb-2', 'label' => 'Titulaire', 'required']) ?>
						<?= $this->Form->control('libel', ['type' => 'text', 'class' => 'form-control', 'label' => 'Libellé', 'required']) ?>		
					</div>
					<?= $this->Form->end() ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>