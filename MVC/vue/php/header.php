<header id="header" class="jumbotron">
    <section id="entete" class="row">
        <div id="logo" class="col"> <!--col-sm-offset-4 col-sm-4 col-lg-2-->
            <a href="index.php">
                <img src="../../../img/logo_pta.png" alt="LOGO PTA" class="rounded">
            </a>
        </div>
        <div id="titre" class="col">  <!--col-md-offset-6 col-md-6 col-lg-8-->
            <h2>PTA Tour Planner</h2>
        </div>
    </section>
        <div id="btnAjout" class="row">
            <?php
                require_once('../../controleur/ControleBtn.php');
                ControleBtn::doBtnAjout();
            ?>
        </div>
</header>