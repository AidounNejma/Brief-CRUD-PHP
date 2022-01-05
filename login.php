<?php 
require_once "inc/header.inc.php"
?>

<?php
if ($_POST)  {  
    if ($_POST["email"] ) {
        $email = $_POST["email"];
        $r = execute_requete(" SELECT * FROM users WHERE email = '$email' ");

        if( $r->rowCount() >= 1 ){ 
            $users = $r->fetch(PDO::FETCH_ASSOC);
            
            if(password_verify($_POST['mdp'],$users['mdp'])){
           
                $_SESSION['users'] = $users;
                debug($_SESSION);
    
      
            
             header('location:profile.php');
             exit;

         }
         else{
             $error.="<div class='alert alert-danger'> Mot de passe incorrect !</div>";
          }

     }
     else{ 
          $error.="<div class='alert alert-danger'> Pseudo incorrect ! </div>";
     }
        }
        
}
    
     








?>



<h1 class="text-center">CONNEXION</h1>
<br><br>

<?= $error; //Affichage des erreurs. ?>
<div class='d-flex justify-content-center'>
<div class='d-flex flex-column bd-highlight mb-3'>
<form method="post">
    <label class="p-2 bd-highlight">Mail</label>
    <input class="p-2 bd-highlight" type="text" name="email" placeholder="Votre adresse mail"><br><br>

    <label class="p-2 bd-highlight">Mot de passe</label>
    <input class="p-2 bd-highlight"  type="password" name="mdp" placeholder="Votre mot de passe"><br><br>
<div class="d-flex justify-content-center">
    <input type="submit" value="Se connecter" class="btn btn-secondary text-center p-2 bd-highlight">
</div>
<br><br>
</form>
</div>
</div>








<?php 
require_once "inc/footer.inc.php"
?>