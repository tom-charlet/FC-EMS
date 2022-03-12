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
if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]==="add"&&isset($_POST["categorie"])){
    // if(empty($bdd->query("SELECT * from categorie where categorie = '".$_POST["categorie"]."'")->fetch())){
    // echo $bdd->query("INSERT INTO categorie (equipe,categorie,lien) VALUES (".$_POST["equipe"].",'".$_POST["categorie"]."','".$_POST["lien"]."|".$_POST["mot"]."')")->fetch();
    // echo "categorie ajoutée";
    // } else {
    //     echo "l équipe existe deja";
    // }
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
    <title>Categorie</title>
</head>
<body>
    <h3>Categorie</h3>
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
            $equ.="<button name='id_equipe' type='submit' value='".$equipe[$key]["id_equipe"]."'>".$equipe[$key]["nom"]."</button>";
        }
        echo '<form method="post"><p>'.$equ.'</p></form>';
    }


    // affichage d'ajout / mod (affichage form)
    if((isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]=="add") || (isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]==='mod'&&isset($_POST["id_categorie"]))){ 
        // if($_SESSION["equipe"]["action"]==='mod'){
            
        //     //point d'arret

        //     $categorie=$bdd->query("SELECT categorie.*,equipe.* from categorie INNER JOIN equipe ON categorie.equipe = equipe.id_equipe where categorie.id = ".$_POST["id_categorie"])->fetch();
        //     $categorie["id_equipe"]='<input type="hidden" name="id" value="'.$categorie["id"].'">';
        //     $categorie["categorie"]="value='".$categorie["categorie"]."'";
        //     $categorie["mot"]="value='".explode("|",$categorie["lien"])[1]."'";
        //     $categorie["lien"]="value='".explode("|",$categorie["lien"])[0]."'";
        // }
        // $equipe = $bdd->query("SELECT * from equipe")->fetchAll(PDO::FETCH_ASSOC);
        // $option = "";//penser a convertir le 'null' en NULL
        // foreach ($equipe as $key => $value) {
        //     //mise en avant des équipes (uniquement pour la modification)
        //     if(isset($categorie["equipe"])&&$equipe[$key]["id_equipe"]===$categorie["equipe"]){
        //         $option = '<option value='.$equipe[$key]["id_equipe"].'>Equipe '.$equipe[$key]["nom"].'</option>'.$option;
        //     } else{
        //         $option .= '<option value='.$equipe[$key]["id_equipe"].'>Equipe '.$equipe[$key]["nom"].'</option>';
        //     }
        // }
        // //si $categorie n'est pas defini
        // if(!isset($categorie)){$categorie["id_equipe"]="";$categorie["categorie"]='';$categorie["lien"]='';$categorie["mot"]='';}
        // echo '<form method="post" id="add" enctype="multipart/form-data">'
        // //cette ligne permet le transfert de l 'id categorie pour la mod
        // .$categorie["id_equipe"].
        // '<input type="text" name="categorie" id ="categorie" maxlength="30" size="25" placeholder="Categorie" '.$categorie["categorie"].' required autofocus >
        // <select name="equipe" id="equipe">'.$option.'</select>
        // <input type="text" name="lien" id ="lien" maxlength="450" size="60" placeholder="Lien des matchs" '.$categorie["lien"].' required>
        // <input type="text" name="mot" id ="mot" maxlength="50" size="60" placeholder="Mot de découpe" '.$categorie["mot"].' required>
        // <button type="submit" form="add">Valider</button>
        // ';

    }


    ?>
</body>
</html>