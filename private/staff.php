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
if(isset($_SESSION["staff"]["action"])&&$_SESSION["staff"]["action"]==="add"&&isset($_POST["nom"])){
    // if(empty($bdd->query("SELECT * from staff where nom = '".$_POST["nom"]."'")->fetch())){
    // echo $bdd->query("INSERT INTO staff (nom) VALUES ('".$_POST["nom"]."')")->fetch();
    // echo "staff ajoutée";
    // } else {
    //     echo "l équipe existe deja";
    // }
}

//traitement sup
if(isset($_SESSION["staff"]["action"])&&$_SESSION["staff"]["action"]==='del'&&isset($_POST["id_staff"])){
    // $bdd->query("DELETE from staff where id_staff = ".$_POST["id_staff"]);
    // echo "categorie del de la bdd";
    // // staff del de la bdd
}

//traitement mod
if(isset($_SESSION["staff"]["action"])&&$_SESSION["staff"]["action"]==='mod'&&isset($_POST["id"])){
    // $bdd->query("UPDATE staff set nom = '".$_POST["nom"]."' where id_staff = ".$_POST["id"]."");
    // echo "staff update";
    // unset($_POST["id_staff"]);
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
            $staff["id_staff"]='<input type="hidden" name="photo" value="'.$staff["id_staff"].'">';
            $staff["nom"]="value='".$staff["nom"]."'";
            $staff["prenom"]="value='".$staff["prenom"]."'";

            if($staff["photo"]===NULL){
                $staff["photo"]="(le staff n'a pas de photo)";
            }
        }
        $equipe = ["staff"];
        // pour president admin et C A
        if($rep["type"]==="admin"||$rep["type"]==="president"||$rep["type"]==="conseil administration"){$equipe=array_merge($equipe,["conseil administration"]);}
        // pour admin et president
        if($rep["type"]==="admin"||$rep["type"]==="president"){$equipe=array_merge($equipe,["president","admin"]);}
        var_dump($equipe);
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
        if(!isset($staff)){$staff["id_staff"]="";$staff["nom"]='';$staff["prenom"]='';$staff["photo"]='';}
        echo '<form method="post" id="add" enctype="multipart/form-data">'
        //cette ligne permet le transfert de l 'id staff pour la mod
        .$staff["id_staff"].
        '<input type="text" name="nom" id ="nom" maxlength="50" size="25" placeholder="Nom" '.$staff["nom"].' required autofocus >
        <input type="text" name="prenom" id ="prenom" maxlength="50" size="25" placeholder="Prenom" '.$staff["prenom"].' required>
        <select name="type" id="type">'.$option.'</select>
        <label for="titre">Photo du staff '.$staff["photo"].'</label>
        <input type="file" name="media" id ="media" class="hidden">
        <button type="submit" form="add">Valider</button>
        ';
    }


    ?>
</body>
</html>