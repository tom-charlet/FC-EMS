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
    $image=$bdd->query("select nom,id-media from media where article = '".$_POST["delete"]."'")->fetchAll();
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

if(isset($_POST["edit"])){$_SESSION["article"]=$bdd->query("select * form article where id-article = ".$_POST["edit"]."")->fetch();}

//  A finir

if(isset($_POST["type"])&&isset($_POST["titre"])&&isset($_POST["sub"])&&isset($_POST["texte"])&&isset($_POST["keyword"])){
    $rep=$bdd->query("select * from article where titre = '".$_POST["titre"]."'")->fetch();
    if(empty($rep)){
        
// gerer insertion données

    } else {
        echo '<div id="error">Le titre existe deja</div>';
        $_SESSION["article"]=["type"=>$_POST["type"],"titre"=>$_POST["titre"],"sub"=>$_POST["sub"],"texte"=>$_POST["texte"],"keyword"=>$_POST["keyword"]];
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
    $article=$bdd->query("select * from article order by 'id-article' desc")->fetchAll();


    //finir les boutons de suppr et edit
    
    
    foreach ($article as $key => $value) {
        echo "<tr> 
        <td>".$article[$key]["titre"]."</td>
        <td>".$article[$key]["date"]."</td>
        <td>".$article[$key]["keyword"]."</td>
        <td>
        <form id='form".$article[$key]["id-article"]."-delete'>
            <input type='hidden' name='delete' value='".$article[$key]["id-article"]."'>
            <button type='submit' form='form".$article[$key]["id-article"]."-delete'><img src='../icon/seo-social-web-network-internet_262_icon-icons.com_61518.svg' alt='poubelle'></button>
        </form>
        <form id='form".$article[$key]["id-article"]."-edit'>
            <input type='hidden' name='edit' value='".$article[$key]["id-article"]."'>
            <button type='submit' form='form".$article[$key]["id-article"]."-edit'><img src='../icon/' alt=''></button>
        </form>
        </td>
        </tr>";
    }
    ?>
    </table>
    <div class="button">
        <p>Ajouter un article</p>
    </div>
    <div id="form-article">
        <form action="" method="post">
            <div id="part1">
                <label for="type1"><img src="../icon/form1.jpg" alt="template d article 1" srcset=""></label>
                <input type="radio" name="type" id="type1" value="type1" <?php if(isset($_SESSION["article"])&&$_SESSION["article"]["type"]==="type1"){echo 'checked="checked"';} ?>>
                <label for="type2"><img src="../icon/form2.jpg" alt="template d article 2" srcset=""></label>
                <input type="radio" name="type" id="type2" value="type2" <?php if(isset($_SESSION["article"])&&$_SESSION["article"]["type"]==="type2"){echo 'checked="checked"';} ?>>
                <label for="type3"><img src="../icon/form3.jpg" alt="template d article 3" srcset=""></label>
                <input type="radio" name="type" id="type3" value="type3" <?php if(isset($_SESSION["article"])&&$_SESSION["article"]["type"]==="type3"){echo 'checked="checked"';} ?>>
            </div>
            <div id="part2">
                
                <!-- form a gerer en js -->
                <!-- type1 -->
                <p>
                    <label for="titre">Titre</label>
                    <input type='text' name='user' id ='user' maxlength="80" required <?php if(isset($_SESSION["article"])){echo "value='".$_SESSION["article"]["titre"]."'";} ?>>
                </p>
                <p>
                    <label for="sub">Phrase d accroche</label>
                    <textarea id="sub" name="sub" rows="10" cols="33" maxlength="500" required >
                        <?php if(isset($_SESSION["article"])){echo $_SESSION["article"]["sub"];} ?>
                    </textarea>
                </p>
                <p>
                    <label for="upload">Photo</label>
                    <input type="file" name="upload" id="upload" >
                    <label for="pic-desc">Description photo</label>
                    <input type='text' name='pic-desc' id ='pic-desc' size='25' maxlength="80" required>
                </p>
                <p>
                    <label for="texte">Texte</label>
                    <textarea id="texte" name="texte" rows="10" cols="33" required>
                        <?php if(isset($_SESSION["article"])){echo $_SESSION["article"]["texte"];} ?>
                    </textarea>
                </p>
                <p>
                    <label for="keyword">Mots clefs (séparé par des ";")</label>
                    <input type='text' name='keyword' id ='keyword' maxlength="100" required <?php if(isset($_SESSION["article"])){echo "value='".$_SESSION["article"]["keyword"]."'";} ?>>
                </p>
                <!-- type 2 -->
            </div>
            <button type="submit">Ajouter l article</button>
        </form>
    </div>
    <script src="admin.js"></script>
</body>
</html>