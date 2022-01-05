<?php
require_once "init.inc.php";
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mont site</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
<ul class="navbar navbar-dark bg-dark">
<?php if( !userConnect() ) : 
                        ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?php echo URL ?>register.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= URL?>login.php">Connexion</a>
                    </li>
                    <?php else : if(adminConnect()) {
                    ?>
                      <li class="nav-item">
                        <a class="nav-link text-light" href="<?= URL?>gestion.php">Gestion des profils</a>
                    </li><?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= URL?>profile.php">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= URL?>login.php?action=deconnexion">Deconnexion</a>
                    </li>
                    <?php endif; ?>
</ul>