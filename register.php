<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 14/12/2017
 * Time: 16:13
 */

require_once 'includes/header.php';
?>

    <div class="spacing-register container register text-white" id="Register">

        <form id="sendRegisterForm">

            <div class="form-header">
                <h3><i class="fa fa-sign-in prefix"></i> Inscription:</h3>
            </div>

            <div class="container-form">

                <div class="md-form">
                    <i class="fa fa-user prefix"></i>
                    <input type="text" id="form1" name="pseudo" class="form-control" required="">
                    <label for="form1">Pseudo</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-lock prefix"></i>
                    <input type="password" id="form3" name="mdp_1" class="form-control" required="">
                    <label for="form3">Password</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-lock prefix"></i>
                    <input type="password" id="form4" name="mdp_2" class="form-control" required="">
                    <label for="form4">Confirm password</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-file-text-o prefix"></i>
                    <input type="checkbox" id="form5" name="CGU" class="form-control" checked="true">
                    <label for="form5">
                        En vous inscrivant vous acceptez les
                        <a href="cgu.php" onclick="window.open(this.href); return false;">
                            CGU
                        </a>
                    </label>
                </div>

                <div class="text-xs-center">
                    <button type="submit" id="registerSubmit" class="btn btn-register waves-effect waves-light">Register</button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>