<!DOCTYPE html>
<html lang="fr">
    <head>
        <?= $this->Html->charset() ?>
        <title>
            Imprimer 
        </title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('font-awesome/css/font-awesome.css') ?>

        <?= $this->Html->css('animate.css') ?>
        <?= $this->Html->css('style.css') ?>
        <?= $this->Html->css('pdf.css') ?>
    </head>
    <body class="white-bg">
	    <div class="wrapper wrapper-content p-xl">
	    	<?= $this->fetch('content') ?>
	    </div>
        <!-- Main scripts -->
        <?= $this->Html->script('jquery-3.4.1.min.js') ?>
        <?= $this->Html->script('popper.min.js') ?>
        <?= $this->Html->script('bootstrap.bundle.min.js') ?>
    </body>
</html>
