<h1><a href="index.php">Pekiapp</a> by Lost&Find</h1>
<nav id="nav">
	<ul>

		<li <?php switch ($actiu) { case 1: echo 'class="actiu"'; break; }?>><a href="index.php">Inici</a></li>
		<li <?php switch ($actiu) { case 2: echo 'class="actiu"'; break; }?>><a href="lostfind.php">Lost&Find</a></li>
		<li <?php switch ($actiu) { case 3: echo 'class="actiu"'; break; }?>><a href="adopta.php">Adopta</a></li>
		<li <?php switch ($actiu) { case 4: echo 'class="actiu"'; break; }?>>
			<a href="" class="icon fa-angle-down">Serveis</a>
			<ul>
				<li><a href="serveis.php?tipos=Perruqueries">Perruqueries</a></li>
				<li><a href="serveis.php?tipos=Passejadors">Passejadors</a></li>
				<li><a href="serveis.php?tipos=Veterinaris">Veterinaris</a></li>
				<li><a href="serveis.php?tipos=Clubs Esportius">Clubs esportius</a></li>
				<li><a href="serveis.php?tipos=Educadors Canins">Educadors canins</a></li>
				<li><a href="serveis.php?tipos=Guarderies Canines">Guarderies canines</a></li>
			</ul>
		</li>

		<li <?php switch ($actiu) { case 5: echo 'class="actiu"'; break; }?>><a href="contacte.php">Contacte</a></li>

		<?php if(!isset($_COOKIE['id'])): ?>
			<li><a class="button" href="login.php">Accedeix</a></li>
		<?php else: ?>
			<li <?php switch ($actiu) { case 6: echo 'class="actiu"'; break; }?>><a href="miCuenta.php">El meu compte</a></li>
		<?php endif; ?>
	</ul>
</nav>