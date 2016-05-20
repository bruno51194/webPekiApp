<!DOCTYPE html>
<html>
<head>
    <?php 
        $titol = "Lost&Find";
        $actiu = 4;
        include 'head.php';
    ?>
</head>
<body>
<div id="page-wraper">
    <header id="header">
        <?php include 'topmenu.php';?>  
    </header>

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="serveis.php?tipos=Veterinaris">
                        <div class="card1">
                            <div class="card-header cardheader-centre">
                                Veterinaris
                            </div>
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <img src="images/serveis/veterinari_logo.PNG" class="img-cercle" />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="serveis.php?tipos=Perruqueries">
                        <div class="card1">
                            <div class="card-header cardheader-centre">
                                Perruqueries
                            </div>
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <img src="images/serveis/perruqueria_logo.PNG" class="img-cercle" />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a href="serveis.php?tipos=Passejadors">
                        <div class="card1">
                            <div class="card-header cardheader-centre">
                                Passejadors
                            </div>
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <img src="images/serveis/paseador_logo.PNG" class="img-cercle" />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="serveis.php?tipos=Educadors Canins">
                        <div class="card1">
                            <div class="card-header cardheader-centre">
                                Educació
                            </div>
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <img src="images/serveis/educacio_canina_logo.PNG" class="img-cercle" />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a href="serveis.php?tipos=Clubs Esportius">
                        <div class="card1">
                            <div class="card-header cardheader-centre">
                                Club Esportiu
                            </div>
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <img src="images/serveis/club_esportiu_logo.PNG" class="img-cercle" />
                                </div>
                            </div>                                        
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="serveis.php?tipos=Guarderies Canines">
                        <div class="card1">
                            <div class="card-header cardheader-centre">
                                Residència
                            </div>
                            <div class="card-content">
                                <div class="card-content-inner">
                                    <img src="images/serveis/guarderia_logo.PNG" class="img-cercle" />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section> 
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
    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/jquery.scrollgress.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="assets/js/main.js"></script>
</div>
</body>
</html>
