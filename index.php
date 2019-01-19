<?php 
    require_once './includes/header.php';
    require_once './controllers/GameController.php';
    $gameController = new GameController();
    ?>
    <div class="row align-content-center">
        <div class="card pink lighten-2 text-center z-depth-2">
            <div class="card-body">
                <p class="white-text mb-0">
                    <?php
                        if(isset($_COOKIE['userConnected'])) $gameController->showUser();
                        else $gameController->generateGuest();
                    ?>
            </div>
        </div>
    </div>
    <div class="row align-content-center">
        <div class="col-lg-4">
            <div class="row justify-content-center">
                <div class="odometer" id="odometer"></div>
            </div>
            <div class="row justify-content-center">
                <img src="./images/IUT.png" class="imageClickable waves-effect" onclick="addUnit()"/>
            </div>
        </div> <!-- col with odometer and image clickable -->

        <div class="col-lg-4">
            <div class="row justify-content-center">
                <div class="card indigo text-center z-depth-2">
                    <div class="card-body">
                        <p class="white-text mb-0"> Generator(s) bought</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center margin-top">
                <canvas id="canvas" class="canvasBought"></canvas>
            </div>
            <div class="row justify-content-center margin-top">
              <button class="badge-danger btn" onclick="resetEnclos()" data-placement="bottom" data-trigger="hover" data-toggle="popover"  data-container="body" data-html="true">Reset l'enclos</button>

                <div id="popover-content" hidden>
                </div>
            </div>
        </div> <!-- bought canvas-->

        <div class="col-lg-4">
            <div id="table" class="table-responsive">
                <table class="table table-responsive table-striped text-center profTable">
                </table>
            </div>
            <button class="badge-danger btn" onclick="save()"><i class="fa fa-save"></i></button>
            <button class="badge-danger btn" onclick="load()"><i class="fas fa-cloud-download-alt"></i></button>
        </div> <!-- buy tab-->
    </div>

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="libraries/BoostrapTable/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="libraries/Odometer/js/odometer.min.js"></script>
    <script type="text/javascript" src="libraries/Lodash/js/lodash.min.js"></script>
    <script type="text/javascript" src="libraries/BoostrapTable/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="js/json2.js"></script>
    <script type="text/javascript" src="js/oXHR.js"></script>
    <script type="text/javascript" src="js/classes/Tileset.js"></script>
    <script type="text/javascript" src="js/classes/Map.js"></script>
    <script type="text/javascript" src="js/classes/Personnage.js"></script>
    <script type="text/javascript" src="js/rpg.js"></script>
    <script type="text/javascript" src="js/myScript.js"></script>

</body>
</html>