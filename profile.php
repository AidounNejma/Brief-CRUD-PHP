<?php
require_once "inc/header.inc.php"
?>


<?php

    if (!userConnect()) {

        header('location:login.php');
        exit;
    }

    $prenom = $_SESSION['users']['prenom'];

    $content .= "<h3 class='text-center'> Vos informations personnelles :</h3>";

    $content .= "<p class='text-center'>Votre prénom: " . $_SESSION['users']['prenom'] . "</p>";
    $content .= "<p class='text-center'>Votre nom: " . $_SESSION['users']['nom'] . "</p>";
    $content .= "<p class='text-center'>Votre email: " . $_SESSION['users']['email'] . "</p>";
    $content .= "<p class='text-center'>Votre sexe: " . $_SESSION['users']['sexe'] . "</p>";
    $content .= "<p class='text-center'>Votre numero de telephone: " . $_SESSION['users']['numtel'] . "</p>";

?>

    <h1 class="text-center">PROFIL 
    <?php  
        if (adminConnect()) {

            echo "<span class='text-center' style = 'color:tomato'>ADMINISTRATEUR</span>";
        }
    ?>
    </h1>

    <h2 class="text-center">Bonjour, <?= $prenom ?></h2>

    <?= $content; //affichage du contenu ?>

<br><br><br><br><br>












<?php
require_once "inc/footer.inc.php";
?>