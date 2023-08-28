<?php
require_once ROOT . '/Views/templates/nav.php';
?>

<!--  -->
<main class="offres__main">
    <?php
        foreach($ads as $a) {
            ?>
                <div class="ad">
                    <p>
                        <b> Intitulé du poste : </b> <?= $a["title"] ?>
                    </p>
                    <p>
                        <b> Entreprise : </b> <?= ucfirst(strtolower($a["company_name"])) ?>
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
</main>
