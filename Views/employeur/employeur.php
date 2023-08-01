<!-- NAVIGATION BAR -->
<?php
require_once ROOT . '/Views/templates/nav.php';
?>
<!-- END NAVIGATION BAR -->

<!-- MAIN -->
<main class="pannel__recruiter">
    <h1>
        Bienvenue sur votre tableau de bord
    </h1>
    <p>
    De là, vous serez en mesure de créer de nouvelles opportunités d'emploi et de les rendre visibles pour tous les candidats inscrits. Vous serez également en mesure de voir les candidats qui ont posé leur candidature à vos offres.
    </p>
    <section class="create__ad">
        <h2>Créer une offre d'emploi</h2>
        <p id="formStatus">

        </p>
        <form action="" method="post" accept-charset="utf-8" id="form">
            <input type="text" name="title" id="title" required placeholder="Intitulé du poste">
            <input type="text" name="address" id="address" required placeholder="Adresse de travail">
            <textarea name="description" id="description" cols="30" rows="10" placeholder="Description du poste, horaires, salaire..." required></textarea>
            <button type="submit" value="create_new_ad">
                Soumettre
            </button>
        </form>
    </section>
</main>
<!-- END MAIN -->