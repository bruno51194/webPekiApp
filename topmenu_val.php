<h1><a href="index.html">Pekiapp</a> by Lost&Find</h1>
<nav id="nav">
	<ul>

		<li <?php switch ($actiu) { case 1: echo 'class="actiu"'; break; }?>><a href="index.php">Inici</a></li>
		<li <?php switch ($actiu) { case 2: echo 'class="actiu"'; break; }?>><a href="lostfind.php">Lost&Find</a></li>
		<li <?php switch ($actiu) { case 3: echo 'class="actiu"'; break; }?>><a href="adopta.php">Adopta</a></li>
		<li <?php switch ($actiu) { case 4: echo 'class="actiu"'; break; }?>>
			<a href="" class="icon fa-angle-down">Serveis</a>
			<ul>
				<li><a href="serveis.php">Perruqueries</a></li>
				<li><a href="serveis.php">Passejadors</a></li>
				<li><a href="serveis.php">Veterinaris</a></li>
				<li><a href="serveis.php">Clubs esportius</a></li>
				<li><a href="serveis.php">Educadors canins</a></li>
				<li><a href="serveis.php">Guarderies caninesr</a></li>
			</ul>
		</li>
		<li <?php switch ($actiu) { case 5: echo 'class="actiu"'; break; }?>><a href="contacte.php">Contacte</a></li>
		<li <?php switch ($actiu) { case 6: echo 'class="actiu"'; break; }?>><a href="mi-cuenta.php">La meva conta</a></li>
	</ul>
</nav>