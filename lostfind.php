<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
          html, body { height: 100%; margin: 0; padding: 0; }
        </style>
        <?php 
            $titol = "Lost&Find";
            $actiu = 2;
            include 'head.php';
            include '_functions/functions.php';
        ?>
  </head>
  <body>

<!-- Head -->
    <header id="header">
        <?php include 'topmenu.php';?>   
    </header>

    <?php  
    //obtener latidud a traves de una direccion
    function latitud($direccio){
        
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://maps.googleapis.com/maps/api/geocode/json?address=" . $direccio);    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $data = json_decode(curl_exec($ch),true);  
        
        //print_r($data);
        $latitud = $data['results'][0]['geometry']['location']['lat'];
        //$longitud = $data['results'][0]['geometry']['location']['lng'];
        
        curl_close($ch);
        return $latitud;
    }
    //obtener longitud a traves de una direccion
    function longitud($direccio){
        
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://maps.googleapis.com/maps/api/geocode/json?address=" . $direccio);    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $data = json_decode(curl_exec($ch),true);  
        
        //print_r($data);
        //$latitud = $data['results'][0]['geometry']['location']['lat'];
        $longitud = $data['results'][0]['geometry']['location']['lng'];
        return $longitud;

        curl_close($ch);
    }



    ?>  

    <!-- Google Maps -->
    <div id="map"></div>
    <script type="text/javascript">
        var map;

        function initMap() {
            //Mapa
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 41.5231301, lng: 2.4042101},
                zoom: 12
            });
            
        }
    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhzbq-PRPtTR-tkVSAKZmsTM-wYAm-vBY&callback=initMap">
    </script>
    
    <div class="container">
    <?php if(isset($_COOKIE['tipo']) && $_COOKIE['tipo'] == "normal"): ?>
        <div class="marge-dalt marge-abaixPlus centrar-text">
            <button class="btn btn-afegir" id="afegir-animal-perdut">AFEGIR ANIMAL PERDUT</button>
        </div>
            <div class="col-md-12" id="div-afegir" style="display:none">
            <h2 class="centrar-text">Animal Perdut</h2>
            <div class="linea marge-abaixPlus"></div>
                <h4 >Informació de l'animal</h4>
                <form class="form-horizontal" id="form-animalPerdut" name="form-animalPerdut">
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Nom:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <input class="form-control" id="nom" name="nom" placeholder="Nom de l'animal" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Xip:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <input class="form-control" id="chip" name="chip" placeholder="Chip de l'animal" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Tipus:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <select class="form-control" id="tipos" name="tipos">
                                <option value="gato">Gat</option>
                                <option value="perro">Gos</option>
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
                    <h4>Informació sobre l'última localització de l'animal</h4>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Ciutat:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <input class="form-control" id="ciutat" name="ciutat" placeholder="Última ciutat on s'ha vist l'animal" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Direcció:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <input class="form-control" id="direccio" name="direccio" placeholder="Última direcció on s'ha vist l'animal" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Recompensa:</label>
                        <div class="col-sm-4 col-sm-offset-1">
                            <input class="form-control" id="recompensa" name="recompensa" placeholder="Afegir una recompensa és opcional" type="text">
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
                    <?php if(isset($_COOKIE['id'])): ?>
                    <div class="col-md-1 centrar-text marge-abaix">                   
                        <button class="btn btn-default" id="enviar-animal" type="submit">Afegir Animal</button>
                    <?php else: ?>
                    <div class="col-md-1"><button class="btn btn-default" type="submit" disabled>Afegir Animal</button> </div>

                    <div class="col-md-4 centrar-text marge-abaix">  
                    <p>(Has de <a href="login.php">iniciar sessió</a> o <a href="registre.php">registrar-te</a>)</p>
                    <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
        <?php endif; //si el tipus es usuari normal ?>
        <div class="marge-dalt marge-abaix centrar-text">
            <button class="btn btn-afegir" id="afegir-animal-trobat">LLISTA D'ANIMALS PERDUTS</button>
        </div>
        <div class="col-md-12" id="div-afegir2" style="display:none">
            <table class="table table-striped" id="taula_animals">
                <tr>
                    <th></th>
                    <th><strong>Nom</strong></th>
                    <th><strong>Tipus</strong></th>
                    <th><strong>Sexe</strong></th>
                    <th><strong>Mides</strong></th>
                    <th><strong>Raça</strong></th>
                    <th><strong>Edat</strong></th>
                    <th><strong>Color</strong></th>
                    <th><strong>Vacunes</strong></th>
                    <th></th>
                </tr>
            </table>
        </div>
        </div>
    
    </div>

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



            <script src="assets/js/jquery.dropotron.min.js"></script>
            <script src="assets/js/jquery.scrollgress.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/util.js"></script>
            <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
            <script src="assets/js/main.js"></script>
            <script src="assets/js/lostfind.js"></script>

    </footer>
  </body>
</html>