<?php
require_once "inc/header.inc.php";
?>

<?php
if ($_POST) {
    
    if (strlen($_POST['nom']) <= 3 || strlen($_POST['nom']) > 15) {
        $error .= '<div class="alert alert-danger"> Erreur taille nom (doit etre compris entre 3 et 15 caractères)</div>';
    }

    if (strlen($_POST['prenom']) <= 3 || strlen($_POST['prenom']) > 15) {
        $error .= '<div class="alert alert-danger"> Erreur taille prenom (doit etre compris entre 3 et 15 caractères)</div>';
    }

    if (isset($_POST["email"])) {

        $email = $_POST["email"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= '<div class="alert alert-danger"> Adresse email pas valide </div>';
        }
    }

    if (strlen($_POST['mdp']) <= 3 || strlen($_POST['mdp']) > 15) {
        $error .= '<div class="alert alert-danger"> Erreur taille Mot de passe (doit etre compris entre 3 et 15 caractères)</div>';
    }

    if (strlen($_POST['numtel']) != 10) {
        $error .= '<div class="alert alert-danger"> Erreur taille Numero de telephone incorect (doit etre de 10 caractères)</div>';
    }

    if (!is_numeric($_POST['numtel'])) {

        $error .= '
        <div class="d-flex justify-content-center">
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                        Vous devez saisir un nombre !
                    </div>
            </div>
        </div>
        ';
    }

    $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    foreach ($_POST as $indice => $valeur) {

        $_POST[$indice] = htmlentities(addslashes($valeur));
    }

    if ($_POST["nom"]) {
        $nom = $_POST["nom"];
    } else {
        $nom = "";
    }

    $r = execute_requete(" SELECT nom FROM users WHERE nom = '$nom' ");

    if ($r->rowCount() >= 1) {

        $error .= "<div class='alert alert-danger'> Nom indisponible </div>";
    }

    $f = execute_requete(" SELECT email FROM users WHERE email = '$email' ");

    if ($f->rowCount() >= 1) {

        $error .= "<div class='alert alert-danger'> Email indisponible </div>";
    }


    if (empty($error)) {
        execute_requete("INSERT INTO users (nom,prenom,mdp,numtel,age,sexe,email ) 
        VALUES ( 
            '$nom',
            '$_POST[prenom]',
            '$_POST[mdp]',
            '$_POST[numtel]',
            '$_POST[age]',
            '$_POST[sexe]',
            '$email'
            )
        ");

        $content .= '
        <div class="d-flex justify-content-center">
            <div class="alert alert-success d-flex align-items-center" role="alert">
                    <div>
                        <p>Inscription validée</p>
                        <a href="' . URL . 'login.php" >Cliquez ici pour vous connecter </a>
                    </div>
            </div>
        </div>
        ';
                    
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

            <label class="text-center">Nom</label>
            <input type="text" name="nom"><br>

            <label class="text-center">Prenom</label>
            <input type="text" name="prenom"><br>

            <label class="text-center">Age</label>
            <input type="number" name="age"><br>

            <label class="text-center">Mot de passe</label>
            <input type="password" name="mdp"><br>

            <label class="text-center">Email</label>
            <input type="text" name="email"><br>

            <label class="text-center">Numero de telephone</label>
            <input type="text" name="numtel"><br>

            <label class="text-center">Civilité</label>
            <div class="d-flex justify-content-center">
                <div class="d-flex now-wrap">
                    <input type="radio" name="sexe" value="Femme">Femme
                </div>
                <br>
                <div class="d-flex now-wrap">
                    <input type="radio" name="sexe" value="Homme"> Homme
                </div>
                <div class="d-flex now-wrap">
                    <input type="radio" name="sexe" value="Autre"> Autre
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