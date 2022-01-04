<?php

// fonction qui va me permettre de debug certains endroits de mon code
function debug($arg){
    echo "<div style='background:#fda500; z-index:1000; padding:15px;>";
    
    $trace = debug_backtrace();
    
    echo "<p>Debug demandé dans le fichier : ". $trace[0]['file']. "à la ligne". $trace[0]['line'] ."</p>";

    echo "<pre>";
        print_r($arg);
    echo "</pre>";

    echo "</div>";
}

//fonction pour exécuter les requêtes

function execute_requete($req){
    global $pdo;

    $pdostatement = $pdo->query($req);

    return $pdostatement;
}