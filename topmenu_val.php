<h1><a href="index.html">Pekiapp</a> by Lost&Find</h1>
<nav id="nav">
	<ul>

		<li <?php switch ($actiu) { case 1: echo 'class="actiu"'; break; }?>><a href="/scripts/webPekiApp/index.php">Inici</a></li>
		<li <?php switch ($actiu) { case 2: echo 'class="actiu"'; break; }?>><a href="/scripts/webPekiApp/lostfind.php">Lost&Find</a></li>
		<li <?php switch ($actiu) { case 3: echo 'class="actiu"'; break; }?>><a href="/scripts/webPekiApp/adopta.php">Adopta</a></li>
		<li <?php switch ($actiu) { case 4: echo 'class="actiu"'; break; }?>>
			<a href="" class="icon fa-angle-down">Serveis</a>
			<ul>
				<li><a href="/scripts/webPekiApp/serveis.php">Perruqueries</a></li>
				<li><a href="/scripts/webPekiApp/serveis.php">Passejadors</a></li>
				<li><a href="/scripts/webPekiApp/serveis.php">Veterinaris</a></li>
				<li><a href="/scripts/webPekiApp/serveis.php">Clubs esportius</a></li>
				<li><a href="/scripts/webPekiApp/serveis.php">Educadors canins</a></li>
				<li><a href="/scripts/webPekiApp/serveis.php">Guarderies caninesr</a></li>
			</ul>
		</li>
		<li <?php switch ($actiu) { case 5: echo 'class="actiu"'; break; }?>><a href="/scripts/webPekiApp/contacte.php">Contacte</a></li>
		<li <?php switch ($actiu) { case 6: echo 'class="actiu"'; break; }?>><a href="/scripts/webPekiApp/mi-cuenta-php">La meva conta</a></li>
	</ul>
</nav>