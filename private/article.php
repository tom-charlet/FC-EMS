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
$bdd=bdd_connection();

if(isset($_POST["delete"])){
    $bdd->query("'delete from article where id = ".$_POST["delete"]."'");
    $image=$bdd->query("select nom,id_media from media where article = '".$_POST["delete"]."'")->fetchAll();
    foreach ($image as $key => $value) {
        if(unlink("../img/".explode("|",$image[$key]["nom"])[0])){
            $bdd->query("'delete from media where article = ".$_POST["delete"]."'");
            echo "<script language=javascript>
            console.log('supresion de ".explode("|",$image[$key]["nom"])[0]."');
            </script>";
        } else {
            echo "<script language=javascript>
            console.log('probleme de supresion de ".explode("|",$image[$key]["nom"])[0]."');
            </script>";
        }
    }
    echo "supr termine";
}

if(isset($_POST["edit"])){
    $_SESSION["article"]=$bdd->query("SELECT * from article where id_article = ".$_POST["edit"]."")->fetch();
    $_SESSION["article"]["action"]="edit";
}


if(!isset($_SESSION["article"])){
    $_SESSION["article"]=[];
}
if(isset($_POST["id_article"])){$_SESSION["article"]["id_article"]=$_POST["id_article"];}
if(isset($_POST["titre"])){$_SESSION["article"]["titre"]=$_POST["titre"];}
if(isset($_POST["keyword"])){$_SESSION["article"]["keyword"]=$_POST["keyword"];}
if(isset($_POST["sub"])){$_SESSION["article"]["sub"]=$_POST["sub"];}
if(isset($_POST["texte"])){$_SESSION["article"]["texte"]=$_POST["texte"];}
if(isset($_POST["date"])){$_SESSION["article"]["date"]=$_POST["date"];}
if(isset($_POST["type"])){$_SESSION["article"]["type"]=$_POST["type"];}

// (fait) revoir les test de premier if pour pallier  un manque de certaines info

// traitement creation
if(isset($_POST["type"])&&isset($_POST["type"])&&isset($_POST["titre"])&&isset($_POST["sub"])&&isset($_POST["texte"])&&isset($_POST["keyword"])){
        var_dump($_FILES);
        $rep=$bdd->query("select * from article where titre = '".$_SESSION["titre"]."'")->fetch();
        if(empty($rep)){
        //     if($_SESSION["article"]["action"]==="edit"){    
        //         if($bdd->query("UPDATE 'article' SET 'titre'='".$_SESSION["article"]["titre"]."','keyword'='".$_SESSION["article"]["keyword"]."','sub'='".$_SESSION["article"]["sub"]."','texte'='".$_SESSION["article"]["texte"]."','auteur'=".$_SESSION["article"]["auteur"].",'date'='".$_SESSION["article"]["date"]."','type'='".$_SESSION["article"]["type"]."' WHERE id_article = ".$_SESSION["token"]["id"]."")){
        //         echo '<div id="error">L article a bien ete modif</div>';
        //         }
        //     } else {
        //         if($bdd->query("INSERT INTO 'article'('titre', 'keyword', 'sub', 'texte', 'auteur', 'date', 'type') VALUES ('".$_SESSION["article"]["titre"]."','".$_SESSION["article"]["keyword"]."','".$_SESSION["article"]["sub"]."',
        //         '".$_SESSION["article"]["texte"]."',".$_SESSION["token"]["id"].",'".$_SESSION["article"]["date"]."','".$_SESSION["article"]["type"]."')")){
        //             echo '<div id="error">L article a bien ete creer</div>';
        //             }
        //     }
        // unset($_SESSION["article"]);
    } else {
        echo '<div id="error">Le titre existe deja</div>';
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
    <table>
        <tr>
            <th><p>Titre</p></th>
            <th><p>Date</p></th>
            <th><p>Mots-Clefs</p></th>
            <th><p>Action</p></th>
        </tr>
    <?php 
    $article=$bdd->query("select * from article order by 'id_article' desc")->fetchAll();


    //finir les boutons de suppr et edit
    
    
    foreach ($article as $key => $value) {
        echo "<tr> 
        <td>".$article[$key]["titre"]."</td>
        <td>".$article[$key]["date"]."</td>
        <td>".$article[$key]["keyword"]."</td>
        <td>
        <form id='form".$article[$key]["id_article"]."-delete' method='post'>
            <input type='hidden' name='delete' value=".$article[$key]["id_article"].">
            <button type='submit' form='form".$article[$key]["id_article"]."-delete'><img src='../assets/bin.svg' alt='poubelle'></button>
        </form>
        <form id='form".$article[$key]["id_article"]."-edit' method='post'>
            <input type='hidden' name='edit' value=".$article[$key]["id_article"].">
            <button type='submit' form='form".$article[$key]["id_article"]."-edit'><img src='../assets/edit.svg' alt=''></button>
        </form>
        </td>
        </tr>";
    }
    ?>
    </table>
    <form method="post">
        <button name="add" type="submit" <?php if(isset($_SESSION["joueur"]["action"])&&$_SESSION["joueur"]["action"]!=="add"){echo "class='grey'";}?>>Ajouter un Article</button>
    </form>
    <?php
    var_dump($_POST);
    if(isset($_POST["add"])){
        unset($_SESSION["article"]);
    }
    // affichage formulaire pour edit et ajout 
    if(isset($_POST["edit"])||isset($_POST["add"])){
        echo '<div id="form-article">
        <form action="" method="post" enctype="multipart/form-data">
            <div id="part1">
                <label for="type1"><img src="../icon/form1.jpg" alt="template d article 1" srcset=""></label>
                <input type="radio" name="type" id="type1" value="type1" '.($a=(isset($_SESSION["article"]["type"])&&$_SESSION["article"]["type"]==="type1")?'checked="checked"':'').'>
                <label for="type2"><img src="../icon/form2.jpg" alt="template d article 2" srcset=""></label>
                <input type="radio" name="type" id="type2" value="type2" '.($a=(isset($_SESSION["article"]["type"])&&$_SESSION["article"]["type"]==="type2")?'checked="checked"':'') .'>
            </div>
            <div id="part2">
                './*Transimssion id pour modification*/($a=(isset($_SESSION["article"]["id_article"]))?'input type="hidden" name="id_article" value="'.$_SESSION["article"]["id_article"].'">':"").'
                <!-- form a gerer en js (a voir)-->

                <p>
                    <label for="titre">Titre</label>
                    <input type="text" name="user" id ="user" maxlength="80" required '.($a=(isset($_SESSION["article"]["titre"]))?'value="'.$_SESSION["article"]["titre"].'"':"").'>
                </p>
                <p>
                    <label for="sub">Phrase d accroche</label>
                    <textarea id="sub" name="sub" rows="10" cols="33" maxlength="500" required >'.($a=(isset($_SESSION["article"]["sub"]))?$_SESSION["article"]["sub"]:"").'</textarea>
                </p>
                <p>
                    <label for="upload">Photo</label>
                    <input type="file" name="upload" id="upload" >
                    <label for="pic-desc">Description photo (si il y a plusieurs photos, les descriptions sont automatiques)</label>
                    <input type="text" name="pic-desc" id ="pic-desc" size="25" maxlength="80" required>
                </p>
                <p>
                    <label for="texte">Texte</label>
                    <textarea id="texte" name="texte" rows="10" cols="33" required>'.($a=(isset($_SESSION["article"]["texte"]))?$_SESSION["article"]["texte"]:"").'</textarea>
                </p>
                <p>
                    <label for="keyword">Mots clefs (séparé par des ";")</label>
                    <input type="text" name="keyword" id ="keyword" maxlength="100" required '.($a=(isset($_SESSION["article"]["keyword"]))?'value="'.$_SESSION["article"]["keyword"].'"':"").'>
                </p>
                <p>
                    <label for="date">Date</label>
                    <input type="text" name="date" id ="date" maxlength="20" required placeholder="Format Année Mois Jour" '.($a=(isset($_SESSION["article"]["date"]))?'value="'.$_SESSION["article"]["date"].'"':"").'>
                </p>
                
            </div>
            <button type="submit">Ajouter l article</button>
        </form>
    </div>';
    }
    
    ?>
    <script src="admin.js"></script>
</body>
</html>