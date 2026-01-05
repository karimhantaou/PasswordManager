<!--

    $accounts : Tous les comptes de l'utilisateur
    $categories : Toutes les catégories de comptes de l'utilisateur

-->

<?php
    $searchSvg = file_get_contents("public/ressources/svg/search.svg");
    $copySvg = file_get_contents("public/ressources/svg/copy.svg");
    $categorySvg = file_get_contents("public/ressources/svg/plus.svg");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comptes</title>

    <link rel="icon" type="image/png" href="public/ressources/icon/lockIcon.png"/>

    <!-- CSS -->
    <link rel="stylesheet" href="public/Style/global.css">
    <link rel="stylesheet" href="public/Style/dashboard.css">

</head>
<body>

    <div class="main">
        <div class="leftPanel">
            <div class="accountContainer">

                <label class="accountTitleLabel"><b>Mes comptes</b></label>
                <form action="Dashboard" method="POST" class="searchContainer">

                    <div class="searchOption">
                        <input type="text" name="searchTerm" placeholder="Recherche un compte" value="<?=$searchTerm;?>" class="formField inputStyle">
                        <button type="submit">
                            <?=$searchSvg;?>
                        </button>
                    </div>
                    <div class="searchOption">
                        <select name="category" class="formField selectStyle"">

                            <option value="null" selected hidden>Catégorie</option>
                            <option value="null">Aucune</option>

                            <?php foreach($categories as $category) : ?>
                                <option value="<?=$category?>"><?=$category?></option>
                            <?php endforeach; ?>

                        </select>

                        <select name="sort" class="formField selectStyle"">
                            <option value="recent" selected>Plus récent</option>
                            <option value="ancient">Plus anciens</option>
                            <option value="az">A -> Z</option>
                            <option value="za">Z -> A</option>
                        </select>
                    </div>
                </form>

                <p class="rightPanelTitle">Nombres de comptes séléctionnés : <?=count($accounts);?></p>

                <p class="rightPanelTitle"><?php if(!empty($searchTerm)) : ?>Recherche : "<?=$searchTerm;?>"<?php endif; ?> </p>

                <?php foreach ($accounts as $account) : ?>

                    <button class="accountButton" onclick="openInfo(<?=$account->getId();?>)"><?=$account->getName();?></button>

                    <div class="account slide" id="<?=$account->getId();?>">
                        <div class="accountInfo">
                            <form action="Dashboard/updateAccount" method="POST">
                                <input type="hidden" name="id" value="<?=$account->getId();?>">

                                <div class="inputContainer">
                                    <input type="text" name="name" placeholder="Nom du compte" value="<?=$account->getName();?>" class="formField inputStyle" id="name<?=$account->getId();?>">
                                    <button type="button" class="copyButton" onClick="copyText('name<?=$account->getId();?>')"><?=$copySvg?></button>
                                </div>

                                <div class="inputContainer">
                                    <input type="text" name="username" placeholder="Nom d'utilisateur ou email" value="<?=$account->getUsername();?>" class="formField inputStyle" id="username<?=$account->getId();?>">
                                    <button type="button" class="copyButton" onClick="copyText('username<?=$account->getId();?>')"><?=$copySvg?></button>
                                </div>

                                <div class="inputContainer">
                                    <input type="password" name="password" placeholder="Mot de passe" value="<?=$account->getPassword();?>" class="formField inputStyle" id="password<?=$account->getId();?>">
                                    <button type="button" class="copyButton" onClick="copyText('password<?=$account->getId();?>')"><?=$copySvg?></button>
                                </div>

                                <div class="categoryContainer">
                                    <select name="category" class="formField selectStyle" id="categorySelectAccount<?=$account->getId();?>">

                                        <option value="<?= $account->getCategory(); ?>" selected hidden><?= $account->getCategory(); ?></option>
                                        <option value="Aucune">Aucune</option>

                                        <?php foreach($categories as $category) : ?>
                                            <option value="<?=$category?>"><?=$category?></option>
                                        <?php endforeach; ?>

                                    </select>

                                    <input autocomplete="off" list="category" name="newCategory" placeholder="Nouvelle catégorie" class="formField inputStyle" id="categoryInputAccount<?=$account->getId();?>">
                                    <datalist class="formField inputStyle" id="category">
                                        <?php foreach($categories as $category) : ?>
                                            <option value="<?=$category?>"><?=$category?></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                    <button type="button" onclick="swtichCategory(<?=$account->getId();?>)"><?=$categorySvg?></button>
                                </div>

                                <textarea name="comment" class="formField textareaStyle"><?=$account->getComment();?></textarea>

                                <label class="dateLabel">Créé le : <?=$account->getCreationDate();?></label>

                        </div>

                        <div class="accountOption">
                            <input type="submit" value="Modifier" class="formField submitStyle"></form>

                            <form action="Dashboard/deleteAccount" method="POST">
                                <input type="hidden" name="id" value="<?=$account->getId();?>">
                                <input type="submit" value="Supprimer"  class="formField submitStyle">
                            </form>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>


        </div>
        <div class="rightPanel">

            <div class="rightPanelContent">

                <div class="addAccountContainer">
                    <p class="rightPanelTitle">Ajouter un compte</p>
                    <form action="Dashboard/addAccount" method="POST">
                        <input type="text" name="name" placeholder="Nom du compte" class="formField inputStyle" required>
                        <input type="text" name="username" placeholder="Nom d'utilisateur ou email" class="formField inputStyle">
                        <input type="text" name="password"placeholder="Mot de passe" class="formField inputStyle">

                        <div class="categoryContainer">
                            <select name="category" class="formField selectStyle" id="categorySelectAddAccount">

                                <option value="Aucune" selected hidden>Catégorie</option>
                                <option value="Aucune">Aucune</option>

                                <?php foreach($categories as $category) : ?>
                                    <option value="<?=$category?>"><?=$category?></option>
                                <?php endforeach; ?>

                            </select>

                            <input autocomplete="off" list="category" name="newCategory" placeholder="Nouvelle catégorie" class="formField inputStyle" id="categoryInputAddAccount">
                            <datalist class="formField inputStyle" id="category">
                                <?php foreach($categories as $category) : ?>
                                    <option value="<?=$category?>"><?=$category?></option>
                                <?php endforeach; ?>
                            </datalist>

                            <button type="button" id="categoryButtonAddAccount">+</button>
                        </div>

                        <textarea name="comment" placeholder="Commentaire" class="formField textareaStyle"></textarea>
                        <input type="submit" value="Ajouter" class="formField submitStyle">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="public/js/dashboard.js"></script>

</body>
</html>