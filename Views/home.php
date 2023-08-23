<!-- NAVBAR -->
<?php
require_once ROOT . '/Views/templates/nav.php'
?>
<!-- END NAVBAR -->

<!-- HEADER -->
<header class="home__header">
    <h1>
        Bienvenue sur TRT Recrutement <br>votre plateforme d'emploi dédiée à la restauration et à l'hôtellerie
    </h1>
</header>
<!-- END HEADER -->

<!-- MAIN SECTION -->
<main class="home__main">
    <p>
        Vous recherchez un emploi passionnant dans le domaine de la restauration ou de l'hôtellerie ? Ne cherchez plus ! Vous êtes au bon endroit.
    </p>
    <h2>
        Trouvez votre carrière de rêve dans le secteur de la restauration et de l'hôtellerie
    </h2>
    <p>
        Notre plateforme de recrutement est conçue spécifiquement pour les professionnels de la restauration et de l'hôtellerie. Nous mettons en relation les meilleurs talents avec les entreprises renommées du secteur, vous offrant ainsi des opportunités de carrière idéales.
    </p>
    <h2>
        Pourquoi choisir TRT ?
    </h2>
    <ol>
        <li>
            <b>
                Vaste réseau d'entreprises partenaires
            </b>
            - Nous avons établi des partenariats solides avec des restaurants, des hôtels, des cafés et d'autres établissements prestigieux dans toute la région. Vous aurez accès à une multitude d'offres d'emploi exclusives.
        </li>
        <li>
            <b>
                Offres d'emploi actualisées en temps réel
            </b>
            - Notre équipe s'efforce de maintenir notre base de données d'emplois à jour en permanence. Vous serez toujours informé des dernières opportunités professionnelles dans votre domaine.
        </li>
        <li>
            <b>
                Facilité d'utilisation  
            </b>
            - Notre interface conviviale vous permet de naviguer facilement à travers les offres d'emploi, de filtrer les résultats selon vos critères spécifiques et de postuler rapidement et efficacement.
        </li>
        <li>
            <b>
                Confidentialité et sécurité 
            </b>
            - Nous prenons la confidentialité de vos informations personnelles très au sérieux. Vos données sont sécurisées et ne seront partagées qu'avec les employeurs que vous choisissez.
        </li>
    </ol>
</main>
<!-- END MAIN SECTION -->

<!-- FIRST SECTION -->
<section class="home__first_section">
    <h2>
        Comment ça marche ?
    </h2>
    <ol>
        <li>
            <img src="/img/add_user.png" alt="créer un compte">
            <h3>
                Créez votre compte
            </h3>
            <p>
                Commencez par créer votre compte sur TRT et complétez votre profil avec votre expérience, vos compétences et vos préférences professionnelles.
            </p>
        </li>
        <li>
            <img src="/img/eye.png" alt="recherchez un emploi">
            <h3>
                Explorez les offres d'emploi
            </h3>
            <p>
                Parcourez notre large éventail d'offres d'emploi spécifiquement dans le secteur de la restauration et de l'hôtellerie. Utilisez les filtres pour affiner votre recherche en fonction de votre localisation, de votre niveau d'expérience et d'autres critères pertinents.
            </p>
        </li>
        <li>
            <img src="/img/cv.png" alt="postulez pour un emploi">
            <h3>
                Postulez en un clic
            </h3>
            <p>
                Lorsque vous trouvez une offre qui correspond à vos aspirations professionnelles, postulez directement depuis notre plateforme.
            </p>
        </li>
        <li>
            <img src="/img/meet.png" alt="rencontrez les employeurs">
            <h3>
                Connectez-vous avec les employeurs
            </h3>
            <p>
                Si votre candidature est retenue, les employeurs vous contacteront directement via mail ou téléphone. Vous pourrez ainsi discuter des détails du poste, organiser des entretiens et avancer dans votre processus de recrutement.
            </p>
        </li>
    </ol>
</section>
<!-- END FIRST SECTION -->

<!-- SECOND SECTION -->
<section class="home__second_section">
    <h2>
        Rejoignez dès maintenant TRT et donnez un nouvel élan à votre carrière dans la restauration et l'hôtellerie !
    </h2>
    <p>
        Inscrivez-vous dès aujourd'hui et commencez votre recherche d'emploi dès maintenant. Notre équipe est là pour vous soutenir tout au long de votre parcours professionnel. Rejoignez notre communauté passionnée de professionnels de la restauration et de l'hôtellerie.
    </p>
    <a href="/inscription">
        créer un compte
    </a>
</section>
<!-- END SECOND SECTION -->

<!-- AD SECTIONS -->
<section class="home__ads">
    <h2>Nos dernières offres</h2>
    <?php
        foreach($ads as $a) {
            ?>
                <div class="ad">
                    <p>
                        <b> Intitulé du poste : </b> <?= $a["title"] ?>
                    </p>
                    <p>
                        <b> Entreprise : </b> <?= strtoupper($a["company_name"]) ?>
                    </p>
                    <p>
                        <b> Adresse : </b> <?= $a["location"] ?>
                    </p>
                    <p>
                        <b> Description du poste : </b> <br> <br>
                        <?= nl2br($a["description"]) ?>
                    </p>
                    <?php
                        if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "candidate") {
                            ?>
                                <button value="<?=$a["a_id"]?>" class="btn_apply">Postuler</button>
                            <?php
                        }
                    ?>
                </div>
            <?php
        }
    ?>
</section>
<!-- END AD SECTIONS -->
