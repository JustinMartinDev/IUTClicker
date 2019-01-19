<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <title>IUT Clicker</title>
        <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/style.css"/>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
        <link type="text/css" rel="stylesheet" href="css/mdb.min.css"/>
        <link type="text/css" rel="stylesheet" href="libraries/Odometer/css/odometer-theme-train-station.css"/>
    </head>
    <body class="elegant-color white-text">
        <nav class="mb-1 navbar navbar-expand-lg navbar-dark indigo">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-3" aria-controls="navbarSupportedContent-3" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent-3">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link waves-effect waves-light" href="#">Game <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="#">Scoreboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-effect waves-light" href="#">About</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto nav-flex-icons">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> 
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-unique" aria-labelledby="navbarDropdownMenuLink">
                                <?php if(!isset($_COOKIE['userConnected'])) {?>
                                <a class="dropdown-item waves-effect waves-light" href="#">Login</a>
                                <a class="dropdown-item waves-effect waves-light" href="#">Register</a>
                                <?php }else {?>
                                <a class="dropdown-item waves-effect waves-light" href="#">Logout</a>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>