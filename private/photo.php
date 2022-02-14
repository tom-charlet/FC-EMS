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

// traitement reponse ajout
if(isset($_FILES["media"])){
//if($_FILES["media"]["size"]<2000000){ Reflechir a limite de taille
    //$_FILES["media"]["size"]=str_replace(["/"," ",";",",","!","-","_","{","}"],"",$_FILES["upload"]["size"]);
    
//} else {
//    echo "<p>La media est trop grande </p><a href='index.php'> Upload une media</a>";
//} 
    $_FILES["media"]["name"]=str_replace("|"," ",$_FILES["media"]["name"]);
    while(file_exists("../img/".$_FILES["media"]["name"])){
        $_FILES["media"]["name"].=1; // permet d'eviter qu'un fichier existe 2 fois
    }
    if (move_uploaded_file($_FILES["media"]["tmp_name"],"../img/".$_FILES["media"]["name"])) {
        if($_POST["equipe"]==='null'){
            $bdd->query("insert into media (nom, type) VALUES ('".$_FILES["media"]["name"]."|".$_POST['titre']."','".explode("/",$_FILES["media"]["type"])[0]."')");
        } else {
            $bdd->query("insert into media (nom, equipe, type) VALUES ('".$_FILES["media"]["name"]."|".$_POST['titre']."', ".$_POST['equipe'].",'".explode("/",$_FILES["media"]["type"])[0]."')");
        }
        echo "Le média a été ajouté dans le serveur";
        unset($_SESSION["media"]);
    } else {echo "<p>Probleme lors du televersement</p>";}
}

//traitement suppression

if(isset($_POST["delete"])){
    $supr=$bdd->query("select nom from media where id_media = ".$_POST["delete"]."")->fetch();
    if(unlink("../img/".explode("|",$supr["nom"])[0])){
        echo "image supprimer sur le serveur" ;
    }
    if($bdd->query("DELETE from media where id_media = ".$_POST["delete"]."")){
        echo "image supprimer sur la bdd" ;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>media</h3>
    <h4>Liste media</h4>
    <table>
        <tr>
            <th><p>Titre</p></th>
            <th><p>Equipe</p></th>
            <th><p>Article</p></th>
            <th><p>Preview</p></th>
            <th><p>Action</p></th>
        </tr>
    <?php 

    // ajouter inner join pour recup titre article
    $media=$bdd->query("SELECT media.*,article.titre from media left join article on media.article = article.id_article  order by id_media desc")->fetchAll(PDO::FETCH_ASSOC);
    var_dump($media[0]);
    // reflechir au systeme de disable en cas d absence de 

    foreach ($media as $key => $value) {
        if($media[$key]["article"]===NULL){
            $class="class='cross'";
            $article="";
        } else {
            $class="";
            $article=$media[$key]["titre"];
        }
        echo "<tr> 
        <td>".explode("|",$media[$key]["nom"])[1]."</td>
        <td>Temporaire</td>
        <td ".$class.">".$article."</td>
        <td>".explode("|",$media[$key]["nom"])[0]."</td>
        <td>
        <form id='form".$media[$key]["id_media"]."-delete' method='post'>
            <input type='hidden' name='delete' value='".$media[$key]["id_media"]."'>
            <button type='submit' form='form".$media[$key]["id_media"]."-delete'><img src='../assets/bin.svg' alt='poubelle'></button>
        </form>
        <form id='form".$media[$key]["id_media"]."-edit' method='post'>
            <input type='hidden' name='edit' value='".$media[$key]["id_media"]."'>
            <button type='submit' form='form".$media[$key]["id_media"]."-edit'><img src='../assets/edit.svg' alt=''></button>
        </form>
        </td>
        </tr>";
    }
    if(isset($_GET["edit"])){$_SESSION["media"]=$bdd->query("SELECT * from media where id_media = ".$_GET["edit"]."")->fetch(PDO::FETCH_ASSOC);}

    ?>
    </table>
    <form id="ajout" method="post">
        <input type='hidden' name='add'>
        <button type='submit' form='ajout'>Ajouter une media</button>
    </form>
    <?php
    if(isset($_SESSION['ajout'])||isset($_SESSION["edit"])){
        
        echo"";
    }
    ?>
    <form id='add' method='post' enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <p>
                        <label for='titre'>Titre</label>
                        <input type='text' name='titre' id ='titre' size='25' pattern='[A-Za-z0-9]{3-50}' placeholder='Titre' <?php if(isset($_SESSION["media"])){echo "value='".explode("|",$_SESSION["media"]["nom"])[1]."'";} ?> required autofocus>
                    </p>
                </td>
                <td>
                    <p>
                        <label for='titre'>media</label>
                        <input type='file' name='media' id ='media'  required>
                    </p>
                </td>
                <td>
                    <label for='equipe'>Choisir l'equipe</label>
                    <select name='equipe' id='equipe'>
                        <?php 
                        $equipe = $bdd->query("SELECT * from equipe")->fetchAll(PDO::FETCH_ASSOC);
                        $option = "<option value='null'>Aucune equipe</option>";//penser a convertir le 'null' en NULL
                        foreach ($equipe as $key => $value) {
                            $option .= '<option value='.$equipe[$key]["id_equipe"].'>Equipe '.$equipe[$key]["nom"].'</option>';
                        }
                        echo $option;
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <button type='submit' form='add'>Valider</button>
    </form>
</body>
</html>