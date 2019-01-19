<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 14/12/2017
 * Time: 16:20
 */
require_once 'DBConnection.php';
class GameController {
    private $userConnected;
    private $bdd;

    public function __construct() {
        $this->bdd= new DBConnection();
        $this->bdd=$this->bdd->getPDO();
    }

    function showUser() {
        $this->userConnected = $_COOKIE['userConnected'];
        $this->setcookieUser();
    }

    function generateGuest(){
        $this->userConnected = "Guest_".substr(uniqid(),7,11);
        $this->addGuestInBdd();
        $this->setcookieUser();
    }

    private function setCookieUser(){
        setcookie("userConnected",$this->userConnected, time()+60*60*24*10);
        echo $this->userConnected;
    }

    private function addGuestInBdd(){
        $req_insertGuest = $this->bdd->prepare('INSERT INTO Classement(user, score, time, lastCo) VALUES (:user, :score, :time, :lastCo)');
        $req_insertGuest->execute(array(
            "user"=>$this->userConnected,
            "score"=>0,
            "time"=>0,
            "lastCo"=>date('d/m/y')
        ));
    }
}