<?php // test de validitée de connection

if(isset($_SESSION["connection"])&&($_SESSION["connection"]===True)&&(isset($_SESSION["token"]["pass"]))&&(isset($_SESSION["token"]["name"]))){
    include "../command.php";
    $bdd=bdd_connection();
    $rep=$bdd->query("select name from staff where password = '".$_SESSION["token"]["pass"]."'")->fetch();
    if($rep["name"]===$_SESSION["token"]["name"]){
        $rep=$bdd->query("select * from staff where name = '".$_SESSION["token"]["name"]."'")->fetch();
    } else {
        session_destroy();
        header("Location: ../html/connect.php");
    }
} else {
    session_destroy();
    header("Location: ../html/connect.php");
}
if(isset($_POST["joueur"])){
    $joueur=$bdd->query("select joueur.id-joueur from (convocation inner join joueur on convocation.joueur = joueur.id-joueur) Inner join categorie on categorie.id = convocation.categorie where categorie.categorie = ".$_POST["equipe"]."")->fetchAll();
    $insert=$bdd->query("INSERT INTO `convocation`(`joueur`, `categorie`, `date`) VALUES ('".$joueur["id-joueur"]."','".$_POST["team"]."','[value-4]')")
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $team=$bdd->query("select equipe.nom,categorie.categorie from categorie INNER JOIN equipe on equipe.id-equipe = categorie.equipe ", PDO::FETCH_ASSOC);
        foreach ($team as $key => $value) {
            if (isset($_POST["equipe"])&&$team[$key]===$_POST["equipe"]) {
                $select="selected";
            } else {
                $select="";
            }
            echo '<div class="button '.$select.'">
            <form action="" method="POST">
                <input type="hidden" name="equipe" value="'.$team[$key]["categorie"].'">
                <input type="submit" value="'.$team[$key]["categorie"].'">
            </form>
        </div>';
        }
        if(isset($_POST["equipe"])){
            //$team=$bdd->query("select equipe from categorie where")->fetch();
            $joueur=$bdd->query("select categorie.id,joueur.id-joueur,joueur.nom,joueur.prenom from (convocation inner join joueur on convocation.joueur = joueur.id-joueur) Inner join categorie on categorie.id = convocation.categorie where categorie.categorie = ".$_POST["equipe"]."")->fetchAll();
            foreach ($joueur as $key => $value) {
                echo '<div class="player">
                <form action="" method="POST">
                    <input id="team" name="team" type="hidden" value="'.$joueur[$key]["id"].'">
                    <input type="hidden" name="joueur" value="'.$joueur[$key]["id-joueur"].'">
                    <input type="submit" value="'.strtoupper($joueur[$key]["nom"]).' '.ucfirst($joueur[$key]["prenom"]).'">
                </form>
            </div>';
        }
    ?>
</body>
</html>