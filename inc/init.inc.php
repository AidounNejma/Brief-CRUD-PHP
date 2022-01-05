<?php

session_start();

//connexion à la BDD 'my_site'
$pdo = new PDO('mysql:host=localhost; dbname=my_site','root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));

//définition d'une constante qui correspondra à l'url de la racine de notre site
define('URL', "http://localhost/my_site/");

// définition de variables:
$content = '';
$error = '';

//inclusion du fichier fonction.inc.php
require_once "fonction.inc.php";