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
    <hr>
    <section class="consulting__confirm_recruiter">
        <h2>
            Confirmez les nouveaux employeurs
        </h2>
        <p>
            Vous retrouverez dans cette section les dernières demandes d'inscription de la part des employeurs.
        </p>
        <p id="recruiterFormStatus">

        </p>
        <table class="recruiter__table">
            <caption>
                EMPLOYEURS
            </caption>
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
                                    <input type="checkbox" checked value="<?=$u["user_id"]?>" style="display:none">
                                    <button class="btn_confirm" value="confirm_recruiter"></button>
                                </form> 
                                <form action="" method="post" class="recruiter_forms">
                                    <input type="checkbox" checked value="<?=$u["user_id"]?>" style="display:none">
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
    <section class="pannel__confirm_application">
    </section>
    <section class="pannel__confirm_advertisement">

    </section>
</main>