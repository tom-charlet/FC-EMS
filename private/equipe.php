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

// traitement ajout
if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]==="add"&&isset($_POST["equipe"])){
    if(empty($bdd->query("SELECT * from equipe where nom = '".$_POST["nom"]."'")->fetch())){
    echo $bdd->query("INSERT INTO equipe (nom) VALUES ('".$_POST["nom"]."')")->fetch();
    echo "equipe ajoutée";
    } else {
        echo "l équipe existe deja";
    }
}

//traitement sup
if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]==='del'&&isset($_POST["id_categorie"])){
    // $bdd->query("DELETE from categorie where id = ".$_POST["id_categorie"]);
    // echo "categorie del de la bdd";
    // // categorie del de la bdd
}

//traitement mod
if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]==='mod'&&isset($_POST["id"])){
    // $bdd->query("UPDATE categorie set equipe = ".$_POST["equipe"].",categorie = '".$_POST["categorie"]."',lien = '".$_POST["lien"]."|".$_POST["mot"]."' where id = ".$_POST["id"]."");
    // //categorie update
    // unset($_POST["categorie"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipe</title>
</head>
<body>
    <h3>Equipe</h3>
    <form id='for' method='post'>
    <?php 
    if(isset($_POST["action"])){$_SESSION["equipe"]["action"]=$_POST["action"];}
    ?>
    <p>
    <button name="action" type="submit" value="add" <?php if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]!=="add"){echo "class='grey'";}?>>Ajouter une equipe</button>
    <button name="action" type="submit" value="del" <?php if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]!=="del"){echo "class='grey'";}?>>Supr une equipe</button>
    <button name="action" type="submit" value="mod" <?php if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]!=="mod"){echo "class='grey'";}?>>Mod une equipe</button>
    </p>
    </form>
    <?php

    // sup et mod d'equipe (affichage liste)
    if(isset($_SESSION["equipe"]["action"])&&($_SESSION["equipe"]["action"]==="del"||$_SESSION["equipe"]["action"]=="mod")){  
        $equipe = $bdd->query("SELECT * from equipe")->fetchAll(PDO::FETCH_ASSOC);
        $equ='';
        foreach ($equipe as $key => $value) {
            if(isset($_SESSION["equipe"]["equipe"])&&$_SESSION["equipe"]["action"]==="add"){$check='class="select"';}else{$check='';}
            $equ.="<button name='equipe' type='submit' value='".$equipe[$key]["id_equipe"]."'>".$equipe[$key]["nom"]."</button>";
        }
        echo '<form method="post"><p>'.$equ.'</p></form>';
    }


    // affichage d'ajout / mod (affichage form)
    if((isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]=="add") || (isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]==='mod'&&isset($_POST["id_equipe"]))){ 
        if($_SESSION["equipe"]["action"]==='mod'){
            $equipe=$bdd->query("SELECT * from equipe where id_equipe = ".$_POST["id_equipe"])->fetch();
            $equipe["equipe"]='<input type="hidden" name="id" value="'.$equipe["id_equipe"].'">';
            $equipe["nom"]="value='".$equipe["nom"]."'";
        }
        // //si $equipe n'est pas defini
         if(!isset($equipe)){$equipe["id_equipe"]="";$equipe["nom"]="";}
        echo '<form method="post" id="add" enctype="multipart/form-data">'
        //cette ligne permet le transfert de l 'id equipe pour la mod
        .$equipe["id_equipe"].
        '<input type="text" name="nom" id ="categorie" maxlength="30" size="25" placeholder="Equipe" '.$equipe["nom"].' required autofocus >
        <button type="submit" form="add">Valider</button>
        ';
    }


    ?>
</body>
</html>