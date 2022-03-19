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
if(isset($_SESSION["staff"]["action"])&&$_SESSION["staff"]["action"]==="add"&&isset($_POST["pseudo"])){
    if(empty($bdd->query("SELECT * from staff where name = '".$_POST["pseudo"]."'")->fetch())){
        //partie ajout 
        echo $bdd->query("INSERT INTO staff (nom,prenom,`type`,`name`,`password`) VALUES ('".$_POST["nom"]."','".$_POST["prenom"]."','".$_POST["type"]."','".$_POST["pseudo"]."','".hash("sha256",$_POST["pass"])."')")->fetch();
        echo "staff ajouté";
    } else {
        echo "le pseudo existe deja";
    }
}

//traitement sup
// if(isset($_SESSION["staff"]["action"])&&$_SESSION["staff"]["action"]==='del'&&isset($_POST["id_staff"])){
//     $tmp=$bdd->query("SELECT * from staff LEFT JOIN media ON staff.photo = media.id_media where id_staff = ".$_POST["id_staff"])->fetch();
//     if($bdd->query("DELETE from staff where id_staff = ".$_POST["id_staff"])){
//         echo "staff del de la bdd";
//     }
//     var_dump($tmp);
//     //supr photo
//     if($tmp["id_media"]!==NULL){
//         if(unlink("../img/".explode("|",$tmp["nom"])[0])){
//             echo "image del sur le serveur" ;
//         }
//         if($bdd->query("DELETE from media where id_media = ".$tmp["id_media"]."")){
//             echo "image del sur la bdd" ;
//         }
//     }
// }

//traitement mod
if(isset($_SESSION["staff"]["action"])&&$_SESSION["staff"]["action"]==='mod'&&isset($_POST["id"])){
    echo $bdd->query("UPDATE staff set nom = '".$_POST["nom"]."',prenom = '".$_POST["prenom"]."',`type` = '".$_POST["type"]."',`name` = '".$_POST["pseudo"]."' where id_staff = ".$_POST["id"]."")->fetch();
    //traitement des infos (uniquement pour le president)
    if($_POST["type"]==="president"&&isset($_POST["tel"])){
        $bdd->query("UPDATE staff set infos = 'téléphone|".$_POST["tel"]."|mail|".$_POST["mail"]."' where id_staff = ".$_POST["id"]."");
    }
    //traitement du mot de passe (pas obligatoire)
    if(isset($_POST["pass"])){
        $bdd->query("UPDATE staff set `password` = '".hash("sha256",$_POST["pass"])."' where id_staff = ".$_POST["id"]."");
    }
    //traitement de la photo
    if(isset($_FILES["media"])&&$_FILES["media"]["error"]===0){
        var_dump($_FILES["media"]);
        $tmp=$bdd->query("SELECT staff.nom,staff.prenom,staff.type,media.* from staff LEFT JOIN media on staff.photo = media.id_media where staff.id_staff = ".$_POST["id"]."")->fetch();
        //echo "<hr>".var_dump($tmp);
        $name="photo de ".$_POST["prenom"]." ".strtoupper($_POST["nom"]);
        $_FILES["media"]["name"]=nom().".".explode("/",$_FILES["media"]["type"])[1];
        //partie mod (supr photo)
        if($tmp["id_media"]!==NULL){
            if(unlink("../img/".explode("|",$tmp["nom"])[0])){
                echo "image mod sur le serveur" ;
            }
            if($bdd->query("DELETE from media where id_media = ".$tmp["id_media"]."")){
                echo "image mod sur la bdd" ;
            }
        }
        //traitement doublons
        while(file_exists("../img/".$_FILES["media"]["name"])){
            $_FILES["media"]["name"]=nom().".".explode("/",$_FILES["media"]["type"])[1];
        }
        if(move_uploaded_file($_FILES["media"]["tmp_name"],"../img/".$_FILES["media"]["name"])){
            $bdd->query("INSERT INTO media (nom,`type`) VALUES ('".$_FILES["media"]["name"]."|".$name."','".$_POST["type"]."')");
            echo "photo ajoutée";
        }else{
            echo"probleme de déplacement de la photo";
        }
        //update staff
        if($bdd->query("UPDATE staff set photo = ".$bdd->query("SELECT id_media from media where nom ='".$_FILES["media"]["name"]."|".$name."'")->fetchColumn()." where id_staff = ".$_POST["id"]."")){
            echo "photo link au staff";
        }
    }
    echo "staff update";
    unset($_POST["id_staff"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
</head>
<body>
    <h3>Staff</h3>
    <form id='for' method='post'>
    <?php 
    if(isset($_POST["action"])){$_SESSION["staff"]["action"]=$_POST["action"];}
    ?>
    <p>
    <button name="action" type="submit" value="add" <?php if(isset($_SESSION["staff"]["action"])&&$_SESSION["staff"]["action"]!=="add"){echo "class='grey'";}?>>Ajouter un staff</button>
    <button name="action" type="submit" value="del" <?php if(isset($_SESSION["staff"]["action"])&&$_SESSION["staff"]["action"]!=="del"){echo "class='grey'";}?>>Supr un staff</button>
    <button name="action" type="submit" value="mod" <?php if(isset($_SESSION["staff"]["action"])&&$_SESSION["staff"]["action"]!=="mod"){echo "class='grey'";}?>>Mod un staff</button>
    </p>
    </form>
    <?php

    // sup et mod d'staff (affichage liste)
    if(isset($_SESSION["staff"]["action"])&&($_SESSION["staff"]["action"]==="del"||$_SESSION["staff"]["action"]=="mod")){  
        $staff = $bdd->query("SELECT * from staff")->fetchAll(PDO::FETCH_ASSOC);
        $sta='';
        foreach ($staff as $key => $value) {
            if(isset($_SESSION["staff"]["staff"])&&$_SESSION["staff"]["action"]==="add"){$check='class="select"';}else{$check='';}
            $sta.="<button name='id_staff' type='submit' value='".$staff[$key]["id_staff"]."'>".strtoupper($staff[$key]["nom"])." ".$staff[$key]["prenom"]."</button>";
        }
        echo '<form method="post"><p>'.$sta.'</p></form>';
    }


    // affichage d'ajout / mod (affichage form)
    if((isset($_SESSION["staff"]["action"])&&$_SESSION["staff"]["action"]=="add") || (isset($_SESSION["staff"]["action"])&&$_SESSION["staff"]["action"]==='mod'&&isset($_POST["id_staff"]))){ 
        if($_SESSION["staff"]["action"]==='mod'){
            $staff=$bdd->query("select * from staff where id_staff = ".$_POST["id_staff"])->fetch();
            $staff["id_staff"]='<input type="hidden" name="id" value="'.$staff["id_staff"].'">';
            $staff["nom"]="value='".$staff["nom"]."'";
            $staff["prenom"]="value='".$staff["prenom"]."'";
            $staff['pseudo']="value='".$staff["name"]."'";
            $staff['pass']="Soyez Sur de modifier le mot de passe";
            $staff["req"]="";
            //infos spécifique au president
            if($staff["type"]==="president"){
                
                if($staff["infos"]!==NULL){
                    
                    $tel="value='".explode("|",$staff["type"])[1]."'";
                    $mail="value='".explode("|",$staff["type"])[3]."'";
                } else {
                    $tel="";$mail="";
                }
                $staff['tel']='<label for="tel">Téléphone </label><input type="tel" id="tel" name="tel" '.$tel.' required>';
                $staff['mail']='<label for="tel">Mail </label><input type="email" id="mail" name="mail" '.$mail.' required>';
            } else {
                $staff['tel']='';$staff['mail']='';
            }
            
            if($staff["photo"]===NULL){
                $staff['photo']='<label for="titre">Photo du staff </label><input type="file" name="media" id ="media" class="hidden">';
            } else {
                $staff['photo']='<label for="titre">Le Staff a deja une photo</label><input type="file" name="media" id ="media" class="hidden">';
            }
        }
        $equipe = ["staff"];
        // pour president admin et C A
        if($rep["type"]==="admin"||$rep["type"]==="president"||$rep["type"]==="conseil administration"){$equipe=array_merge($equipe,["conseil administration"]);}
        // pour admin et president
        if($rep["type"]==="admin"||$rep["type"]==="president"){$equipe=array_merge($equipe,["president","admin"]);
        
        }
        $option = "";//penser a convertir le 'null' en NULL
        foreach ($equipe as $key => $value) {
            //mise en avant des types (uniquement pour la modification)
            if(isset($staff["type"])&&$value===$staff["type"]){
                $option = '<option value='.$value.'>'.ucfirst($value).'</option>'.$option;
            } else{
                $option .= '<option value='.$value.'>'.ucfirst($value).'</option>';
            }
        }
        //si $staff n'est pas defini
        if(!isset($staff)){$staff["id_staff"]="";$staff["nom"]='';$staff["prenom"]='';
            $staff["photo"]='Pour ajouter une photo , il faut ajouter le staff';
            $staff["pseudo"]='';$staff['tel']='';$staff['mail']='';
            $staff["pass"]='Mot de passe';
            $staff["req"]="required";
        }
        echo '<form method="post" id="add" enctype="multipart/form-data">'
        //cette ligne permet le transfert de l 'id staff pour la mod
        .$staff["id_staff"].
        '<input type="text" name="nom" id ="nom" maxlength="50" size="25" placeholder="Nom" '.$staff["nom"].' required autofocus >
        <input type="text" name="prenom" id ="prenom" maxlength="50" size="25" placeholder="Prenom" '.$staff["prenom"].' required>
        <select name="type" id="type">'.$option.'</select>
        <input type="text" name="pseudo" id ="pseudo" maxlength="50" size="25" placeholder="Pseudo" '.$staff['pseudo'].' required>
        <input type="text" name="pass" id ="pass" maxlength="50" size="25" placeholder="'.$staff["pass"].'" '.$staff["req"].'">
        '.$staff["photo"].'
        '.$staff['tel'].'
        '.$staff["mail"].'
        <button type="submit" form="add">Valider</button>
        
        ';
    }


    ?>
</body>
</html>