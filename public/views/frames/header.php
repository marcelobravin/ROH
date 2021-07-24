<header>
	<!-- Menu Desk -->
	<div id="menu-desk">
		<nav class="container-menu">
			<h1><a href="index.php">Ocupação Hospitalar</a></h1>
			<ul>
				<a href="lista.php?modulo=usuario"><li>Usuário</li></a>
				<a href="lista.php?modulo=hospital"><li>Hospitais</li></a>
				<!-- <a href="#"><li>Categorias</li></a> -->
				<a href="metas.php" title="Definir metas"><li>Metas</li></a>
				<a href="resultado.php" title="Preencher metas"><li>Preencher</li></a>
				<a href="relatorio.php" title="Visualizar metas"><li>Relatório</li></a>
			</ul>

			<span><?php echo $_SESSION['user']['login'] ?></span>
			<a href="app/Controller/LogoutController.php">
				<i class="fas fa-power-off"></i>
			</a>
		</nav>
	</div>

	<!-- Menu Mobile -->

	<div id="menu-mobile">
		<nav class="container-menu">
			<h1><a href="index.php">Ocupação Hospitalar</a></h1>
			<label for="ativa_menu"><i class="fas fa-bars"></i></label>
            <input id="ativa_menu" type="checkbox" name="" hidden />
			<ul>
				<a href="lista.php?modulo=usuario"><li>Usuário</li></a>
				<a href="lista.php?modulo=hospital"><li>Hospitais</li></a>
				<!-- <a href="#"><li>Categorias</li></a> -->
				<a href="metas.php" title="Definir metas"><li>Metas</li></a>
				<a href="resultado.php" title="Preencher metas"><li>Preencher</li></a>
				<a href="relatorio.php" title="Visualizar metas"><li>Relatório</li></a>
			</ul>
			<a href="app/Controller/LogoutController.php">
				<i class="fas fa-power-off"></i>
			</a>
		</nav>
	</div>
</header>
