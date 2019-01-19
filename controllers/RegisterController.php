<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 14/12/2017
 * Time: 16:20
 */

require_once 'controllers/DBConnection.php';

class RegisterController {
    private $bdd;
    public function __construct() {
        $this->bdd = new DBConnection();
        $this->bdd = $this->bdd->getPDO();
    }

    public function createAccout($user, $pass){
        if($this->checkAccountExist()) echo "already-exist";

        $req_addAccount = $this->bdd->prepare('INSERT INTO Account(user, pass) VALUES (:user, :pass)');
        $req_addAccount->execute(array(
            "user" => $user,
            "pass" => password_hash($pass, PASSWORD_DEFAULT)
        ));

        echo "success";
    }

    private function checkAccountExist($user) {
        $req_checkAccount = $this->bdd->prepare('SELECT id FROM Account WHERE user=:user');
        $req_checkAccount->execute(array(
            "user"=>$user
        ));

        if($req_checkAccount->rowCount()>0) return true;
        else return false;
    }
}

if(isset($_POST['pseudo'])&&isset($_POST['mdp_1'])&&isset($_POST['mdp_2'])&&isset($_POST['cgu'])) {
    $registerController = new RegisterController();

    $pseudo = htmlspecialchars(strip_tags(trim($_POST['pseudo'])));
    $mdp_1 = htmlspecialchars(strip_tags(trim($_POST['mdp_1'])));
    $mdp_2 = htmlspecialchars(strip_tags(trim($_POST['mdp_2'])));
    $cgu = htmlspecialchars(strip_tags(trim($_POST['cgu'])));

    if(!$cgu) echo "cgu-error";
    else if($mdp_1 != $mdp_2) echo "mdp-error";
    else $registerController->createAccout($pseudo, $mdp_1);
}