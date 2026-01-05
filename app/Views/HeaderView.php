<header>
    <nav>
        <a class="ts-anim" href="Dashboard">Comptes</a>
        <a class="ts-anim" href="Password">Génerateur de mot de passe</a>
        <?php if($role == 0){ ?>
            <a class="ts-anim" href="Admin">Admin</a>
        <?php } ?>
        <a class="ts-anim" href="User">Profil</a>
        <a class="ts-anim" href="Login/logout">Se déconnecter</a>
    </nav>
    <div class="title">
        <p>Password Manager</p>
    </div>
</header>