<!DOCTYPE html>
<html lang="fr">
    <head>
        <?= $this->Html->charset() ?>
        <title>
            Imprimer 
        </title>
        <?= $this->Html->meta('icon') ?>
        <?= $this->Html->css('pdf.css', ['fullBase' => true]) ?>
    </head>
    <body>
        <div class="content">
            <?= $this->fetch('content') ?>
        </div>
    </body>
</html>
