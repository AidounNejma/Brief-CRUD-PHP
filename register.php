<?php
require_once "inc/header.inc.php";
?>

<?php
if ($_POST) {
    if (strlen( $_POST['nom'] ) <= 3 || strlen( $_POST['nom'] ) > 15 ){
        $error .= '<div class="alert alert-danger"> Erreur taille nom (doit etre compris entre 3 et 15 caractères)</div>';
    }
    if (strlen( $_POST['prenom'] ) <= 3 || strlen( $_POST['prenom'] ) > 15 ){
        $error .= '<div class="alert alert-danger"> Erreur taille prenom (doit etre compris entre 3 et 15 caractères)</div>';
    }
    $position_arobase = strpos($_POST['mail'], '@');
    if ($position_arobase === false){
            $error .= '<p>Votre email doit comporter un arobase.</p>';
        }
    if (strlen( $_POST['mdp'] ) <= 3 || strlen( $_POST['mdp'] ) > 15 ){
            $error .= '<div class="alert alert-danger"> Erreur taille Mot de passe (doit etre compris entre 3 et 15 caractères)</div>';
        }

        $_POST['mdp'] = password_hash( $_POST['mdp'] , PASSWORD_DEFAULT );
    
    foreach( $_POST as $indice => $valeur ){

            $_POST[$indice] = htmlentities( addslashes($valeur) );
    }


    }
?>

<h1 class="text-center">INSCRIPTION</h1>
<br>

<?php echo $error; //affichage des messages d'erreur ?>

<?= $content; //afficahge du contenu ?>

<form method="post">
<div class='d-flex justify-content-center'>
<div class='d-flex flex-column bd-highlight mb-3'>

<label class="text-center">Email</label>
    <input type="text" name="mail"><br>
  

    <label class="text-center">Nom</label>
    <input type="text" name="nom"><br>

    <label class="text-center">Prenom</label>
    <input type="text" name="prenom"><br>

    <label class="text-center">Mot de passe</label>
    <input  type="password" name="mdp"><br>   

    <label class="text-center">Email</label>
    <input type="text" name="email"><br>

    <label class="text-center">Civilité</label>
    <div class="d-flex justify-content-center">
    <div class="d-flex now-wrap">
        <input type="radio" name="sexe" value="f" checked >Femme
    </div>
    <br>
    <div class="d-flex now-wrap">
        <input type="radio" name="sexe" value="m" > Homme
    </div>
    <div class="d-flex now-wrap">
        <input type="radio" name="sexe" value="autre" > Autre
    </div>
    </div>
    <br><br>

    <input type="submit" class="btn btn-secondary" value="S'inscrire">

</form>
</div>
</div>


<?php
require_once "inc/footer.inc.php";
?>