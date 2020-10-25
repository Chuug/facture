<nav class="navbar-default navbar-static-side nav-shadow nav-facture" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu nav-facture" id="side-menu">
            <li class="nav-header p-1 font-size-lg nav-head profile-element">
                <?= $this->Html->link('Facturation', ['controller' => 'Dashboard', 'action' => 'index'],['style' => 'color:#DFE4ED']) ?>
            </li>
            <li class="logo-element">
                <?= $this->Html->link($this->Html->image('logo.png'),['controller' => 'Dashboard', 'action' => 'index'], ['escape' => false, 'class' => 'p-0']) ?>
            </li>
            <li class="<?= ($navActive == 'clients')?'active':'' ?>">
                <?= $this->Html->link('<i class="fa fa-users"></i> <span class="nav-label">Clients</span>', ['controller' => 'Clients', 'action' => 'index'], ['class' => 'label-nav','escape' => false]) ?>
                <div class="add-nav">
                    <?= $this->Html->link('<i class="fa fa-plus"></i>',['controller' => 'Clients', 'action' => 'add'],['class' => 'btn btn-primary btn-xs add-nav-button','escape' => false]) ?>
                </div>
            </li>
            <li class="<?= ($navActive == 'compagnies')?'active':'' ?>">
                <?= $this->Html->link('<i class="fa fa-building"></i> <span class="nav-label">Societés</span>', ['controller' => 'Compagnies', 'action' => 'index'], ['class' => 'label-nav','escape' => false]) ?>
                <div class="add-nav">
                    <?= $this->Html->link('<i class="fa fa-plus"></i>',['controller' => 'Compagnies', 'action' => 'add'],['class' => 'btn btn-primary btn-xs add-nav-button','escape' => false]) ?>
                </div>
            </li>
            <li class="<?= ($navActive == 'devis')?'active':'' ?>">
                <?= $this->Html->link('<i class="fa fa-shopping-cart"></i> <span class="nav-label">Devis</span>', ['controller' => 'Actions', 'action' => 'index','devis'], ['class' => 'label-nav','escape' => false]) ?>
                <div class="add-nav">
                    <?= $this->Html->link('<i class="fa fa-plus"></i>',['controller' => 'Actions', 'action' => 'add','devis'],['class' => 'btn btn-primary btn-xs add-nav-button','escape' => false]) ?>
                </div>
            </li>
            <li class="<?= ($navActive == 'factures')?'active':'' ?>">
                <?= $this->Html->link('<i class="fa fa-file-text"></i> <span class="nav-label">Factures</span>', ['controller' => 'Actions','action' => 'index','factures'], ['class' => 'label-nav','escape' => false]) ?>
                <div class="add-nav">
                    <?= $this->Html->link('<i class="fa fa-plus"></i>',['controller' => 'Actions', 'action' => 'add','factures'],['class' => 'btn btn-primary btn-xs add-nav-button','escape' => false]) ?>
                </div>
            </li>
            <li class="<?= ($navActive == 'avoirs')?'active':'' ?> mt-0">
                <?= $this->Html->link('<i class="fa fa-file-text"></i> <span class="nav-label">Avoirs</span>', ['controller' => 'Actions','action' => 'index','avoirs'], ['escape' => false, 'class' => 'nav-decal pt-2 pb-2']) ?>
            </li>
            <li class="<?= ($navActive == 'acomptes')?'active':'' ?> mt-0">
                <?= $this->Html->link("<i class='fa fa-file-text'></i> <span class='nav-label'>Factures d'acompte</span>", ['controller' => 'Actions','action' => 'index','acomptes'], ['escape' => false, 'class' => 'nav-decal pt-2 pb-2']) ?>
            </li>
            <li class="<?= ($navActive == 'parameters')?'active':'' ?>">
                <?= $this->Html->link('<i class="fa fa-gear"></i> <span class="nav-label">Paramètres</span>', ['controller' => 'Parameters' ,'action' => 'general'], ['escape' => false]) ?>
            </li>
            <li>
                <?= $this->Html->link('<i class="fa fa-sign-out"></i> <span class="nav-label">Déconnexion</span>', ['controller' => 'Users' ,'action' => 'logout'], ['escape' => false]) ?>
            </li>
        </ul>
    </div>
</nav>


