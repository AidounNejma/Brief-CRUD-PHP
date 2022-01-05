<?php
require_once "inc/header.inc.php";
$prenom = $_SESSION['users']['prenom'];
?>

<h1 class="text-center">Gestion des utilisateurs</h1>

<h2 class="text-center">Bonjour, oh grande <?= $prenom ?></h2>


<?php

if(!userConnect()){
    
    header ('location:login.php');
    exit; 
}

// -------------------------------------------------------------------
if(!adminConnect()){
    header('location:login.php');
    exit;
}
if(isset($_GET['action'])&& $_GET['action'] == 'suppression'){ 

    execute_requete(" DELETE FROM users WHERE id_user = '$_GET[id_user]' ");
}


$pdostatement = $pdo->query("SELECT id_user, nom, prenom, email, sexe,  statut FROM users ORDER BY id_user DESC ");


echo "<table class ='table table-bordered' cellpadding= '5'>";
echo "<tr>";
if($nombre_users = $pdostatement->rowCount()){
    echo "<p>Il y a ". $nombre_users . " utilisateurs.</p>";
}

$nombre_colonne = $pdostatement->columnCount();
for($i = 0; $i < $nombre_colonne; $i++){
    $info_colonne = $pdostatement->getColumnMeta($i);

        echo  "<th> $info_colonne[name]</th>";
}
    echo  "<th> Suppression </th>";
    echo "<th> Modification </th>";
echo  "</tr>";

while($ligne = $pdostatement->fetch(PDO:: FETCH_ASSOC)){
    
    echo  "<tr>";
    foreach($ligne as $indice => $valeur){
        
        echo "<td> $valeur </td>";
        
    }
    
    echo  '<td class="text-center">
    <a href="?action=suppression&id_user='. $ligne['id_user'] .'" onclick="return( confirm( \' Voulez vous supprimer ce user : ' . $ligne['prenom'] . ' \' ) )" >
                        <i class="far fa-trash-alt"></i> 
                    </a>
                </td>';
    echo  '<td class="text-center">
    <a href="?action=modification&id_user='. $ligne['id_user'].' ">
                        <i class="far fa-edit"></i> 
    </a>
                </td>';

                echo  "</tr>";
}

echo  "</table>";


?>

<?php echo $error; //affichage des erreurs ?>
<?php if(isset($_GET['action']) && ($_GET['action'] == 'ajout'|| $_GET['action'] == 'modification')): ?>
<?= $content;  ?>


<?php
require_once "inc/footer.inc.php";
?>