<?php
	if($action->solde)
	{
		$allAcomptes = 0;
		foreach($acomptes as $acompte)
			$allAcomptes += $acompte['amounts']['acompte_ttc'];
	}
?>
<div class="ibox-content responsive mt-4 border-0 row pl-3 mb-2 pb-0">
	<h2 class="titles">Détail</h2>
	<?php if($type != 'acomptes'): ?>
	<table class="table">
		<thead class="text-left">
			<tr class="border-bottom">
				<th class="pleft">Type</th>
				<th>Description</th>
				<th>Prix unitaire HT</th>
				<th>Quantité</th>
				<th>TVA</th>
				<?php if($reductions): ?>
					<th>Réduction</th>
				<?php endif; ?>
				<th class="text-right pright">Total HT</th>
			</tr>
		</thead>
		<tbody>
		<?php $tva = 0; $total_ht = 0; ?>
		<?php foreach($action['articles'] as $article): ?>
			<tr class="border-bottom">
				<td class="pleft"><?= $article['type'] ?></td>
				<td><?= $article['description'] ?></td>
				<td><?= $this->Custom->deviseFormat($article['ht_price'],$action['devise']) ?></td>
				<td><?= $article['quantity'] ?></td>
				<td><?= (is_null($article['tva']))?'0%':$article['tva'].'%' ?></td>
				<?php if($reductions): ?>
					<td><?= ($article['reduction_param'] == 0)?$article['reduction'].'%':$this->Custom->deviseFormat($article['reduction'],$action['devise']) ?></td>
				<?php endif; ?>
				<td class="text-right pright"><?= $this->Custom->deviseFormat($article['ht_total'],$action['devise']) ?></td>
			</tr>
			<?php 	
				$tvaPercent = $article['tva'];
				$tva += $article['ht_total']*($article['tva']/100);
				$total_ht += $article['ht_total'];					
			?>
		<?php endforeach; ?>
		<?php if($action['a_type'] == 'factures'): ?>
			<?php foreach($action['links'] as $link): ?>
				<?php if($link['a_type'] == 'acomptes'): ?>
				<tr>
					<td colspan="<?= $colspan ?>">Facture d'acompte <b><?= $link['custom_id'] ?></b> du <?= $link['nice_paid'] ?></td>
					<td class="text-right pright">-<?= $this->Custom->deviseFormat($link['amounts']['acompte'],$action['devise']) ?></td>
				</tr>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
			<tr>
				<td colspan="<?= $colspan ?>" class="font-weight-bold tots totst">Total HT</td>
				<td class="tots totst pright"><?= $this->Custom->deviseFormat($total_ht,$action['devise']) ?></td>
			</tr>
			<?php if(!is_null($action['remise_generale'])): ?>
				<tr>
					<td colspan="<?= $colspan ?>" class="font-weight-bold tots">Remise générale (<?= $action['remise_generale'].(($action['remise_generale_param'] == 0)?'%':$action['devise']) ?>)</td>
					<td class="tots pright"><?= $this->Custom->deviseFormat($action['Amounts']['remise_amount'],$action['devise']) ?></td>
				</tr>
				<tr>
					<td colspan="<?= $colspan ?>" class="font-weight-bold tots">Total HT final</td>
					<td class="tots pright"><?= $this->Custom->deviseFormat($total_ht - $action['Amounts']['remise_amount'],$action['devise']) ?></td>
				</tr>
			<?php endif; ?>
			<tr>
				<td colspan="<?= $colspan ?>" class="font-weight-bold tots">TVA</td>
				<td class="tots pright">
					<?php 
					$tvaTot = 0;
					if(is_null($action['remise_generale']))					
						$tvaTot = $tva;
					else
						$tvaTot = (($action['Amounts']['total_ht_reduced'] - $action['Amounts']['remise_amount'])/100)*$tvaPercent;
					?>
					<?= $this->Custom->deviseFormat($tvaTot,$action['devise']) ?>
				</td>
			</tr>
			<tr>
				<td colspan="<?= $colspan ?>" class="font-weight-bold tots">Total TTC</td>
				<?php 
					$total_ttc = 0;
					if(is_null($action['remise_generale']))
						$total_ttc = $total_ht + $tvaTot;
					else
						$total_ttc = ($total_ht - $action['Amounts']['remise_amount'])+$tvaTot;
				?>
				<td class="tots pright"><?= $this->Custom->deviseFormat($total_ttc,$action['devise']) ?></td>
			</tr>
			<?php if($action->solde): ?>
				<tr>
					<td colspan="<?= $colspan ?>" class="font-weight-bold tots">Acompte(s) versé(s)</td>
					<td class="tots pright"><?= $this->Custom->deviseFormat($allAcomptes,$action['devise']) ?></td>
				</tr>
				<tr>
					<td colspan="<?= $colspan ?>" class="font-weight-bold tots">Reste à payer</td>
					<td class="tots pright"><?= $this->Custom->deviseFormat($total_ttc - $allAcomptes,$action['devise']) ?></td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
	<?php else: ?>

		<table class="table table-striped">
			<thead>
				<tr>
					<th style="text-align: left;">Description</th>
					<th class="text-right pright">Total HT</th>							
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="width:90%">Acompte de <?= $action['acompte_montant'].(($action['acompte_montant_param'] == 0)?'%':$action['devise']) ?> pour le devis <?= $devisId ?></td>
					<td class="text-right pright"><?= $action['amounts']['acompte'].' '.$action['devise'] ?></td>
				</tr>
				<tr>
					<td class="font-weight-bold tots totst">Total HT</td>
					<td class="tots totst pright"><?= $this->Custom->deviseFormat($action['amounts']['acompte'],$action['devise']) ?></td>
				</tr>
				<tr>
					<td class="font-weight-bold tots">TVA (<?= $action['acompte_tva'] ?>%)</td>
					<td class="tots pright"><?= $this->Custom->deviseFormat($action['amounts']['acompte']*($action['acompte_tva']/100),$action['devise']) ?></td>
				</tr>
				<tr>
					<td class="font-weight-bold tots">Total TTC</td>
					<td class="tots pright"><?= $this->Custom->deviseFormat(($action['amounts']['acompte']*($action['acompte_tva']/100)) + $action['amounts']['acompte'],$action['devise']) ?></td>
				</tr>
			</tbody>
		</table>
	<?php endif; ?>
</div>
			