<?php 
include "../command.php";
$bdd=bdd_connection();
//les 2 lignes permettent de recup le nom du fichier
$url=explode("/",$_SERVER["PHP_SELF"]);
$url=explode(".", end($url))[0];

//un article = nom-de-l-article
$content=$bdd->query("SELECT * from article LEFT JOIN staff ON article.auteur = staff.id_staff Where article.titre='".str_replace("-"," ",$url)."'")->fetch();
$image=$bdd->query("SELECT * from article INNER JOIN media on where article.id_article=media.article where article.titre='".str_replace("-"," ",$url)."' ")->fetch();
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
    <title>Article <?php echo $content["titre"] ?></title>
</head>

<body>

    <!-- HEADER -->

    <?php html_header();?>

    <!-- MAIN -->

    <main class="main-article-full">
        <section class="container">
            <h2 class="sec-title title-page">Actualités</h2>

            <!-- ARTICLE CONTAINER -->

            <article class="article-container">
                <div class="article-full-img">
                    <img class="img-cover" src="../img/<?php echo explode("|",$image["nom"])[0] ?>" alt="<?php echo explode("|",$image["nom"])[1] ?>">
                </div>
                <div class="article-content">
                    <div class="article-entete">
                        <h3>Résumé de l'article</h3>
                        <p>Le <?php echo html_date($content["date"]) ?> par <?php echo $content["prenom"] ?></p>
                    </div>
                    <div class="article-text">
                        <p>
                            <?php echo $content["date"] ?>
                        </p>
                    </div>
                </div>
            </article>
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
                    <li><a href="actualite.html">Actualité</a></li>
                    <li><a href="resultats.html">Résultats</a></li>
                    <li><a href="convocation.html">Convocations</a></li>
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

    <script src="../js/app.js"></script>
</body>

</html>