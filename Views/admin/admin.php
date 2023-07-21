<!-- NAVIGATION BAR -->
<?php
require_once ROOT . '/Views/templates/nav.php';
?>
<!-- END NAVIGATION BAR -->
<main class="pannel__admin">
    <h1>
        Bienvenue sur la page d'administration
    </h1>
    <section class="create__consulting">
        <h2>
            Créer un compte "consultant"
        </h2>
        <form action="" method="post" accept-charset="utf-8" id="form">
            <p class="form_status" id="formStatus">

            </p>
            <input type="email" name="email" id="email" required placeholder="E-mail">
            <small>
                Le mot de passe doit contenir au moins 8 caractères, un chiffre, une lettre majuscule, une lettre minuscule et un caractère spécial
            </small>
            <input type="password" name="password" id="password" placeholder="Mot de passe">
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer mot de passe">
            <button type="submit">
                Valider
            </button>
        </form>
    </section>
</main>