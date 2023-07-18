<nav class="main_navigation_bar">
    <!-- LOGO -->
    <div class="logo">
        <a href="/">
            <img src="/img/logo.png" alt="malette de travail">
        </a>
    </div>
    <!-- END LOGO -->

    <!-- BUTTON TO TOGGLE NAVIGATION BAR -->
    <button class="toggle_nav" id="toggleNav">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <!-- END BUTTON -->

    <ul id="navList" class="nav_list">
        <button id="closeNav" class="close_nav">
            <img src="/img/close.png" alt="fermer la barre de navigation">
        </button>
        <li class="list_item">
            <a href="/" class="item_link">
                + Accueil
            </a>
        </li>
        <li class="list_item">
            <a href="#" class="item_link" id="linkMyAccount">
               + Mon compte
            </a>
            <ul class="item_sub_nav" id="subNavMyAccount">
                <?php 
                    if(!isset($_SESSION["is_connected"]) || $_SESSION["is_connected"] == 0) {
                        ?>
                            <li>
                                <a href="/connexion">
                                    + Se connecter
                                </a>
                            </li>
                            <li>
                                <a href="/inscription">
                                    + Créer un compte
                                </a>
                            </li>
                        <?php
                    } else {
                        ?>
                            <li>
                                <a href="/profil">
                                    + Profil
                                </a>
                            </li>
                            <li>
                                <a href="/deconnexion">
                                    + Se déconnecter
                                </a>
                            </li>
                        <?php
                    }
                ?>
            </ul>
        </li>
        <li class="list_item">
            <a href="/offres" class="item_link">
                + Nos offres
            </a>
        </li>
    </ul>
</nav>
