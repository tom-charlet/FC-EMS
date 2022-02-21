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
    if(isset($_SESSION["joueur"]["action"])&&($_SESSION["joueur"]["action"]==="del"||$_SESSION["joueur"]["action"]=="mod")){ // sup et mod de joueur 
        $equipe = $bdd->query("SELECT * from equipe")->fetchAll(PDO::FETCH_ASSOC);
        $team='';
        foreach ($equipe as $key => $value) {
            if(isset($_SESSION["joueur"]["equipe"])&&$_SESSION["joueur"]["action"]==="add"){$check='class="select"';}else{$check='';}
            $team.="<button name='equipe' type='submit' value='".$equipe[$key]["id_equipe"]."'>".$equipe[$key]["nom"]."</button>";
        }
        echo '<form method="post"><p>'.$team.'</p></form>';
    }
    if(isset($_POST["equipe"])){$_SESSION["joueur"]["equipe"]=$_POST["equipe"];}
    
    // cas d'ajout
    if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]=="add"){ 
        $equipe = $bdd->query("SELECT * from equipe")->fetchAll(PDO::FETCH_ASSOC);
        $option = "<select name='equipe' id='equipe'>";//penser a convertir le 'null' en NULL
        foreach ($equipe as $key => $value) {
            $option .= '<option value='.$equipe[$key]["id_equipe"].'>Equipe '.$equipe[$key]["nom"].'</option>';
        }
        echo '<form method="post" id="add" enctype="multipart/form-data">
        <input type="text" name="nom" id ="nom" maxlength="50" size="25" placeholder="Nom" required autofocus>
        <input type="text" name="prenom" id ="prenom" maxlength="50" size="25" placeholder="Prenom" required>
        '.$option.'</select>
        <label for="titre">Photo du joueur</label>
        <input type="file" name="media" id ="media" required class="hidden">
        <button type="submit" form="add">Valider</button>
        ';// faire formulaire
    }
    // traitement ajout ( a tester)
    if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]=="add"&&isset($_POST["nom"])){
        if(isset($_FILES["media"])){
            $_FILES["media"]["name"]=str_replace("|"," ",$_FILES["media"]["name"]);
            while(file_exists("../img/".$_FILES["media"]["name"])){
                $_FILES["media"]["name"].=1; // permet d'eviter qu'un fichier existe 2 fois
            }
            if (move_uploaded_file($_FILES["media"]["tmp_name"],"../img/".$_FILES["media"]["name"])){
                $bdd->query("insert into media (nom, equipe, type) VALUES ('".$_FILES["media"]["name"]."|Photo de ".$_POST['nom']." ".$_POST['prenom']."', ".$_POST['equipe'].",'joueur'");
                echo "image ajouté dans la bdd";
                $joueur=$bdd->query("select * from media where nom = '".$_FILES["media"]["name"]."|Photo de ".$_POST['nom']." ".$_POST['prenom']."' ")->fetch();
            }
        } else {echo"Aucune image n a été ajouté";}
        // ajout joueur bdd
        if(isset($joueur)){
            $bdd->query("insert into joueur (nom, prenom, equipe, photo) VALUES ('".$_POST['nom']."', '".$_POST['prenom']."',".$_POST['equipe'].",".$joueur."");
            echo "joueur ajouté avec equipe";
        } else {
            $bdd->query("insert into joueur (nom, prenom, equipe) VALUES ('".$_POST['nom']."', '".$_POST['prenom']."',".$_POST['equipe']."");
            echo "joueur ajouté";
        }
    }

    ?>
</body>
</html>