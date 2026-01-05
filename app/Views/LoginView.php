<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <link rel="icon" type="image/png" href="public/ressources/icon/lockIcon.png"/>

    <link rel="stylesheet" href="public/Style/global.css">
    <link rel="stylesheet" href="public/Style/login.css">
</head>
<body>



<p class="title">Password Manager</p>

<a href="Password" class="passwordLink">Génerateur de mots de passe</a>

<form action="Login/authentificate" method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required class="input">
    <input type="password" name="password" placeholder="Mot de passe" required class="input">
    <input type="submit" value="Connexion" class="button">
</form>

<?php if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]): ?>

    <form action="Dashboard">
        <input type="submit" value="Se connecter en tant que <?= $_SESSION['actualUser']->getUsername(); ?>" class="button">
    </form>

    <form action="Login/logout">
        <input type="submit" value="Se deconnecter" class="button">
    </form>

<?php endif; ?>

</body>
</html>