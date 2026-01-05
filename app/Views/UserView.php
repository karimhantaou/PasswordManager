<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Utilisateur: <?=$username?></title>

        <link rel="icon" type="image/png" href="public/ressources/icon/lockIcon.png"/>

        <!-- CSS -->
        <link rel="stylesheet" href="public/Style/global.css">
        <link rel="stylesheet" href="public/Style/user.css">
    </head>
    <body>
        <div class="main">
            <form action="User/updateUser" method="POST">

                <label><b>Mon profil</b></label>

                <input type="text" value="<?=$id;?>" name="id" hidden>
                <input class="formField inputStyle" type="text" value="<?=$username?>" name="username" required>
                <input class="formField inputStyle" type="password" value="<?=$password?>" name="password" required id="password">
                <input class="formField inputStyle" type="text" value="<?=$userRole?>" disabled>
                <input class="formField inputStyle" type="text" value="<?=$creationDate?>" disabled>
                <?php if($userRole != "Invité"){ ?>
                    <input class="formField submitStyle" type="submit" value="Modifier">
                <?php } ?>
            </form>
        </div>

        <script src="public/js/user.js"></script>
    </body>
</html>