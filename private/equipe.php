<?php 

// IMPORTANT : on peut ajouter U13A par exemple asi pas U13 , càd on ajoute des categorie et pas des équipes 

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
if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]==="add"&&isset($_POST["nom"])){
    
    
}

if(isset($_POST["equipe"])){$_SESSION["equipe"]["equipe"]=$_POST["equipe"];}

//traitement sup
if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]==='del'){

    
}

//traitement mod
if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]==='mod'){

    
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
    if(isset($_POST["action"])){$_SESSION["equipe"]["action"]=$_POST["action"];}
    ?>
    <p>
    <button name="action" type="submit" value="add" <?php if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]!=="add"){echo "class='grey'";}?>>Ajouter une equipe</button>
    <button name="action" type="submit" value="del" <?php if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]!=="del"){echo "class='grey'";}?>>Supr une equipe</button>
    <button name="action" type="submit" value="mod" <?php if(isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]!=="mod"){echo "class='grey'";}?>>Mod une equipe</button>
    </p>
    </form>
    <?php
    
    // la partie inférieur est faite 

    // sup et mod d'equipe (affichage liste)
    if(isset($_SESSION["equipe"]["action"])&&($_SESSION["equipe"]["action"]==="del"||$_SESSION["equipe"]["action"]=="mod")){  
        $equipe = $bdd->query("SELECT * from categorie")->fetchAll(PDO::FETCH_ASSOC);
        $cat='';
        foreach ($equipe as $key => $value) {
            if(isset($_SESSION["equipe"]["equipe"])&&$_SESSION["equipe"]["action"]==="add"){$check='class="select"';}else{$check='';}
            $cat.="<button name='categorie' type='submit' value='".$equipe[$key]["id"]."'>".$equipe[$key]["categorie"]."</button>";
        }
        echo '<form method="post"><p>'.$cat.'</p></form>';
    }


    // affichage d'ajout / mod (affichage form)
    if((isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]=="add") || (isset($_SESSION["equipe"]["action"])&&$_SESSION["equipe"]["action"]==='mod'&&isset($_POST["categorie"]))){ 
        if($_SESSION["equipe"]["action"]==='mod'){
            
            //point d'arret

            $categorie=$bdd->query("SELECT categorie.*,equipe.* from categorie INNER JOIN equipe ON categorie.equipe = equipe.id_equipe where categorie.id = ".$_POST["categorie"])->fetch();
            $categorie["id_joueur"]='<input type="hidden" name="photo" value="'.$categorie["id_joueur"].'">';
            $categorie["nom"]="value='".$categorie["nom"]."'";
            $categorie["lien"]="value='".explode("|",$categorie["lien"])[0]."'";
            $categorie["mot"]="value='".explode("|",$categorie["lien"])[1]."'";
        }
        $equipe = $bdd->query("SELECT * from equipe")->fetchAll(PDO::FETCH_ASSOC);
        $option = "";//penser a convertir le 'null' en NULL
        foreach ($equipe as $key => $value) {
            //mise en avant des équipes (uniquement pour la modification)
            if(isset($categorie["equipe"])&&$equipe[$key]["id_equipe"]===$categorie["equipe"]){
                $option = '<option value='.$equipe[$key]["id_equipe"].'>Equipe '.$equipe[$key]["nom"].'</option>'.$option;
            } else{
                $option .= '<option value='.$equipe[$key]["id_equipe"].'>Equipe '.$equipe[$key]["nom"].'</option>';
            }
        }
        //si $categorie n'est pas defini
        if(!isset($categorie)){$categorie["id_joueur"]="";$categorie["nom"]='';$categorie["lien"]='';$categorie["mot"]='';}
        echo '<form method="post" id="add" enctype="multipart/form-data">'
        //cette ligne permet le transfert de l 'id categorie pour la mod
        .$categorie["id_joueur"].
        '<input type="text" name="nom" id ="categorie" maxlength="30" size="25" placeholder="Categorie" '.$categorie["nom"].' required autofocus >
        <select name="equipe" id="equipe">'.$option.'</select>
        <input type="text" name="lien" id ="lien" maxlength="450" size="60" placeholder="Lien des matchs" '.$categorie["lien"].' required>
        <input type="text" name="mot" id ="mot" maxlength="50" size="60" placeholder="Mot de découpe" '.$categorie["mot"].' required>
        <button type="submit" form="add">Valider</button>
        ';

        //(a verifier) Info : pour la modification de la photo, il est obligatoire de recréer le joueur / gerer ce cas a la fin pour une V2
    }


    ?>
</body>
</html>