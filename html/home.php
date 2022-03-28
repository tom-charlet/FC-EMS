<?php
session_start();
session_destroy(); 
include '../command.php';
$bdd=bdd_connection();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" media="screen" href="../css/style.css">
    <link rel="stylesheet" media="screen" href="../css/media-queries.css">
    <title>FC EMS - Homepage</title>
</head>

<body>

    <!-- HEADER -->

    <?php html_header("accueil"); ?>

    <!-- MAIN -->

    <main class="main-home">

        <!-- ACTU -->

        <section class="container">
            <h2 class="sec-title">Actualité du club</h2>
            <div class="actu-container">

                <!-- ACTU-CLUB --- /!\ --- 4 ARTICLES MIN-MAX -->

                <div class="actu-club-container">
                <?php 
                    $tmp=$bdd->query('SELECT * from article ORDER by `date` desc limit 4')->fetchAll(PDO::FETCH_ASSOC);
                    $option='';
                    if(count($tmp)<4){
                        //var_dump($tmp);
                        $img=$bdd->query('SELECT * from media where article ="'.$tmp[0]["id_article"].'" order by id_media ASC limit 1')->fetch();
                        $option.="
                        <article class='actu-club-article'>
                            <a class='actu-club-link' href='../article/".$tmp[0]["titre"].".php'>
                                <div class='actu-club-items'>
                                    <img class='actu-club-items-img img-cover' src='../img/".explode("|",$img["nom"])[0]."'
                                        alt='../img".explode("|",$img["nom"])[1]."'>
                                    <h3 class='actu-club-items-title'>".$tmp[0]["titre"]."</h3>
                                </div>
                            </a>
                        </article>
                        ";
                    } else {
                        foreach ($tmp as $key => $value) {
                            $img=$bdd->query('SELECT * from media where article ="'.$tmp[$key]["id_article"].'" order by id_media ASC limit 1')->fetch();
                            $option.="
                            <article class='actu-club-article'>
                                <a class='actu-club-link' href='../article/".$tmp[$key]["titre"].".php'>
                                    <div class='actu-club-items'>
                                        <img class='actu-club-items-img img-cover' src='../img".explode("|",$img["nom"])[0]."'
                                            alt='../img".explode("|",$img["nom"])[1]."'>
                                        <h3 class='actu-club-items-title'>".$tmp[$key]["titre"]."</h3>
                                    </div>
                                </a>
                            </article>
                            ";
                        }
                    }
                    echo $option;
                    ?>
                </div>

                <!-- ACTU-FOOT --- /!\ --- 9 ARTICLES MIN-MAX -->

                <div class="actu-foot-container">
                    <div class="actu-foot-header">
                        <div class="widget-icon">
                            <img class="img-contain" src="../img/actu-foot-icon.svg" alt="icone actualité foot">
                        </div>
                        <h3 class="widget-title">Actualité</h3>
                    </div>
                    <div class="actu-foot-article-container no-scroll-bar">

                        <!-- ARTICLE ACTU FOOT -->

                        <article class="actu-foot-article">
                            <a class="actu-foot-article-link" href="#">
                                <div class="actu-foot-article-img">
                                    <img class="img-cover" src="../img/img-test-foot.jpg" alt="actualité foot">
                                </div>
                                <div class="actu-foot-article-info">
                                    <h4 class="actu-foot-article-title">Vicoire du fc EMS</h4>
                                    <p class="actu-foot-article-desc">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing.
                                    </p>
                                    <p class="actu-foot-article-date">
                                        3 janvier
                                    </p>
                                </div>
                            </a>
                        </article>

                        <!-- ARTICLE ACTU FOOT -->

                        <article class="actu-foot-article">
                            <a class="actu-foot-article-link" href="#">
                                <div class="actu-foot-article-img">
                                    <img class="img-cover" src="../img/img-test-foot.jpg" alt="actualité foot">
                                </div>
                                <div class="actu-foot-article-info">
                                    <h4 class="actu-foot-article-title">Vicoire du fc EMS</h4>
                                    <p class="actu-foot-article-desc">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing.
                                    </p>
                                    <p class="actu-foot-article-date">
                                        3 janvier
                                    </p>
                                </div>
                            </a>
                        </article>

                        <!-- ARTICLE ACTU FOOT -->

                        <article class="actu-foot-article">
                            <a class="actu-foot-article-link" href="#">
                                <div class="actu-foot-article-img">
                                    <img class="img-cover" src="../img/img-test-foot.jpg" alt="actualité foot">
                                </div>
                                <div class="actu-foot-article-info">
                                    <h4 class="actu-foot-article-title">Vicoire du fc EMS</h4>
                                    <p class="actu-foot-article-desc">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing.
                                    </p>
                                    <p class="actu-foot-article-date">
                                        3 janvier
                                    </p>
                                </div>
                            </a>
                        </article>

                        <!-- ARTICLE ACTU FOOT -->

                        <article class="actu-foot-article">
                            <a class="actu-foot-article-link" href="#">
                                <div class="actu-foot-article-img">
                                    <img class="img-cover" src="../img/img-test-foot.jpg" alt="actualité foot">
                                </div>
                                <div class="actu-foot-article-info">
                                    <h4 class="actu-foot-article-title">Vicoire du fc EMS</h4>
                                    <p class="actu-foot-article-desc">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing.
                                    </p>
                                    <p class="actu-foot-article-date">
                                        3 janvier
                                    </p>
                                </div>
                            </a>
                        </article>

                        <!-- ARTICLE ACTU FOOT -->

                        <article class="actu-foot-article">
                            <a class="actu-foot-article-link" href="#">
                                <div class="actu-foot-article-img">
                                    <img class="img-cover" src="../img/img-test-foot.jpg" alt="actualité foot">
                                </div>
                                <div class="actu-foot-article-info">
                                    <h4 class="actu-foot-article-title">Vicoire du fc EMS</h4>
                                    <p class="actu-foot-article-desc">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing.
                                    </p>
                                    <p class="actu-foot-article-date">
                                        3 janvier
                                    </p>
                                </div>
                            </a>
                        </article>

                        <!-- ARTICLE ACTU FOOT -->

                        <article class="actu-foot-article">
                            <a class="actu-foot-article-link" href="#">
                                <div class="actu-foot-article-img">
                                    <img class="img-cover" src="../img/img-test-foot.jpg" alt="actualité foot">
                                </div>
                                <div class="actu-foot-article-info">
                                    <h4 class="actu-foot-article-title">Vicoire du fc EMS</h4>
                                    <p class="actu-foot-article-desc">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing.
                                    </p>
                                    <p class="actu-foot-article-date">
                                        3 janvier
                                    </p>
                                </div>
                            </a>
                        </article>

                        <!-- ARTICLE ACTU FOOT -->

                        <article class="actu-foot-article">
                            <a class="actu-foot-article-link" href="#">
                                <div class="actu-foot-article-img">
                                    <img class="img-cover" src="../img/img-test-foot.jpg" alt="actualité foot">
                                </div>
                                <div class="actu-foot-article-info">
                                    <h4 class="actu-foot-article-title">Vicoire du fc EMS</h4>
                                    <p class="actu-foot-article-desc">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing.
                                    </p>
                                    <p class="actu-foot-article-date">
                                        3 janvier
                                    </p>
                                </div>
                            </a>
                        </article>

                        <!-- ARTICLE ACTU FOOT -->

                        <article class="actu-foot-article">
                            <a class="actu-foot-article-link" href="#">
                                <div class="actu-foot-article-img">
                                    <img class="img-cover" src="../img/img-test-foot.jpg" alt="actualité foot">
                                </div>
                                <div class="actu-foot-article-info">
                                    <h4 class="actu-foot-article-title">Vicoire du fc EMS</h4>
                                    <p class="actu-foot-article-desc">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing.
                                    </p>
                                    <p class="actu-foot-article-date">
                                        3 janvier
                                    </p>
                                </div>
                            </a>
                        </article>

                        <!-- ARTICLE ACTU FOOT -->

                        <article class="actu-foot-article">
                            <a class="actu-foot-article-link" href="#">
                                <div class="actu-foot-article-img">
                                    <img class="img-cover" src="../img/img-test-foot.jpg" alt="actualité foot">
                                </div>
                                <div class="actu-foot-article-info">
                                    <h4 class="actu-foot-article-title">Vicoire du fc EMS</h4>
                                    <p class="actu-foot-article-desc">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing.
                                    </p>
                                    <p class="actu-foot-article-date">
                                        3 janvier
                                    </p>
                                </div>
                            </a>
                        </article>

                    </div>
                    <div class="actu-foot-ctc">
                        <a href="private/histoire.html">Voir plus d'actualités ></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- RESULTATS -->

        <section class="container">

            <h2 class="sec-title">Résultats des matchs</h2>

            <div class="resultats-container">

                <!-- TAB CONTAINER -->

                <div class="tab-container">
                    <form class="select-form" action="" method="get">
                        <div class="select-bloc">
                            <label for="groupe">groupe</label>
                            <select name="groupe" id="groupe">
                                <option value="senior">Sénior</option>
                                <option value="u18">U18</option>
                                <option value="u15">U15</option>
                                <option value="u13">U13</option>
                            </select>
                        </div>
                        <div class="select-bloc">
                            <label for="equipe">équipe</label>
                            <select name="equipe" id="equipe">
                                <option value="equipe-a">équipe A</option>
                                <option value="equipe-b">équipe B</option>
                                <option value="equipe-c">équipe C</option>
                                <option value="equipe-d">équipe D</option>
                                <option value="equipe-e">équipe E</option>
                            </select>
                        </div>
                    </form>
                    <table class="table table-odd">
                        <thead>
                            <tr>
                                <th colspan="3">Clasement : Groupe Equipe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>nom équipe</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>nom équipe</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>nom équipe</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>nom équipe</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>nom équipe</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>nom équipe</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>nom équipe</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>nom équipe</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>nom équipe</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>nom équipe</td>
                                <td>23</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- RES CONTAINER -->

                <div class="res-container">
                    <div class="entete">
                        <div class="entete-content">
                            <svg class="entete-icon" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.8 5.6H10.8C10.36 5.6 10 5.96 10 6.4V9.6C10 10.04 10.36 10.4 10.8 10.4H12.8C13.24 10.4 13.6 10.04 13.6 9.6V6.4C13.6 5.96 13.24 5.6 12.8 5.6ZM12.4 9.2H11.2V6.8H12.4V9.2ZM6 10.4H2.4V8.4C2.4 7.96 2.76 7.6 3.2 7.6H4.8V6.8H2.4V5.6H5.2C5.64 5.6 6 5.96 6 6.4V7.6C6 8.04 5.64 8.4 5.2 8.4H3.6V9.2H6V10.4ZM8.6 7.2H7.4V6H8.6V7.2ZM8.6 10H7.4V8.8H8.6V10ZM16 3.2V12.8C16 13.68 15.28 14.4 14.4 14.4H1.6C0.72 14.4 0 13.68 0 12.8V3.2C0 2.32 0.72 1.6 1.6 1.6H4V0H5.6V1.6H10.4V0H12V1.6H14.4C15.28 1.6 16 2.32 16 3.2ZM14.4 12.8V3.2H8.6V4.4H7.4V3.2H1.6V12.8H7.4V11.6H8.6V12.8H14.4Z"
                                    fill="#24354D" />
                            </svg>
                            <span class="entete-title">Derniers Matchs</span>
                        </div>
                        <div class="entete-btn">
                            <button>
                                <a href="private/resultats.html">+</a>
                            </button>
                        </div>
                    </div>
                    <div class="res-content">

                    <?php 
                    $tmp=$bdd->query("SELECT * from rencontre where score <> '-' OR score <>'arrêté' limit 4")->fetchAll(PDO::FETCH_ASSOC);
                    $option='';
                    foreach ($tmp as $key => $value) {
                        $option.="
                        <article class='res-article'>
                            <div class='res-article-score'>
                                <h3 class='team-name'>".$value["equipe_int"]."</h3>
                                <div class='logo-team-m'>
                                    <img class='img-contain' src='img/logo-ems.png' alt='logo de l'équipe ".$value["equipe_int"]."'>
                                </div>
                                <h4 class='res-match'>".$value["score"]."</h4>
                                <div class='logo-team-m'>
                                    <img class='img-contain' src='img/logo-ems.png' alt='logo de l'équipe ".$value["equipe_ext"]."'>
                                </div>
                                <h3 class='team-name'>".$value["equipe_ext"]."</h3>
                            </div>
                            <div class='res-article-info'>
                                <p>".rencontre_date($value["date"],'front')."</p>
                            </div>
                        </article>
                        ";
                    }
                    echo$option;
                    ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- GALERIE -->

        <section class="container">

            <h2 class="sec-title">Galerie photo</h2>

            <!-- GALERIE HEADER -->

            <div class="galerie-header">
                <div class="entete">
                    <div class="entete-content">
                        <svg class="entete-icon" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.8 5.6H10.8C10.36 5.6 10 5.96 10 6.4V9.6C10 10.04 10.36 10.4 10.8 10.4H12.8C13.24 10.4 13.6 10.04 13.6 9.6V6.4C13.6 5.96 13.24 5.6 12.8 5.6ZM12.4 9.2H11.2V6.8H12.4V9.2ZM6 10.4H2.4V8.4C2.4 7.96 2.76 7.6 3.2 7.6H4.8V6.8H2.4V5.6H5.2C5.64 5.6 6 5.96 6 6.4V7.6C6 8.04 5.64 8.4 5.2 8.4H3.6V9.2H6V10.4ZM8.6 7.2H7.4V6H8.6V7.2ZM8.6 10H7.4V8.8H8.6V10ZM16 3.2V12.8C16 13.68 15.28 14.4 14.4 14.4H1.6C0.72 14.4 0 13.68 0 12.8V3.2C0 2.32 0.72 1.6 1.6 1.6H4V0H5.6V1.6H10.4V0H12V1.6H14.4C15.28 1.6 16 2.32 16 3.2ZM14.4 12.8V3.2H8.6V4.4H7.4V3.2H1.6V12.8H7.4V11.6H8.6V12.8H14.4Z"
                                fill="#24354D" />
                        </svg>
                        <span class="entete-title">Photos du club</span>
                    </div>
                    <div class="entete-btn">
                        <button>
                            <a href="private/galerie.html">+</a>
                        </button>
                    </div>
                </div>
                <div class="galerie-photo-container">
                    <?php
                    $tmp=$bdd->query("SELECT * from media where `type`='photo' order by id_media desc limit 7")->fetchAll(PDO::FETCH_ASSOC);
                    $option='';
                    foreach ($tmp as $key => $value) {
                        $option.="
                        <div class='galerie-photo-items'>
                            <svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'
                                x='0px' y='0px' viewBox='0 0 100 100' style='enable-background:new 0 0 100 100;'
                                xml:space='preserve'>
                                <path d='M100,35c-3.3,0-6.5,0-9.9,0c0-6,0-11.9,0-17.9C81.6,25.7,73,34.2,64.5,42.7c-2.4-2.4-4.8-4.8-7.1-7.2
                                    c8.5-8.5,17-17,25.5-25.5c0-0.1-0.1-0.1-0.1-0.2c-5.9,0-11.8,0-17.8,0c0-3.3,0-6.6,0-9.9c11.7,0,23.3,0,35,0
                                    C100,11.7,100,23.3,100,35z' />
                                <path
                                    d='M0,65c3.3,0,6.5,0,9.9,0c0,6,0,11.9,0,17.9c8.6-8.6,17.1-17.1,25.7-25.7c2.4,2.4,4.7,4.8,7.1,7.2
                                    c-8.4,8.7-17,17.1-25.5,25.7c6,0,11.9,0,17.9,0c0,3.4,0,6.6,0,9.9c-11.7,0-23.3,0-35,0C0,88.3,0,76.7,0,65z' />
                            </svg>
                            <img class='img-cover' src='../img/".explode("|",$value["nom"])[0]."' alt='".explode("|",$value["nom"])[1]."'>
                        </div>
                            ";
                    }
                    echo $option;
                    ?>
                    
                </div>
            </div>
        </section>

        <!-- PARTENAIRES -->

        <section class=" full-container partenaire-promo-section">
            <div class="container">
                <h2 class="sec-title">Partenaires</h2>
            </div>
            <div class="partenaire-promo">
                <a href="private/partenaires.html">
                    <div class="partenaire-items">
                        <img class="img-contain" src="../img/logo-ems.png" alt="nom de partenaire" title="partenaire">
                    </div>
                </a>
                <a href="private/partenaires.html">
                    <div class="partenaire-items">
                        <img class="img-contain" src="../img/logo-ems.png" alt="nom de partenaire" title="partenaire">
                    </div>
                </a>
                <a href="private/partenaires.html">
                    <div class="partenaire-items">
                        <img class="img-contain" src="../img/logo-ems.png" alt="nom de partenaire" title="partenaire">
                    </div>
                </a>
                <a href="private/partenaires.html">
                    <div class="partenaire-items">
                        <img class="img-contain" src="../img/logo-ems.png" alt="nom de partenaire" title="partenaire">
                    </div>
                </a>
                <a href="private/partenaires.html">
                    <div class="partenaire-items">
                        <img class="img-contain" src="../img/logo-ems.png" alt="nom de partenaire" title="partenaire">
                    </div>
                </a>
            </div>
        </section>
    </main>

    <!-- FOOTER -->

    <footer>
        <div class="footer-container">
            <div class="footer-top">
                <div class="logo-team-s">
                    <img class="img-contain" src="../img/logo-ems.png" alt="logo : football club eure madrie seine">
                </div>
                <h3>Football club eure madrie seine</h3>
            </div>
            <nav class="footer-nav">
                <ul>
                    <li><a href="home.html">Accueil</a></li>
                    <li><a href="histoire.html">Actualité</a></li>
                    <li><a href="resultats.html">Résultats</a></li>
                    <li><a href="convocations.html">Convocations</a></li>
                </ul>
                <ul>
                    <li><a href="histoire.html">Histoire</a></li>
                    <li><a href="palmares.html">Palmarès</a></li>
                    <li><a href="galerie.html">Galerie</a></li>
                    <li><a href="organigramme.html">Organigramme</a></li>
                </ul>
                <ul>
                    <li><a href="partenaire.html">Partenaires</a></li>
                    <li><a href="#">Boutique</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Se connecter</a></li>
                </ul>
                <ul>
                    <li>
                        <a href="#">
                            <div class="icon-s">
                                <img class="img-contain" src="../img/accueil.svg" title="instagram"
                                    alt="lien vers l'instagram du club">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="icon-s">
                                <img class="img-contain" src="../img/accueil.svg" title="facebook"
                                    alt="lien vers le facebook du club">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="icon-s">
                                <img class="img-contain" src="../img/accueil.svg" title="email"
                                    alt="lien vers le mail du club">
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="footer-legal">
                <span>@ 2022 EMS</span>
                <a href="#">mentions légales</a>
            </div>
        </div>
    </footer>

    <!-- JS -->

    <script src="js/app.js"></script>
</body>

</html>