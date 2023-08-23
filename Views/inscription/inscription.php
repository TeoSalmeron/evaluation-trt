<!-- NAVIGATION BAR -->
<?php
require_once ROOT . '/Views/templates/nav.php';
?>
<!-- END NAVIGATION BAR -->

<!-- INSCRIPTION MAIN -->
<main class="inscription__main">
    <h1>
        Créez votre compte
    </h1>
    <p>
        Rejoignez notre communauté passionnée et commencez à construire un avenir professionnel prometteur dès aujourd'hui en vous inscrivant sur notre site !
    </p>
    <h2>
        Formulaire d'inscription
    </h2>
    <!-- DEFINE NEW USER ROLE -->
    <form action="" method="get" id="defineRoleForm">
        <div class="form__item">
            <label for="signUpRole" class="item__label">
                Je suis
            </label>
            <select name="user_types" id="signUpRole" class="item__select">
                <option value="0">Candidat</option>
                <option value="1">Employeur</option>
            </select>
        </div>
    </form>
    <!-- END DEFINE NEW USER ROLE -->

    <!-- CANDIDATE FORM -->
    <form action="" method="post" accept-charset="utf-8" id="candidateSignUpForm" enctype="multipart/form-data">
        <p class="form_status" id="candidateFormStatus">

        </p>
        <small>
            * : Champs facultatifs
        </small>
        <input type="text" name="last_name" id="lastName" placeholder="Nom de famille *">
        <input type="text" name="first_name" id="firstName" placeholder="Prénom *">
        <input type="email" name="email" id="email" placeholder="E-mail" required>
        <small>
            Le mot de passe doit contenir au moins 8 caractères, un chiffre, une lettre majuscule, une lettre minuscule et un caractère spécial
        </small>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required>
        <input type="password" name="confirm_password" id="confirmPassword" placeholder="Ressaisir mot de passe" required>
        <label for="cv">
            Votre CV *
        </label>
        <small>
            Le fichier doit être au format PDF et ne pas excéder 10Mo
        </small>
        <input type="file" name="cv" id="cv" accept="application/pdf">
        <button type="submit">
            Valider
        </button>
        <button type="reset">
            Réinitialiser
        </button>
    </form>
    <!-- END CANDIDATE FORM -->

    <!-- RECRUITER FORM -->
    <form action="" method="post" accept-charset="utf-8" id="recruiterSignUpForm">
        <p class="form_status" id="recruiterFormStatus">

        </p>
        <input type="text" name="company_name" id="companyName" placeholder="Nom de l'entreprise" required>
        <input type="text" name="address" id="address" placeholder="Adresse de l'entreprise" required>
        <input type="email" name="email" id="recruiterEmail" placeholder="E-mail" required>
        <small>
            Le mot de passe doit contenir au moins 8 caractères, un chiffre, une lettre majuscule, une lettre minuscule et un caractère spécial
        </small>
        <input type="password" name="password" id="recruiterPassword" placeholder="Mot de passe" required>
        <input type="password" name="confirm_password" id="recruiterConfirmPassword" placeholder="Ressaisir mot de passe" required>
        <button type="submit">
            Valider
        </button>
    </form>
    <!-- END RECRUITER FORM -->
</main>
<!-- END MAIN INSCRIPTION -->