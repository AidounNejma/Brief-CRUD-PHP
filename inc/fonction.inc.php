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

function userConnect(){

    if( !isset( $_SESSION['users'] ) ){ //SI la session/membre N'EXISTE PAS, cela signifie que l'on est pas connecté et donc on renvoie 'false'

        return false;
    }
    else{ //SINON, c'est que session/membre EXISTE et donc que l'on est connecté, on renvoie 'true'

        return true;
    }
}

//---------------------------------------------------------------------
//fonction adminConnect() : SI l'admin est connecté, on renvoie 'true', si on n'est pas connecté, on renvoie 'false'
function adminConnect(){

    if( userConnect() && $_SESSION['users']['statut'] == 1 ){ //SI l'utilisateur est connecté ET QU'il est admin, donc que son staut est égal à 1, on renvoie 'true'

        return true;
    }
    else{ //SINON, c'est que son staut est à zero, on renvoie 'false'

        return false;
    }
}