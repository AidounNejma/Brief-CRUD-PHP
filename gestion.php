<?php
require_once "inc/header.inc.php";
$prenom = $_SESSION['users']['prenom'];
?>

<h1 class="text-center">Gestion des utilisateurs</h1>

<h2 class="text-center">Bonjour, oh Grand <?= $prenom ?></h2>


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

// -------------------------------------------------------------------

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
<?php if(isset($_GET['action']) && $_GET['action'] == 'modification'): 
    
    $recup =  execute_requete ("SELECT nom,prenom,email,age,sexe,statut,numtel FROM users WHERE id_user = $_GET[id_user]");
    
    $amodifier = $recup->fetch(PDO:: FETCH_ASSOC); 
    
    $nom = $amodifier["nom"];
    $prenom = $amodifier["prenom"];
    $email = $amodifier["email"];
    $numtel = $amodifier["numtel"];
    $sexe = $amodifier["sexe"];
    $age = $amodifier["age"];
    $statut = $amodifier["statut"];

    if ( $_POST){
        execute_requete ("UPDATE users SET
            nom = '$_POST[nom]',
            prenom = '$_POST[prenom]',
            age = '$_POST[age]',
            email = '$_POST[email]',
            numtel = '$_POST[numtel]',
            sexe = '$_POST[sexe]',
            statut = '$_POST[statut]' 
            WHERE id_user='$_GET[id_user]' 
            ");
        header('location:gestion.php');
    }
    
    ?>
    <form method="post">
    <div class='d-flex justify-content-center'>
        <div class='d-flex flex-column bd-highlight mb-3'>

            <label class="text-center">Nom</label>
            <input type="text" name="nom" value="<?= $nom ?>"><br>

            <label class="text-center">Prenom</label>
            <input type="text" name="prenom" value="<?= $prenom ?>"> <br>

            <label class="text-center">Age</label>
            <input type="number" name="age" value="<?= $age ?>"><br>

            <label class="text-center">Email</label>
            <input type="text" name="email" value="<?= $email ?>"><br>

            <label class="text-center">Numero de telephone</label>
            <input type="text" name="numtel" value="<?= $numtel ?>"><br>

                    
            <label>Sexe</label><br>
            <input type="radio" name="sexe" value="Femme" <?php echo ( $sexe == 'Femme') ? 'checked' : ''; ?> > Femme <br>
            <input type="radio" name="sexe" value="Homme" <?php echo ( $sexe == 'Homme') ? 'checked' : ''; ?> > Homme <br>
            <input type="radio" name="sexe" value="Autre" <?php echo ( $sexe == 'Autre') ? 'checked' : ''; ?> > Autre <br><br>
            
            <div>
                <label>Statut</label><br>
                <select name="statut">
                    <option value="0" <?php if( $statut == 0 ) echo 'selected'; ?>  > Membre </option>
                    <option value="1" <?php if( $statut == 1 ) echo 'selected'; ?>  > Admin </option>
                </select><br><br>
            </div>  

            <br>
            <br><br>

            <input type="submit" class="btn btn-secondary" value="Modifier">
            </form>
</div>
</div>

<?php endif ?>

<?= $content; ?>


<?php require_once "inc/footer.inc.php";?>