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

// traitement ajout / mod
if(isset($_SESSION["sponsor"]["action"])&&(($_SESSION["sponsor"]["action"]==="add"&&isset($_POST["date"]))||$_SESSION["sponsor"]["action"]==='mod'&&isset($_POST["id"]))){
    if($_SESSION["sponsor"]["action"]==="add"){
        if($_POST["nom"]!==""){
            $name=$_POST["nom"];
        } else if($_POST["name"]!==""){
            $name=$_POST["name"];
        } else {
            echo "Erreur nom";
        }
        if(isset($name)){
            if(empty($bdd->query("SELECT * from sponsor where nom='".$name."' AND date = ".$_POST["date"]."")->fetch())){
                //partie ajout 
                $bdd->query("INSERT INTO sponsor (nom,`date`,`type`) VALUES ('".$name."',".$_POST["date"].",'".$_POST["type"]."')")->fetch();
                echo "sponsor ajouté";
            } else {
                echo "le sponsor existe deja";
            }
        }
    }
    if($_SESSION["sponsor"]["action"]==="mod"){
        if($_POST["nom"]!==""){
            $name=$_POST["nom"];
        } else if($_POST["name"]!==""){
            $name=$_POST["name"];
        } else {
            echo "Erreur nom";
        }
        if(isset($name)&&empty($bdd->query("SELECT * from sponsor where nom='".$name."' AND date = ".$_POST["date"]."")->fetch())){
            
        } else {
            echo "Le sponsor existe deja";
        }
        if($bdd->query("UPDATE sponsor set nom = '".$_POST["nom"]."',date = ".$_POST["date"].",`type` = '".$_POST["type"]."' where id_sponsor = ".$_POST["id"]."")){
            echo "staff update";
            unset($_POST["id_sponsor"]);
        } else {
            echo "Probleme requete";
        }
    }
    
}

//traitement sup
if(isset($_SESSION["sponsor"]["action"])&&$_SESSION["sponsor"]["action"]==='del'&&isset($_POST["id_sponsor"])){
    if($bdd->query("DELETE from sponsor where id_sponsor = ".$_POST["id_sponsor"])){
        echo "Sponsor del de la bdd";
    } else {
        echo "Sponsor NON del de la bdd";
    }
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
            $sponsor["nomform"]="value='".$sponsor["nom"]."'";
            $sponsor["dateform"]=$sponsor["date"];
        }
        //liste des différents type de sponsors
        $type = ["materiel sportif","nourriture"];
        
        
        $a="";
        foreach ($type as $key => $value) {
            //mise en avant des sponsors deja existant (uniquement pour la modification)
            if(isset($sponsor["type"])&&$value===$sponsor["type"]){
                $a='<option value='.$value.'>'.ucfirst($value).'</option>'.$a;
            } else{
                $a.='<option value='.$value.'>'.ucfirst($value).'</option>';
            }
        }
        $spon=$bdd->query("SELECT DISTINCT(nom) from sponsor")->fetchAll(PDO::FETCH_ASSOC);
        //IMPORTANT l input text prend la priorité sur le select
        $option = "<option value=''></option>";
        foreach ($spon as $key => $value) {
            $option .= '<option value='.$spon[$key]["nom"].'>'.ucfirst($spon[$key]["nom"]).'</option>';
        }
        //si $sponsor n'est pas defini
        if(!isset($sponsor)){$sponsor["id_sponsor"]="";$sponsor["nomform"]='';$sponsor["dateform"]=date("Y");}
        echo '<form method="post" id="add" enctype="multipart/form-data">'
        //cette ligne permet le transfert de l 'id sponsor pour la mod
        .$sponsor["id_sponsor"].
        '<p><input type="text" name="nom" id ="nom" maxlength="80" size="25" placeholder="Nom" '.$sponsor["nomform"].' autofocus > OU 
        <select name="name" id="name">'.$option.'</select></p>
        <select name="type" id="type">'.$a.'</select>
        <label for="date">Date du sponsor</label><input type="number" name="date" id="date" min="2010" max="2030" value="'.$sponsor["dateform"].'" >
        <label for="texte">Texte</label>
        <label for="upload">Photo</label>
            <input type="file" name="upload" id="upload" >
        <textarea id="texte" name="texte" rows="10" cols="33" required>
            '.($a=(isset($_SESSION["sponsor"]["texte"]))?$_SESSION["article"]["texte"]:"").'
        </textarea>
        
        <button type="submit" form="add">Valider</button>
        ';
    }


    ?>
</body>
</html>