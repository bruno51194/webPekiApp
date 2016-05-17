<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<?php 
			$titol = "Adopta";
			$actiu = 3;
			include 'head.php';
			include '_functions/functions.php';

			
			$especie = (isset($_GET['especie']) ? $_GET['especie'] : "");
			$tamany = (isset($_GET['tamany']) ? $_GET['tamany'] : "");
			$sexe = (isset($_GET['sexe']) ? $_GET['sexe'] : "");

			$filtre = ($sexe == "" ? "" : " AND sexo_ANIMALES ='$sexe'");
			$filtre .= ($tamany == "" ? "" : " AND medida_ANIMALES ='$tamany'");
			$filtre .= ($especie == "" ? "" : " AND tipo_ANIMALES ='$especie'");


			function animals($limit, $filtre){
				$conn=conexion();
				$resultado = $conn->query("SELECT * from adopta INNER JOIN animales ON id_ANIMALES = ANIMALES_id_ANIMALES where adopcion_ANIMALES='SI' AND estado_ANIMALES = 'adopcion'" . $filtre . $limit);
				if ($resultado->fetch_assoc()) {
					return $resultado;
				}else{
					return false;
				}

			}

			function countAnimals(){
				$ch = curl_init();  
				curl_setopt($ch, CURLOPT_URL, "http://pekiapp.azurewebsites.net/Slim/api.php/animalesAdopcion");    
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
				$data = json_decode(curl_exec($ch), true);

				curl_close($ch);
				return count($data);
			}

  			$pagina = (isset($_GET['page']) ? $_GET['page'] : 1);
			$resultats_per_pagina= 9;
			$maxAnimals = countAnimals();

			$ultima_pagina= ceil($maxAnimals / $resultats_per_pagina);
  			$pagina=(int)$pagina;
			 
			if($pagina > $ultima_pagina)
			{
			    $pagina = $ultima_pagina;
			}
			 
			if($pagina < 1)
			{
			    $pagina=1;
			}

  			$limit= ' LIMIT '. (($pagina-1) * $resultats_per_pagina) . ',' . $resultats_per_pagina;
echo "SELECT * from adopta INNER JOIN animales ON id_ANIMALES = ANIMALES_id_ANIMALES where adopcion_ANIMALES='SI' AND estado_ANIMALES = 'adopcion'" . $filtre . $limit;
			$animalsAdopcio = animals($limit, $filtre);


			
			  

			  
			
			
		?>

		
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<?php include 'topmenu.php'; ?>
				</header>

			<!-- Main -->
				<section id="main">
					 <div class="container">
						 <div id="filtre" class="col-md-3">
				            <div class="well">
				            <h3>FILTRE</h3>
				            <form>
				            	<h2>Especie</h2>
								  <label for="gosos">
								    <input type="radio" name="especie" id="gosos" value="perro"/>
								    <i></i> <span>Gos</span> </label>
								  <label for="gats">
								    <input type="radio" name="especie" id="gats" value="gato"/>
								    <i></i> <span>Gat</span> </label>

			                	<h2>Tamany</h2>

		                		  <label for="petit">
								    <input type="radio" name="tamany" id="petit" value="petit"/>
								    <i></i> <span>Petit</span> </label>
								  <label for="mitja">
								    <input type="radio" name="tamany" id="mitja" value="mitja"/>
								    <i></i> <span>Mitjà</span> </label>
								  <label for="gran">
								    <input type="radio" name="tamany" id="gran" value="gran"/>
								    <i></i> <span>Gran</span> </label>

							  	<h2>Sexe</h2>
								  <label for="mascle">
								    <input type="radio" name="sexe" id="mascle" value="mascle"/>
								    <i></i> <span>Mascle</span> </label>
								  <label for="femella">
								    <input type="radio" name="sexe" id="femella" value="femella"/>
								    <i></i> <span>Femella</span> </label>
							    <button type="submit" class="button">Filtrar</button>
							    <button class="button" id="netejar_filtre">Netejar</button>
							</form>
				            </div>
				            <img src="images/banner_adopta.png" class="max100" alt="">
			            </div>
			            <div class="col-md-9">
			            <?php if($animalsAdopcio != null):
			            foreach ($animalsAdopcio as $animal): ?>

				            <div class="col-sm-6 col-md-4">
				              <div class="thumbnail">
				                <img src="<?php echo $animal['urlGran_ANIMALES']; ?>" alt="...">
				                <div class="caption centrar-text">
				                  <h3><?php echo $animal['nombre_ANIMALES']; ?></h3>
				                  <p class="text-normal"><strong>Edat:</strong> <?php echo $animal['edad_ANIMALES']; ?></p>
				                  <p class="text-normal"><strong>Sexe:</strong> <?php echo $animal['sexo_ANIMALES']; ?></p>
				                  <p class="text-normal"><strong>Mesura:</strong> <?php echo $animal['medida_ANIMALES']; ?></p>
				                  <p><a href="fitxa.php?animal=<?php echo $animal['id_ANIMALES']; ?>" class="btn btn-warning" role="button">Més informació</a></p>
				                </div>
				              </div>
				            </div>

			            <?php endforeach; ?>
		           		

				            <div class="col-md-12" id="pagination">
			                    <?php 
				                    $nextpage= $pagina+1;
								    $prevpage= $pagina-1;
	     						?>
	     						<ul class="pagination">
	     						<?php
					            	if ($pagina == 1) :
	   				            ?>
					            <li><span>&laquo; Anterior</span></li>
					            <li class="active"><span>1</span></li> 
						        <?php
						            for($i= $pagina+1; $i<= $ultima_pagina ; $i++)
						            	echo '<li><a href="adopta.php?page=' . $i . '"><span>'.$i.'</span></a></li>';
	                
						            if($ultima_pagina > $pagina )
						            {      
						                echo '<li><a href="adopta.php?page=' . $nextpage . '" ><span>Següent &raquo;</span></a></li>';
						            }else{
						                echo '<li class="disabled"><span>Següent &raquo;</span></li>';
									}
	        
						        else:
					        	?>
	            				<li><a href="adopta.php?page=<?php echo $prevpage;?>"><span>&laquo; Anterior</span></a></li>
					            <?php 
					            for($i= 1; $i<= $ultima_pagina ; $i++)
					             {
					                if($pagina == $i)
					                {
					                   echo '<li class="active"><span>'. $i . '</span></li>';
					                }
					                else
					                {
					                   echo '<li><a href="adopta.php?page=' . $i . '" ><span>'. $i . '</span></a></li>';
					                }
					            }
	    
								if($ultima_pagina > $pagina )
					            {      
					                echo '<li><a href="adopta.php?page=' . $nextpage . '" ><span>Següent &raquo;</span></a></li>';
					            }else{
					                echo '<li class="disabled"><span>Següent &raquo;</span></li>';
								}     
							    ?>
							    </ul>
							    </div>
								<?php endif;?>
							</div>
							<?php endif; //sobre si el array animalsAdopcio es null ?>
							<!-- FORMULARI ANINAL EN ADOPCIó -->
							<div class="col-md-12">
								<div class="marge-abaixPlus centrar-text">
											<?php if (isset($_COOKIE['tipo']))
												if($_COOKIE['tipo'] == "protectora"): ?>
								            <button class="btn btn-afegir" id="afegir-animal-adopta">AFEGIR ANIMAL EN ADOPCIO</button>
								    		<?php endif; ?>
								        </div>
								        <div class="col-md-12" id="div-afegir" style="display:none">
								            <h2 class="centrar-text">Animal en adopció</h2>
								            <div class="linea marge-abaixPlus"></div>
								            <div class="col-md-12 centrar-text">
								                <h4 >Informació de l'animal</h4>
								                <form class="form-horizontal" id="form-animalAdopta" name="form-animalAdopta">
								                    <div class="form-group">
								                        <label class="col-sm-1 control-label">Nom:</label>
								                        <div class="col-sm-4 col-sm-offset-1">
								                            <input class="form-control" id="nom" name="nom" placeholder="Nom de l'animal" type="text">
								                        </div>
								                    </div>
								                    <div class="form-group">
								                        <label class="col-sm-1 control-label">Chip:</label>
								                        <div class="col-sm-4 col-sm-offset-1">
								                            <input class="form-control" id="chip" name="chip" placeholder="Chip de l'animal" type="text">
								                        </div>
								                    </div>
								                    <div class="form-group">
								                        <label class="col-sm-1 control-label">Tipo:</label>
								                        <div class="col-sm-4 col-sm-offset-1">
								                            <select class="form-control" id="tipos" name="tipos">
								                                <option value="perro">Gat</option>
								                                <option value="gato">Gos</option>
								                                <option value="especial">Altres</option>
								                            </select>
								                        </div>
								                    </div>
								                    <div class="form-group">
								                        <label class="col-sm-1 control-label">Sexe:</label>
								                        <div class="col-sm-4 col-sm-offset-1">
								                            <select class="form-control" id="sexe" name="sexe">
								                                <option>Mascle</option>
								                                <option>Femella</option>
								                            </select>
								                        </div>
								                    </div>
								                    <div class="form-group">
								                        <label class="col-sm-1 control-label">Tamany:</label>
								                        <div class="col-sm-4 col-sm-offset-1">
								                            <select class="form-control" id="tamany" name="tamany">
								                                <option value="petit">Petit</option>
								                                <option value="mitja">Mitjà</option>
								                                <option value="gran">Gran</option>
								                            </select>
								                        </div>
								                    </div>
								                    <div class="form-group">
								                        <label class="col-sm-1 control-label">Raça:</label>
								                        <div class="col-sm-4 col-sm-offset-1">
								                            <input class="form-control" id="rasa" name="rasa" placeholder="Raça de l'animal" type="text">
								                        </div>
								                    </div>
								                    <div class="form-group">
								                        <label class="col-sm-1 control-label">Edat:</label>
								                        <div class="col-sm-4 col-sm-offset-1">
								                            <input class="form-control" id="edat" name="edat" placeholder="Edat de l'animal" type="text">
								                        </div>
								                    </div>
								                    <div class="form-group">
								                        <label class="col-sm-1 control-label">Color:</label>
								                        <div class="col-sm-4 col-sm-offset-1">
								                            <input class="form-control" id="color" name="color" placeholder="Color de l'animal" type="text">
								                        </div>
								                    </div>
								                    <div class="form-group">
								                        <label class="col-sm-1 control-label">Vacunes:</label>
								                        <div class="col-sm-4 col-sm-offset-1">
								                            <input class="form-control" id="vacunes" name="vacunes" placeholder="Introdueix les vacunes de l'animal" type="text">
								                        </div>
								                    </div>
								                    <div class="form-group">
								                        <label class="col-sm-1 control-label">Descripció:</label>
								                        <div class="col-sm-4 col-sm-offset-1">
								                            <textarea class="form-control" id="descripcio" name="descripcio" placeholder="Afegeix una descripció de com es l'animal" rows="5"></textarea>
								                        </div>
								                    </div>
								                    <div class="form-group">
								                        <label class="col-sm-1 control-label">Foto:</label>
								                        <div class="col-sm-4 col-sm-offset-1">
								                            <input type="file" class="form-control" id="foto" name="foto">
								                        </div>
								                    </div>
								                    
								                <div class="form-group">
								                    <div class="centrar-text marge-abaix">
								                        <button class="btn btn-default" id="enviar-animal" type="submit">Afegir Animal</button>
								                    </div>
								                </div>
								            </form>
								            </div>
								        </div>
							        </div>

				
			            </div> <!-- container -->
  		        </section>      

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->

			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script src="assets/js/adopta.js"></script>

	</body>
</html>