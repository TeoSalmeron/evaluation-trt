<!-- NAVIGATION BAR -->
<?php
require_once ROOT . '/Views/templates/nav.php';
?>
<!-- END NAVIGATION BAR -->
<main class="pannel__consulting">
    <h1>
        Bienvenue Consultant
    </h1>
    <p>
        D'ici, vous pourrez confirmer les nouveaux utilisateurs, confirmer les annonces et les recrutements.
    </p>
    <!-- RECRUITER SECTION -->
    <section class="consulting__section">
        <h2>
            Confirmez les nouveaux employeurs
        </h2>
        <p>
            Vous retrouverez dans cette section les dernières demandes d'inscription de la part des employeurs.
        </p>
        <p id="recruiterFormStatus">

        </p>
        <table class="recruiter__table"  id="recruiterTable">
            <tr>
                <th>
                    E-mail
                </th>
                <th>
                    Entreprise
                </th>
                <th>
                    Adresse
                </th>
                <th>
                    Confirmer
                </th>
            </tr>
            <?php
                $i = 1;
                foreach($unconfirmed_recruiters as $u) {
                    ?>
                        <tr class="<?= $i ?>">
                            <td data-cell="E-mail">
                                <?= $u["email"] ?>
                            </td>
                            <td data-cell="Entreprise">
                                <?=  $u["company_name"] ?>
                            </td>
                            <td data-cell="Adresse">
                                <?= $u["address"] ?>
                            </td>
                            <td data-cell="Confirmer" class="table__confirm">
                                <form action="" method="post" class="recruiter_forms" id="<?= $i ?>">
                                    <input type="checkbox" checked value="<?=$u["id"]?>" style="display:none">
                                    <button class="btn_confirm" value="confirm_recruiter"></button>
                                </form> 
                                <form action="" method="post" class="recruiter_forms">
                                    <input type="checkbox" checked value="<?=$u["id"]?>" style="display:none">
                                    <button class="btn_delete" value="delete_recruiter"></button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    $i++;
                }
            ?>
        </table>
    </section>
    <!-- END RECRUITER SECTION -->

    <!-- CANDIDATE SECTION -->
    <section class="consulting__section">
        <h2>
            Confirmer les nouveaux candidats
        </h2>
        <p>
            Vous retrouverez dans cette section les dernières demandes d'inscription de la part des candidats.
        </p>
        <p id="candidateFormStatus">

        </p>
        <table class="candidate__table"  id="candidateTable">
            <tr>
                <th>
                    E-mail
                </th>
                <th>
                    Prénom
                </th>
                <th>
                    Nom
                </th>
                <th>
                    Confirmer
                </th>
            </tr>
            <?php
                $i = 20000;
                foreach($unconfirmed_candidates as $u) {
                    ?>
                        <tr class="<?= $i ?>">
                            <td data-cell="E-mail">
                                <?= $u["email"] ?>
                            </td>
                            <td data-cell="Prénom">
                                <?php 
                                    if(!empty($u["first_name"])) {
                                        echo $u["first_name"];
                                    } else {
                                        echo "X";
                                    }
                                ?>
                            </td>
                            <td data-cell="Nom">
                                <?php 
                                    if(!empty($u["last_name"])) {
                                        echo $u["last_name"];
                                    } else {
                                        echo "X";
                                    }
                                ?>
                            </td>
                            <td data-cell="Confirmer" class="table__confirm">
                                <form action="" method="post" class="candidate_forms" id="<?= $i ?>">
                                    <input type="checkbox" checked value="<?=$u["id"]?>" style="display:none">
                                    <button class="btn_confirm" value="confirm_candidate"></button>
                                </form> 
                                <form action="" method="post" class="candidate_forms">
                                    <input type="checkbox" checked value="<?=$u["id"]?>" style="display:none">
                                    <button class="btn_delete" value="delete_candidate"></button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    $i++;
                }
            ?>
        </table>
    </section>
    <!-- END CANDIDATE SECTION -->

    <!-- CONFIRM ADVERTISEMENT -->
    <section class="consulting__section">
        <h2>
            Confirmer les offres d'emploi
        </h2>
        <p>
            Vous retrouverez dans cette section les dernières offres d'emploi envoyées par les employeurs.
        </p>
        <p id="adFormStatus">

        </p>
        <?php
            foreach($unconfirmed_advertisements as $a) {
                ?>
                    <div class="ad" id="<?=$a["id"]?>">
                        <p>
                            <b>Titre de l'annonce</b> : <?= $a["title"] ?>
                        </p>
                        <p>
                            <b>Adresse</b> : <?= $a["address"] ?>
                        </p>
                        <p>
                            <b>Description</b> : <br><br>
                            <?= nl2br($a["description"]) ?>
                        </p>
                        <form action="" method="post" class="ad_forms" id="<?=$a["id"]?>">
                            <input type="checkbox" checked value="<?=$a["id"]?>" style="display:none">
                            <button class="btn_confirm" value="confirm_ad">Confirmer</button>
                            <button class="btn_delete" value="delete_ad">Supprimer</button>
                        </form>
                    </div>
                <?php
            }
        ?>
    </section>
    <!-- END CONFIRM ADVERTISEMENT -->
    <section class="pannel__confirm_application">
    </section>
</main>