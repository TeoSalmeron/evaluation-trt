<!-- NAVIGATION BAR -->
<?php
require_once ROOT . '/Views/templates/nav.php';
?>
<!-- END NAVIGATION BAR -->
<main class="connexion__main">
    <h1>
        Connectez vous à votre compte
    </h1>
    <p>
        Notre plateforme de recrutement exclusive vous offre la possibilité de gérer votre profil, d'explorer des offres d'emploi ciblées et de rester à jour avec les dernières tendances de l'industrie. 
    </p>
    <form action="" method="POST" accept-charset="utf-8" id="signInForm">
        <p id="formStatus"></p>
        <input type="email" name="email" id="email" required placeholder="E-mail">
        <input type="password" name="password" id="password" required placeholder="Mot de passe">
        <button>
            Valider
        </button>
    </form>
</main>