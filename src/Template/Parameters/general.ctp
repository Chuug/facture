<?= $this->element('parameters/topmenu') ?>
<div class="wrapper wrapper-content animated fadeIn faster">
	<div class="row">
		<div class="col-xl-4">
			<div class="ibox">
			<?= $this->Form->create() ?>
				<div class="ibox-title">
					<b>Préférences générales</b>
					<input type="submit" value="Enregistrer" class="btn btn-xs btn-primary create pull-right">
				</div>
				<div class="ibox-content">
					<div class="form-group">
						<label for="devise">Devise par défaut</label>
						<div class="form-inline">
							<?= $this->Form->select('select.devise',$params['devise'][1],['class' => 'form-control','default' => $params['devise'][0]]) ?>
						</div>
					</div>
					<div class="form-group">
						<label for="articleType">Tva par défaut</label>
						<div class="form-inline">
							<?= $this->Form->select('select.tva',$params['tva'][1],['class' => 'form-control','default' => $params['tva'][0]]) ?>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<?= $this->Form->checkbox('applyTva', ['class' => 'small-checkbox mr-3 pointer','id' => 'applyTva', 'default' => $params['applyTva']]) ?>
							<label for="applyTva" class="pointer">Tva non applicable par défaut</label>	
						</div>
					</div>
					<div class="form-group">
						<label for="tvaApplyText">Texte affiché lorsque la TVA n'est pas applicable</label>
						<?= $this->Form->control('applyTvaText', ['class' => 'form-control','label' => false, 'value' => $applyTvaText['parameter']]) ?>
					</div>
					<div class="form-group">
						<label for="articleType">Type d'article par défaut</label>
						<div class="input-group">
							<?= $this->Form->select('select.articleType',$params['articleType'][1],['class' => 'form-control select','default' => $params['articleType'][0]]) ?>
							<span class="input-group-append">
								<?= $this->Html->link('<i class="fa fa-edit"></i>',['controller' => 'Parameters','action' => 'editParam','articleType'],['class' => 'btn btn-primary', 'escape' => false]) ?>							
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="payCondition">Conditions de règlement par défaut</label>
						<div class="input-group">
							<?= $this->Form->select('select.payCondition',$params['payCondition'][1],['class' => 'form-control select','default' => $params['payCondition'][0]]) ?>
							<span class="input-group-append">
								<?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Parameters', 'action' => 'editParam','payCondition'],['class' => 'btn btn-primary', 'escape' => false]) ?>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="payType">Mode de règlement par défaut</label>
						<div class="input-group">
							<?= $this->Form->select('select.payType',$params['payType'][1],['class' => 'form-control select','default' => $params['payType'][0]]) ?>
							<span class="input-group-append">
								<?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Parameters', 'action' => 'editParam','payType'],['class' => 'btn btn-primary', 'escape' => false]) ?>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="payInterest">Intérêts de retard par défaut</label>
						<div class="input-group">
							<?= $this->Form->select('select.payInterest',$params['payInterest'][1],['class' => 'form-control select','default' => $params['payInterest'][0]]) ?>
							<span class="input-group-append">
								<?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Parameters', 'action' => 'editParam','payInterest'],['class' => 'btn btn-primary', 'escape' => false]) ?>
							</span>
						</div>
					</div>	
				</div>
			<?= $this->Form->end() ?>	
			</div>	
		</div>
	</div>
</div>

