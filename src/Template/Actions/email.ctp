<div class="wrapper wrapper-content animated fadeIn faster ml-2">
	<div class="row">
		<div class="col-xl-6">
			<div class="ibox">
				<div class="ibox-content">
					<?= $this->Form->create() ?>
					<label for="destinataire">Destinataire</label>
					<?= $this->Form->select('destinataire',$arrayMail,['multiple' => 'true', 'class' => 'form-control select2','required']) ?>
					<label for="objet" class="mt-3">Objet</label>
					<?= $this->Form->control('objet', ['type' => 'text', 'class' => 'form-control', 'label' => false,'default' => 'Votre '.lcfirst($formatedType).' '.$action->custom_id, 'required']) ?>
					<label for="message" class="mt-3">Message</label>
					<textarea name="message" class="form-control" required="required"></textarea>
					<?= $this->Form->submit('Envoyer', ['class' => 'btn btn-primary mt-2']) ?>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->Html->css('plugins/select2/select2.css', ['block' => 'styleTop']) ?>
<?= $this->Html->css('plugins/ladda/ladda-themeless.min.css', ['block' => 'styleTop']) ?>

<?= $this->Html->script('plugins/select2/select2.full.min.js', ['block' => 'scriptBottom']) ?>

<?= $this->Html->script('actions/email',['block' => 'scriptBottom']) ?>