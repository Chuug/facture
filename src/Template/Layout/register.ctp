<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">

    <title>Facturation | Enregistrement</title>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('font-awesome/css/font-awesome.css') ?>
    <?= $this->Html->css('animate.css') ?>
    <?= $this->Html->css('style.css') ?>
</head>
<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeIn">
        <div>
            <h2>Enregistrement de l'utilisateur</h2>
            <?= $this->Form->create() ?>
                <div class="form-group">
                    <?= $this->Form->control('nom',['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nom', 'label' => false, 'required']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('prenom',['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Prénom', 'label' => false, 'required']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('mail',['type' => 'email','class' => 'form-control', 'placeholder' => 'Email', 'label' => false, 'required']) ?>
                </div>
                <h2>Société</h2>
                <div class="form-group">
                    <?= $this->Form->control('compagny',['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nom de la société', 'label' => false, 'required']) ?>
                </div>
                <h2>Adresse de la société</h2>
                <div class="form-group">
                    <?= $this->Form->control('adresse',['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Adresse', 'label' => false, 'required']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('postal',['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Code postal', 'label' => false, 'required']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('ville',['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Ville', 'label' => false, 'required']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('Pays',['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Pays', 'label' => false, 'required']) ?>
                </div>
                <h2>Mot de passe</h2>
                <div class="form-group">
                    <?= $this->Form->control('password',['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Mot de passe', 'label' => false, 'required']) ?>
                </div>
                <?= $this->Form->control("S'enregistrer",['type' => 'submit', 'class' => 'btn btn-primary block full-width m-b']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <!-- Mainly scripts -->
    <?= $this->Html->script('jquery-3.4.1.min.js') ?>
    <?= $this->Html->script('popper.min.js') ?>
    <?= $this->Html->script('bootstrap.bundle.min.js') ?>
</body>
</html>