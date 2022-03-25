<?php 
session_start();
if(isset($_SESSION["connection"])&&($_SESSION["connection"]===true)&&(isset($_SESSION["token"]["pass"]))&&(isset($_SESSION["token"]["name"]))){
    include "../command.php";
    $bdd=bdd_connection();
    $rep=$bdd->query("select name,type from staff where password = '".$_SESSION["token"]["pass"]."'")->fetch();
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


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convocation</title>
</head>
<body>
    <button name="action" type="submit" value="add" <?php if(isset($_SESSION["convocation"]["action"])&&$_SESSION["convocation"]["action"]!=="add"){echo "class='grey'";}?>>Ajouter une convocation</button>
    <button name="action" type="submit" value="del" <?php if(isset($_SESSION["convocation"]["action"])&&$_SESSION["convocation"]["action"]!=="del"){echo "class='grey'";}?>>Supr une convocation</button>
    <?php 
    if(isset($_POST["id_categorie"])){$_SESSION["convocation"]["id_categorie"]=$_POST["id_categorie"];}
    //affichage des categorie
    $cat=$bdd->query("SELECT id,equipe,categorie from categorie")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($cat as $key => $value) {
        if (isset($_SESSION["convocation"]["id_categorie"])&&$value["id"]==$_SESSION["convocation"]["id_categorie"]) {
            $select=" class='selected'";
        } else {
            $select="";
        }
        echo '
            <form method="POST">
                <input type="hidden" name="equipe" value="'.$value["equipe"].'">
                <button type="submit" name="id_categorie" value="'.$value["id"].'" '.$select.'>"'.$value["categorie"].'"</button>
            </form>';
    }


    // if(isset($_POST["equipe"])){
    //     //$team=$bdd->query("select equipe from categorie where")->fetch();
    //     $date=$bdd->query("");
    //     $joueur=$bdd->query("select categorie.id,joueur.id_joueur,joueur.nom,joueur.prenom from (convocation inner join joueur on convocation.joueur = joueur.id_joueur) Inner join categorie on categorie.id = convocation.categorie where categorie.categorie = ".$_POST["equipe"]."")->fetchAll();
    //     foreach ($joueur as $key => $value) {
    //         echo '<div class="player">
    //         <form action="" method="POST">
    //             <input id="team" name="team" type="hidden" value="'.$joueur[$key]["id"].'">
    //             <input type="hidden" name="joueur" value="'.$joueur[$key]["id_joueur"].'">
    //             <input type="submit" value="'.strtoupper($joueur[$key]["nom"]).' '.ucfirst($joueur[$key]["prenom"]).'">
    //         </form>
    //     </div>';
    //     }   
    // }
    ?>
</body>
</html>