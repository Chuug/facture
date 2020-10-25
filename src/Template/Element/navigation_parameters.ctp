<nav class="col-md-2 d-none d-md-block bg-light sidebar mt-2">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
		<li class="nav-item">
			<?= $this->Html->link('Préférences',['controller' => 'Parameters', 'action' => 'general'],['class' => 'nav-link'.(($navActive == 'general')?' active':'')]) ?>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/">
				<span data-feather="arrow-left"></span> 
				Retour
			</a>
			
		</li>
    </ul>
  </div>
</nav>