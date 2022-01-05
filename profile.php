<?php 
require_once "inc/header.inc.php"
?>


<?php
if(!userConnect()){
    
    header ('location:login.php');
    exit; 
}

// -------------------------------------------------------------------
if(adminConnect()){
    
    $content.="<h2 style = 'color:tomato'>ADMINISTRATEUR</h2>";
}

$prenom = $_SESSION['users']['prenom'];

$content .= "<h3> Vos informartions personnelles </h3>";

$content .= "<p>Votre prénom: ".$_SESSION['users']['prenom']. "</p>";
$content .= "<p>Votre nom: ".$_SESSION['users']['nom']. "</p>";
$content .= "<p>Votre email: ".$_SESSION['users']['email']. "</p>";
$content .= "<p>Votre sexe: ".$_SESSION['users']['sexe']. "</p>";
$content .= "<p>Votre numero de telephone: ".$_SESSION['users']['numtel']."</p>";

?>

<h1 class="text-center">PROFIL</h1>

<h2 class="text-center">Bonjour, <?= $prenom ?></h2>

<?= $content; //affichage du contenu ?>
<br><br><br><br><br>












<?php
require_once "inc/footer.inc.php";
?>