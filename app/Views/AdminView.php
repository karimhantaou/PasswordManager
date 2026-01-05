<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>

        <link rel="icon" type="image/png" href="public/ressources/icon/lockIcon.png"/>

        <!-- CSS -->
        <link rel="stylesheet" href="public/Style/global.css">
        <link rel="stylesheet" href="public/Style/admin.css">
    </head>
    <body>
        <div class="main">

            <div class="leftPanel">

                <?php foreach($users as $user): ?>
                    <div class="user">
                        <form action="Admin/updateUser" method="post">
                            <label>Compte <?=$user->getId();?></label>
                            <input type="hidden" name="id" value="<?=$user->getId()?>">
                            <input class="formField inputStyle" type="text" name="username" value="<?=$user->getUsername()?>">
                            <input class="formField inputStyle" type="password" name="oldPassword" value="<?=$user->getPassword()?>" hidden>
                            <input class="formField inputStyle" type="text" name="newPassword" placeholder="Nouveau mot de passe">
                            <input class="formField inputStyle" type="text" name="tableName" value="<?=$user->getTableName()?>">
                            <?php
                                if($user->getRole() == 0){
                                    $role = "Administrateur";
                                } if($user->getRole() == 1){
                                    $role = "Utilisateur";
                                } if($user->getRole() == 2){
                                    $role = "Invité";
                            }
                            ?>
                            <select class="formField selectStyle" name="role">
                                <option value="<?=$user->getRole()?>" hidden selected><?=$role?></option>
                                <option value=0>Administrateur</option>
                                <option value=1>Utilisateur</option>
                                <option value="2">Invité</option>
                            </select>
                            <input class="formField inputStyle" type="text" value="<?=$user->getCreationDate()?>" disabled>
                            <input class="formField submitStyle" type="submit" value="Modifier">
                        </form>
                        <form action="Admin/deleteUser" method="post">
                            <input type="hidden" name="id" value="<?=$user->getId()?>">
                            <input type="hidden" name="tableName" value="<?=$user->getTableName()?>">
                            <input class="formField submitStyle" type="submit" value="Supprimer">
                        </form>
                    </div>
                <?php endforeach; ?>

            </div>


            <div class="rightPanel">
                <form action="Admin/insertUser" method="post">
                    <label>Ajouter un utilisateur</label>
                    <input class="formField inputStyle" type="text" name="username" placeholder="Nom d'utilisateur">
                    <input class="formField inputStyle" type="text" name="password" placeholder="Mot de passe">
                    <select class="formField selectStyle" name="role">
                        <option value=0>Admin</option>
                        <option value=1>User</option>
                    </select>
                    <input class="formField submitStyle" type="submit" value="Ajouter">
                </form>
            </div>

        </div>
    </body>
</html>