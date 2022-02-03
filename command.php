<?php 
// header("Location: html/index.php");

function bdd_connection(string $user="root",string $pass=""){
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=fcems', $user, $pass);
    } catch (PDOException $e) {
        echo "<script language=javascript>
        console.log('erreur " . $e->getMessage() ."');
    </script>";
        die();
    }
    echo "<script language=javascript>
        console.log('Page bien connectée à la base de données');
    </script>";
    return $dbh;
}

function traitement_date(string $var)
{
    // a finir , affichage de valeur sur article
}

function traitement_match($texte,$equipe){
    $bdd=bdd_connection();
    $infos=$bdd->query("select categorie.id,equipe.nom from categorie inner join equipe on categorie.equipe = equipe.id_equipe where categorie.categorie = '".$equipe."'")->fetch();
    $result=[];
    var_dump($infos);
    foreach(explode("info : ",$texte) as $key => $value) {
    echo $value;
    $result["nom"]=explode($infos["nom"],$value)[0];
    }






    if(!empty($result)){
        return $result;
    } else {
        return "error";
    }
}

// voir si pas usine a gaz
function get_rank(string $rank="entraineur"){
    $nb=0;
    switch ($rank) {
        case 'admin':
            $nb===4;
            break;
        case 'president':
        case 'conseil administration':
            $nb===3;
            break;
        case 'staff':
            $nb===2;
            break;
        case 'entraineur':
            $nb===1;
            break;
        default:
            $nb===0;
            break;
    }
    return $nb;
}
?>