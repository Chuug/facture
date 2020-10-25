<!DOCTYPE html>
<html lang="fr">
    <head>
        <?= $this->Html->charset() ?>
        <base href="<?= BASE ?>">
        <title><?= $title ?></title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('font-awesome/css/font-awesome.css') ?>
        <?= $this->Html->css('plugins/toastr/toastr.min.css') ?>

        <?= $this->Html->css('animate.css') ?>
        <?= $this->Html->css('style.css') ?>
        <?= $this->Html->css('dashboard.css') ?>
        <?= $this->Html->css('plugins/sweetalert/sweetalert.css') ?>
        
        <?= $this->fetch('styleTop') ?>
    </head>
    <body>
        <div class="popup d-none"><?= $PF ?></div>
        <div id="wrapper">
            <?= $this->element('navigation') ?>
            <div id="page-wrapper" class="gray-bg">
                <div class="row">
                    <?= $this->element('top_bar', ['menu' => $this->element('topbar/'.strtolower($this->request->getParam('controller')).'/'.$this->request->getParam('action'))]) ?>
                </div>               
                <?= $this->fetch('content') ?>
                <div class="footer">
                    <div>
                        <strong>Copyright</strong> &copy; 2019
                    </div>
                </div>
            </div>
        </div>
        <!-- Main scripts -->
        <?= $this->Html->script('jquery-3.4.1.min.js') ?>
        <?= $this->Html->script('popper.min.js') ?>
        <?= $this->Html->script('bootstrap.bundle.min.js') ?>
        <?= $this->Html->script('plugins/metisMenu/jquery.metisMenu.js') ?>
        <?= $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js') ?>
        <?= $this->Html->script('plugins/toastr/toastr.min.js') ?>

        <!-- Custom and plugin scripts -->
        <?= $this->Html->script('inspinia.js') ?>
        <?= $this->Html->script('plugins/pace/pace.min.js') ?>
        <?= $this->Html->script('plugins/sweetalert/sweetalert.min.js') ?>

        <?= $this->Html->script('dashboard.js') ?>
        <?= $this->Html->script('popup.js') ?>
        <?= $this->fetch('scriptBottom') ?>
    </body>
</html>
