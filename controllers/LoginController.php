<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 14/12/2017
 * Time: 16:20
 */

require_once 'controllers/DBConnection.php';

class LoginController {
    private $bdd;
    public function __construct() {
        $this->bdd = new DBConnection();
        $this->bdd = $this->bdd->getPDO();
    }

    public function loginAccout($user, $pass, $cookie){
        $req_connexion = $this->bdd->prepare("SELECT password FROM Account WHERE user:user");
        $req_connexion->execute(array(
            "user"=>$user
        ));

        if($req_connexion->rowCount()<0) echo "wrong-pseudo";
        else {
            $pass_toVerif = ($req_connexion->fetch())[0];
            if(!password_verify($pass, $pass_toVerif)) echo "wrong_pass";
            else {
                if($cookie) setcookie("userConnected", $user, time()+60*60*24*10);
                echo "success";
            }
        }
    }
}

if(isset($_POST['user'])&&isset($_POST['pass'])&&isset($_POST['Cookie'])){
    $user = htmlspecialchars(strip_tags(trim($_POST['user'])));
    $pass = htmlspecialchars(strip_tags(trim($_POST['pass'])));
    $cookie = htmlspecialchars(strip_tags(trim($_POST['Cookie'])));

    $loginController = new LoginController();
    $loginController->loginAccout($user, $pass, $cookie);
}