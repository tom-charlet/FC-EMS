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

//traitement ajout
if(isset($_POST['id_joueur'])&&$_SESSION["convocation"]["action"]==="add"){
    if($bdd->query("INSERT into convocation (joueur,categorie,id_rencontre) VALUES (".$_POST['id_joueur'].",".$_SESSION["convocation"]["id_categorie"].",".$_POST["match"].")")){
        //convocation ajoutée
    }
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
    <form id='for' method='post'>
        <?php 
        if(isset($_POST["action"])){$_SESSION["convocation"]["action"]=$_POST["action"];}
        ?>
        <button name="action" type="submit" value="add" <?php if(isset($_SESSION["convocation"]["action"])&&$_SESSION["convocation"]["action"]!=="add"){echo "class='grey'";}?>>Ajouter une convocation</button>
        <button name="action" type="submit" value="del" <?php if(isset($_SESSION["convocation"]["action"])&&$_SESSION["convocation"]["action"]!=="del"){echo "class='grey'";}?>>Supr une convocation</button>    
    </form>
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

    if(isset($_POST["equipe"])){$_SESSION["convocation"]["equipe"]=$_POST["equipe"];}
    //affichage de tout les joueurs dispo pour ajout / supr
    if(isset($_SESSION["convocation"]["id_categorie"])&&isset($_SESSION["convocation"]["equipe"])){
        // cas ajout
        if($_SESSION["convocation"]["action"]==="add"){

        }
        //$team=$bdd->query("select equipe from categorie where")->fetch();
        $match=$bdd->query("SELECT id_rencontre,`date`,equipe_int,equipe_ext from rencontre where score ='-' AND categorie=".$_SESSION["convocation"]["id_categorie"]." ORDER BY `date` DESC")->fetchAll(PDO::FETCH_ASSOC);
        $option='';
        foreach ($match as $key => $value) {
            //mise en avant des types (uniquement pour la modification)
            if(isset($_SESSION["rencontre"]["match"])&&$value["id_rencontre"]==$_SESSION["rencontre"]["match"]){
                $option = '<option value='.$value["id_rencontre"].'>'.ucfirst($value).'</option>'.$option;
            } else{
                $option .= '<option value='.$value["id_rencontre"].'>'.rencontre_date($value['date'],'reverse').'</option>';
            }
        }
        $joueur=$bdd->query("SELECT * from joueur where equipe =".$_SESSION["convocation"]["equipe"]."")->fetchAll(PDO::FETCH_ASSOC);
        
        echo '
        <div class="player">
            <form action="" method="POST">
                <div> 
                    <select name="match" id="match">'.$option.'</select>
                </div>
                <div> ';
        foreach ($joueur as $key => $value) {
        echo'<button type="submit" name="id_joueur" value="'.$value["id_joueur"].'">"'.strtoupper($joueur[$key]["nom"]).' '.ucfirst($joueur[$key]["prenom"]).'"</button>';
                }
            echo'</div>
            </form>
        </div>';
          
    }
    ?>
</body>
</html>