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

// traitement ajout ( a tester) / mod coupler la mod en "reajoutant" le joueur
if(isset($_SESSION["joueur"]["action"])&&($_SESSION["joueur"]["action"]==="add"||$_SESSION["joueur"]["action"]==="mod")&&isset($_POST["nom"])){
    //partie mod
    if($_SESSION["joueur"]["action"]==="mod"){
        //del sql
        $photo=$bdd->query("SELECT photo from joueur where id_joueur = ".$_POST["photo"]."")->fetch();
        // supr du joueur
        $bdd->query("DELETE from joueur where id_joueur = ".$_POST["photo"]."");
    }
    
    // finir traitement mod pour cas photo

    //partie ajout photo
    if(isset($_FILES["media"])&&$_FILES["media"]["error"]===0){
        var_dump($_FILES["media"]);
        //partie mod (supr photo)
        if($_SESSION["joueur"]["action"]==="mod"){
            $supr=$bdd->query("select nom from media where id_media = ".$img["photo"]."")->fetch();
            if(unlink("../img/".explode("|",$supr["nom"])[0])){
                echo "image mod sur le serveur" ;
            }
            if($bdd->query("DELETE from media where id_media = ".$img["photo"]."")){
                echo "image mod sur la bdd" ;
            }
        }
        //partie ajout
        $_FILES["media"]["name"]=str_replace("|"," ",$_FILES["media"]["name"]);
        while(file_exists("../img/".$_FILES["media"]["name"])){
            $_FILES["media"]["name"].=1; // permet d'eviter qu'un fichier existe 2 fois
        }
        if (move_uploaded_file($_FILES["media"]["tmp_name"],"../img/".$_FILES["media"]["name"])){
            $bdd->query("insert into media (nom, equipe, type) VALUES ('".$_FILES["media"]["name"]."|Photo de ".$_POST['nom']." ".$_POST['prenom']."', ".$_POST['equipe'].",'joueur')");
            echo "image ajouté dans la bdd";
            $joueur=$bdd->query("select id_media from media where nom = '".$_FILES["media"]["name"]."|Photo de ".$_POST['nom']." ".$_POST['prenom']."' ")->fetch();
        }
    } else if(isset($_POST["photo"])&&$_FILES["media"]["error"]===0){
        //en cas de non-changement de la photo la photo précedente est 
        $joueur["id_media"]=$_POST["photo"];
    }
    // ajout joueur bdd
    if(isset($joueur)){
        $bdd->query("insert into joueur (nom, prenom, equipe, photo) VALUES ('".$_POST['nom']."', '".$_POST['prenom']."',".$_POST['equipe'].",".$joueur["id_media"].")");
        echo "joueur ajouté avec equipe";
    } else {
        $bdd->query("INSERT into joueur (nom, prenom, equipe) VALUES ('".$_POST['nom']."', '".$_POST['prenom']."',".$_POST['equipe'].")");
        echo "joueur ajouté";
    }
}

if(isset($_POST["equipe"])){$_SESSION["joueur"]["equipe"]=$_POST["equipe"];}

//traitement sup
if(isset($_POST["joueur"])){
    //cas sup 
    if($_SESSION["joueur"]["action"]==='del'){
        $img=$bdd->query("select photo from joueur where id_joueur = ".$_POST["joueur"]."")->fetch();
        var_dump($img);
        if($img["photo"]!==NULL){
            $supr=$bdd->query("select nom from media where id_media = ".$img["photo"]."")->fetch();
            if(unlink("../img/".explode("|",$supr["nom"])[0])){
                echo "image supprimer sur le serveur" ;
            }
            if($bdd->query("DELETE from media where id_media = ".$img["photo"]."")){
                echo "image supprimer sur la bdd" ;
            }
        }
        if($bdd->query("DELETE from joueur where id_joueur = ".$_POST["joueur"]."")->fetch()){
            echo "joueur bien supr";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joueur</title>
</head>
<body>
    <h3>Joueur</h3>
    <form id='for' method='post'>
    <?php 
    if(isset($_POST["action"])){$_SESSION["joueur"]["action"]=$_POST["action"];}
    ?>
    <p>
    <button name="action" type="submit" value="add" <?php if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]!=="add"){echo "class='grey'";}?>>Ajouter un joueur</button>
    <button name="action" type="submit" value="del" <?php if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]!=="del"){echo "class='grey'";}?>>Supr un joueur</button>
    <button name="action" type="submit" value="mod" <?php if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]!=="mod"){echo "class='grey'";}?>>Mod un joueur</button>
    </p>
    </form>
    <?php
    
    // sup et mod de joueur
    if(isset($_SESSION["joueur"]["action"])&&($_SESSION["joueur"]["action"]==="del"||$_SESSION["joueur"]["action"]=="mod")){  
        $equipe = $bdd->query("SELECT * from equipe")->fetchAll(PDO::FETCH_ASSOC);
        $team='';
        foreach ($equipe as $key => $value) {
            if(isset($_SESSION["joueur"]["equipe"])&&$_SESSION["joueur"]["action"]==="add"){$check='class="select"';}else{$check='';}
            $team.="<button name='equipe' type='submit' value='".$equipe[$key]["id_equipe"]."'>".$equipe[$key]["nom"]."</button>";
        }
        echo '<form method="post"><p>'.$team.'</p></form>';
    }
    
    // affichage joueur
    if(isset($_SESSION["joueur"]["action"])&&($_SESSION["joueur"]["action"]=="del"||$_SESSION["joueur"]["action"]=="mod")&&isset($_SESSION["joueur"]["equipe"])){
        $joueur=$bdd->query("select * from joueur where equipe = ".$_SESSION["joueur"]["equipe"]."")->fetchAll();
        $player='';
        foreach ($joueur as $key => $value) {
            $player.="<button name='joueur' type='submit' value='".$joueur[$key]["id_joueur"]."'>".$joueur[$key]["nom"]." ".$joueur[$key]["prenom"]."</button>";
        }
        echo '<form method="post">'.$player.'</form>';
    }


    // affichage d'ajout / mod 
    if((isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]=="add") || (isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]==='mod'&&isset($_POST["joueur"]))){ 
        if($_SESSION["joueur"]["action"]==='mod'){
            // a tester pour voir si le mod ne bug pas si aucun joueur est select
            $joueur=$bdd->query("select * from joueur where id_joueur = ".$_POST["joueur"])->fetch();
            $joueur["id_joueur"]='<input type="hidden" name="photo" value="'.$joueur["id_joueur"].'">';
            $joueur["nom"]="value='".$joueur["nom"]."'";
            $joueur["prenom"]="value='".$joueur["prenom"]."'";

            if($joueur["photo"]===NULL){
                $joueur["photo"]="(le joueur n'a pas de photo)";
            }
        }
        $equipe = $bdd->query("SELECT * from equipe")->fetchAll(PDO::FETCH_ASSOC);
        $option = "";//penser a convertir le 'null' en NULL
        foreach ($equipe as $key => $value) {
            //mise en avant des équipes (uniquement pour la modification)
            if(isset($joueur["equipe"])&&$equipe[$key]["id_equipe"]===$joueur["equipe"]){
                $option = '<option value='.$equipe[$key]["id_equipe"].'>Equipe '.$equipe[$key]["nom"].'</option>'.$option;
            } else{
                $option .= '<option value='.$equipe[$key]["id_equipe"].'>Equipe '.$equipe[$key]["nom"].'</option>';
            }
        }
        //si $joueur n'est pas defini
        if(!isset($joueur)){$joueur["id_joueur"]="";$joueur["nom"]='';$joueur["prenom"]='';$joueur["photo"]='';}
        echo '<form method="post" id="add" enctype="multipart/form-data">'
        //cette ligne permet le transfert de l 'id joueur pour la mod
        .$joueur["id_joueur"].
        '<input type="text" name="nom" id ="nom" maxlength="50" size="25" placeholder="Nom" '.$joueur["nom"].' required autofocus >
        <input type="text" name="prenom" id ="prenom" maxlength="50" size="25" placeholder="Prenom" '.$joueur["prenom"].' required>
        <select name="equipe" id="equipe">'.$option.'</select>
        <label for="titre">Photo du joueur '.$joueur["photo"].'</label>
        <input type="file" name="media" id ="media" class="hidden">
        <button type="submit" form="add">Valider</button>
        ';

        //(a verifier) Info : pour la modification de la photo, il est obligatoire de recréer le joueur / gerer ce cas a la fin pour une V2
    }


    ?>
</body>
</html>