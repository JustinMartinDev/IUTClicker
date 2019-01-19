<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 14/12/2017
 * Time: 16:20
 */

class DBConnection {
    private $_bdd;
    function __construct() {
        require ''.$_SERVER['DOCUMENT_ROOT'].'/allComponent/init_bdd.php';
        $DB_name = "IUTClicker";
        try {
            $this->_bdd = new PDO('mysql:host='.$DB_host.';dbname='.$DB_name.';', ''.$DB_user.'', ''.$DB_pass.'', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getPDO(){
        return $this->_bdd;
    }
}