<nav class="navbar navbar-static-top inspi-bg top-nav" role="navigation" style="margin-bottom: 0">

    <ul class="nav">
        <li>
            <div class="navbar-brand top-title"><?= (isset($topBarTitle))?$topBarTitle:'Titre manquant' ?></div>
        </li>
        <?php if($searchBar): ?>
                <div style="position: relative; z-index: 1;">
                    <li>         
                        <input type="text" placeholder="&#xF002;  Rechercher..." class="form-control top-search" name="top-search" id="top-search" style="font-family:Arial, FontAwesome">        
                    </li>
                    <div class="top-search-panel animated faster d-none">
                        <div class="top-search-panel-help">
                            <h4 class="text-center">Affinez votre recherche</h4>
                            <p class="text-muted">Utilisez des mots clés :</p>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">client:</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">societe:</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">devis:</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">factures:</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">acomptes:</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">avoirs:</button>
                            <!--
                            <p class="text-muted mt-2">Utilisez des dates :</p>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">2019</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">19</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">2/19</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">6/4/19</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">06/04/19</button>

                            <p class="text-muted mt-2">Utilisez deux dates pour un résultat comme celles-ci :</p>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">2017 2019</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">17 19</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">2/2017 2/2019</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">2/17 2/19</button>
                            <button class="btn btn-sm btn-primary btn-outline font-weight-bold mb-1 s-val">6/4/2017 6/4/2019</button>
                            -->
                        </div>
                        <div class="top-search-response">
                            <!-- Réponse AJAX -->
                        </div>
                    </div>
                </div>
        <?php endif; ?>
    </ul>
    <ul class="nav navbar-top-links navbar-right">
        <li>
            <?= $menu ?>
        </li>
    </ul>
</nav>