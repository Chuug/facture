<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <base href="<?= BASE ?>">

    <title>Facturation | Connexion</title>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('font-awesome/css/font-awesome.css') ?>
    <?= $this->Html->css('animate.css') ?>
    <?= $this->Html->css('style.css') ?>
</head>
<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeIn">
        <div>
            <div>
                <h1 class="logo-name">FA</h1>
            </div>
            <h2 class="mb-3">Connexion</h2>
            <?= $this->Form->create() ?>
                <div class="form-group">
                    <?= $this->Form->control('mail',['type' => 'email','class' => 'form-control', 'placeholder' => 'Email', 'label' => false, 'required']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('password',['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Mot de passe', 'label' => false, 'required']) ?>
                </div>
                <?= $this->Form->control("Se connecter",['type' => 'submit', 'class' => 'btn btn-primary block full-width m-b']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <!-- Mainly scripts -->
    <?= $this->Html->script('jquery-3.4.1.min.js') ?>
    <?= $this->Html->script('popper.min.js') ?>
    <?= $this->Html->script('bootstrap.bundle.min.js') ?>
</body>
</html>