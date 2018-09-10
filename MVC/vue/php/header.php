<?php 
require_once('../../controller/ControleConnexion.php');
require_once('../../controller/ControleBtn.php');
?>
<header id="header" class="jumbotron">
    <section id="entete" class="row">
        <div id="logo" class="col"> <!--col-sm-offset-4 col-sm-4 col-lg-2-->
            <a href="index.php">
                <img src="../../img/PTA_2.png" alt="LOGO PTA" class="rounded">
            </a>
        </div>
        <div id="titre" class="col">  <!--col-md-offset-6 col-md-6 col-lg-8-->
            <h2>PTA Tour Planner</h2>
        <p><a href="../../controller/logout.php" class="btn btn-outline-dark">Déconnexion</a></p>

        </div>
    </section>
        <div id="nav">
            <?php ControleBtn::doNav(); ?>
            <?php ControleBtn::doBtnAjout(); ?>
        </div>
</header>