<?php 
include "../command.php";
$bdd=bdd_connection();
var_dump(__FILE__);
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
    <title>FC EMS - Nom Actualité</title> <!-- Modifier nom article en back -->
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
                    <img class="img-cover" src="../img/img-test-foot.jpg" alt="Image d'article">
                </div>
                <div class="article-content">
                    <div class="article-entete">
                        <h3>Résumé de l'article</h3>
                        <p>Date article / Auteur</p>
                    </div>
                    <div class="article-text">
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. In consequuntur ab perferendis
                            necessitatibus itaque nam aut similique enim esse nobis. Illum, minima fugiat reiciendis
                            commodi alias omnis non eum ipsum. Nemo doloremque rerum sequi officiis ullam neque eligendi
                            earum, quia dicta officia ut molestiae possimus, voluptatum praesentium dignissimos dolores
                            culpa expedita itaque nisi. Quos, est eligendi sunt quae assumenda esse voluptatum, cum
                            suscipit hic ut mollitia pariatur inventore nostrum fugiat, vero ipsum temporibus. Nam
                            dolorum, mollitia provident, culpa, id maiores quas reprehenderit nostrum earum labore ut
                            reiciendis corrupti voluptatem sed iusto quis expedita necessitatibus in. Animi repellendus
                            dolores illum numquam, totam excepturi similique molestiae labore iusto voluptatibus veniam
                            laborum, est necessitatibus dolorem aliquam natus. Deserunt sapiente sit pariatur adipisci
                            modi ipsum deleniti excepturi explicabo natus magni consectetur perspiciatis velit amet
                            facilis vero laboriosam, obcaecati suscipit nam quisquam provident totam id eos ipsa? Quos
                            at inventore maxime voluptas culpa minima delectus sequi optio, officia, fugiat animi
                            reprehenderit quod. Ipsa vel, deleniti magnam aperiam placeat mollitia accusamus repellendus
                            nam pariatur doloribus tempore ad labore eveniet commodi cumque, error inventore aut minus
                            in! Libero quo amet illo molestiae? Quaerat tempore aliquid explicabo, voluptate nostrum
                            obcaecati vitae porro sit minima amet magni quisquam similique.
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