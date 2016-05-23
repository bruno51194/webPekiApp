﻿<!DOCTYPE html>
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
                                    <img src="images/seveis/veterinari_logo.png" class="img-cercle" />
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
                                    <img src="images/seveis/perruqueria_logo.png" class="img-cercle" />
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
                                    <img src="images/seveis/paseador_logo.png" class="img-cercle" />
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
                                    <img src="images/seveis/educacio_canina_logo.png" class="img-cercle" />
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
                                    <img src="images/seveis/club_esportiu_logo.png" class="img-cercle" />
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
                                    <img src="images/seveis/guarderia_logo.png" class="img-cercle" />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section> 
                <footer id="footer">
                <?php include 'footer.php'; ?>
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
