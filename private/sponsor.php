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
if(isset($_SESSION["sponsor"]["action"])&&$_SESSION["sponsor"]["action"]==="add"&&isset($_POST["pseudo"])){
    // if(empty($bdd->query("SELECT * from staff where name = '".$_POST["pseudo"]."'")->fetch())){
    //     //partie ajout 
    //     echo $bdd->query("INSERT INTO staff (nom,prenom,`type`,`name`,`password`) VALUES ('".$_POST["nom"]."','".$_POST["prenom"]."','".$_POST["type"]."','".$_POST["pseudo"]."','".hash("sha256",$_POST["pass"])."')")->fetch();
    //     echo "staff ajouté";
    // } else {
    //     echo "le pseudo existe deja";
    // }
}

//traitement sup
if(isset($_SESSION["sponsor"]["action"])&&$_SESSION["sponsor"]["action"]==='del'&&isset($_POST["id_staff"])){
    $tmp=$bdd->query("SELECT * from staff LEFT JOIN media ON staff.photo = media.id_media where id_staff = ".$_POST["id_staff"])->fetch();
    // if($bdd->query("DELETE from staff where id_staff = ".$_POST["id_staff"])){
    //     echo "staff del de la bdd";
    // }
    // var_dump($tmp);
    // //supr photo
    // if($tmp["id_media"]!==NULL){
    //     if(unlink("../img/".explode("|",$tmp["nom"])[0])){
    //         echo "image del sur le serveur" ;
    //     }
    //     if($bdd->query("DELETE from media where id_media = ".$tmp["id_media"]."")){
    //         echo "image del sur la bdd" ;
    //     }
    // }
}

//traitement mod
if(isset($_SESSION["sponsor"]["action"])&&$_SESSION["sponsor"]["action"]==='mod'&&isset($_POST["id"])){
    // echo $bdd->query("UPDATE staff set nom = '".$_POST["nom"]."',prenom = '".$_POST["prenom"]."',`type` = '".$_POST["type"]."',`name` = '".$_POST["pseudo"]."' where id_staff = ".$_POST["id"]."")->fetch();
    // //traitement des infos (uniquement pour le president)
    
    // echo "staff update";
    // unset($_POST["id_staff"]);
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sponsor</title>
</head>
<body>
    <h3>Sponsor</h3>
    <form id='for' method='post'>
    <?php 
    if(isset($_POST["action"])){$_SESSION["sponsor"]["action"]=$_POST["action"];}
    ?>
    <p>
    <button name="action" type="submit" value="add" <?php if(isset($_SESSION["sponsor"]["action"])&&$_SESSION["sponsor"]["action"]!=="add"){echo "class='grey'";}?>>Ajouter un sponsor</button>
    <button name="action" type="submit" value="del" <?php if(isset($_SESSION["sponsor"]["action"])&&$_SESSION["sponsor"]["action"]!=="del"){echo "class='grey'";}?>>Supr un sponsor</button>
    <button name="action" type="submit" value="mod" <?php if(isset($_SESSION["sponsor"]["action"])&&$_SESSION["sponsor"]["action"]!=="mod"){echo "class='grey'";}?>>Mod un sponsor</button>
    </p>
    </form>
    <?php

    // sup et mod de sponsor (affichage liste)
    if(isset($_SESSION["sponsor"]["action"])&&($_SESSION["sponsor"]["action"]==="del"||$_SESSION["sponsor"]["action"]=="mod")){  
        $sponsor = $bdd->query("SELECT * from sponsor")->fetchAll(PDO::FETCH_ASSOC);
        $sta='';
        foreach ($sponsor as $key => $value) {
            if(isset($_SESSION["sponsor"]["id_sponsor"])&&$_SESSION["sponsor"]["action"]==="mod"&&$_SESSION["sponsor"]["id_sponsor"]===$sponsor[$key]["id_sponsor"]){$check='class="select"';}else{$check='';}
            $sta.="<button name='id_sponsor' type='submit' value='".$sponsor[$key]["id_sponsor"]."' ".$check.">".strtoupper($sponsor[$key]["nom"])." ".$sponsor[$key]["date"]."</button>";
        }
        echo '<form method="post"><p>'.$sta.'</p></form>';
    }


    // affichage d'ajout / mod (affichage form)
    if((isset($_SESSION["sponsor"]["action"])&&$_SESSION["sponsor"]["action"]=="add") || (isset($_SESSION["sponsor"]["action"])&&$_SESSION["sponsor"]["action"]==='mod'&&isset($_POST["id_sponsor"]))){ 
        if($_SESSION["sponsor"]["action"]==='mod'){
            $sponsor=$bdd->query("select * from sponsor where id_sponsor = ".$_POST["id_sponsor"])->fetch();
            $sponsor["id_sponsor"]='<input type="hidden" name="id" value="'.$sponsor["id_sponsor"].'">';
            $sponsor["nom"]="value='".$sponsor["nom"]."'";
            $sponsor["date"]="value='".$sponsor["nom"]."'";
        }
        //liste des différents type de sponsors
        $type = ["materiel sportif","nourriture"];
        $a="";
        foreach ($type as $key => $value) {
            $a.='<option value='.$value.'>'.ucfirst($value).'</option>';
        }
        $spon=$bdd->query("SELECT DISTINCT(nom) from sponsor")->fetchAll(PDO::FETCH_ASSOC);
        //l input text prend la priorité sur le select
        $option = "<option value=''></option>";
        foreach ($spon as $key => $value) {
            //mise en avant des types (uniquement pour la modification)
            if(isset($spon["type"])&&$value===$sponsor["type"]){
                $option = '<option value='.$value.'>'.ucfirst($value).'</option>'.$option;
            } else{
                $option .= '<option value='.$spon["key"]["nom"].'>'.ucfirst($spon["key"]["nom"]).'</option>';
            }
        }
        //si $sponsor n'est pas defini
        if(!isset($sponsor)){$sponsor["id_sponsor"]="";$sponsor["nom"]='';$sponsor["date"]='';}
        echo '<form method="post" id="add" enctype="multipart/form-data">'
        //cette ligne permet le transfert de l 'id sponsor pour la mod
        .$sponsor["id_sponsor"].
        '<p><input type="text" name="nom" id ="nom" maxlength="80" size="25" placeholder="Nom" '.$sponsor["nom"].' autofocus > OU 
        <select name="name" id="name">'.$option.'</select></p>
        <select name="type" id="type">'.$a.'</select>
        <label for="date">Date du sponsor</label><input type="number" name="date" id="date" min="2010" max="2030" value="'.date("Y").'" >
        <button type="submit" form="add">Valider</button>
        ';
    }


    ?>
</body>
</html>