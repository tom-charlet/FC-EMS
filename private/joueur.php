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
if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]==="add"&&isset($_POST["nom"])){
    // ajout joueur bdd
        $bdd->query("INSERT into joueur (nom, prenom, equipe) VALUES ('".$_POST['nom']."', '".$_POST['prenom']."',".$_POST['equipe'].")");
        echo "joueur ajouté";
}

//traitement mod
if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]==="mod"&&isset($_POST["nom"])){
        $bdd->query("UPDATE joueur SET nom = '".$_POST['nom']."',prenom='".$_POST['prenom']."',equipe=".$_POST['equipe']." WHERE id_joueur = ".$_POST["id"]."");
        echo "joueur mod";
    }



//traitement sup
if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]==="del"&&isset($_POST["joueur"])){
    if($bdd->query("DELETE from joueur where id_joueur = ".$_POST["joueur"]."")->fetch()){
            echo "joueur bien supr";
        }

    }
if(isset($_POST["equipe"])){$_SESSION["joueur"]["equipe"]=$_POST["equipe"];}
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
            $joueur["id_joueur"]='<input type="hidden" name="id" value="'.$joueur["id_joueur"].'">';
            $joueur["nom"]="value='".$joueur["nom"]."'";
            $joueur["prenom"]="value='".$joueur["prenom"]."'";
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
        if(!isset($joueur)){$joueur["id_joueur"]="";$joueur["nom"]='';$joueur["prenom"]='';}
        echo '<form method="post" id="add">'
        //cette ligne permet le transfert de l 'id joueur pour la mod
        .$joueur["id_joueur"].
        '<input type="text" name="nom" id ="nom" maxlength="50" size="25" placeholder="Nom" '.$joueur["nom"].' required autofocus >
        <input type="text" name="prenom" id ="prenom" maxlength="50" size="25" placeholder="Prenom" '.$joueur["prenom"].' required>
        <select name="equipe" id="equipe">'.$option.'</select>
        <button type="submit" form="add">Valider</button>
        ';

        //(a verifier) Info : pour la modification de la photo, il est obligatoire de recréer le joueur / gerer ce cas a la fin pour une V2
    }


    ?>
</body>
</html>