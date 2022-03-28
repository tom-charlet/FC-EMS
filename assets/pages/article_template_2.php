<?php 
include "../command.php";
$bdd=bdd_connection();
//les 2 lignes permettent de recup le nom du fichier
$url=explode("/",$_SERVER["PHP_SELF"]);
$url=explode(".", end($url))[0];
//un article = nom-de-l-article
$content=$bdd->query("SELECT * from article LEFT JOIN staff ON article.auteur = staff.id_staff Where article.titre='".str_replace("-"," ",$url)."'")->fetch();
$images=$bdd->query("SELECT * from article INNER JOIN media ON article.id_article=media.article where article.titre='".str_replace("-"," ",$url)."' ")->fetchAll(PDO::FETCH_ASSOC);
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

    <? html_header() ?>

    <!-- MAIN -->

    <main class="main-article-slider">
        <section class="container">
            <h2 class="sec-title title-page">Actualités</h2>

            <!-- ARTICLE CONTAINER -->

            <article class="article-container">
                <div class="article-content">
                    <div class="article-entete">
                        <h3>Résumé de l'article</h3>
                        <p>Le <?php echo html_date($content["date"]) ?> par <?php echo $content["prenom"] ?></p>
                    </div>
                    <div class="article-text">
                        <p>
                            <?php echo $content["texte"] ?>
                        </p>
                    </div>
                </div>
                <div class="article-slider">
                    <?php foreach ($images as $key => $value) {
                        echo"
                        <div class='article-slider-img'>
                            <img class='img-cover' src='../img/".explode("|",$value["nom"])[0]."' alt='".explode("|",$value["nom"])[1]."'>
                        </div>
                        ";
                    } ?>
                </div>
            </article>
        </section>
    </main>

    <!-- FOOTER -->

    <?php html_footer(); ?>

    <!-- JS -->

    <script src="../js/app.js"></script>
</body>

</html>