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
//pour generer des noms
function nom(){
    $long=rand(15,25);
    $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $nom="";
    for ($i=0; $i < $long; $i++) { 
        $nom=$nom.substr($letters,rand(0,strlen($letters)),1);
    }
    return $nom;
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

function traitement_match($nomEquipe){
    /************recuperation des noms d'equipes*******/
    //connexion bdd
    $bdd=bdd_connection();
    //requete sql
    $res = $bdd->query("SELECT lien FROM categorie where categorie = '".$nomEquipe."'")->fetch(PDO::FETCH_LAZY);
    //tableau des equipes
    var_dump($res);
    //echo "</br>".($res[4][0]);
    $lien=explode("|",$res["categorie"])[0];
    $nom_eqp=explode("|",$res["categorie"])[1];
    //appel des fonctions + renvoye bdd


    // L'URL du site à scraper 
    // A Changer 
    $url = 'https://www.fff.fr/competition/club/552519-f-c-eure-madrie-seine/equipe/2021121182SEM1/resultats-et-calendrier.html';
    //echo '<pre>';
    $code = scraper($url);
    //echo '</pre>';
    /***
    Code d'un scraper avec Curl réalisé par Julien Cordier
    ***/
    function scraper ($url) {
    //permet de récupérer le contenu d'une page
    // User Agent
    $ua = 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_URL, $url );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    // le scraper suit les redirections
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $result = curl_exec($ch);
    curl_close ( $ch );
    return $result;
    }
    
    preg_match_all('/<div class="uppercase margin_b20 compet_nom bold">(.*?)<!-- .aside_resultat_match -->/s', $code, $matches);
    //var_dump($matches);

    $tab=$matches[1];

    function data_tri($tab,$cutWord){
        for ($i = 0; $i < count($tab); $i++) {
            echo "info : ".strip_tags($tab[$i])."";
            $test=strip_tags($tab[$i]);
            //echo $test;
            $cutWord="Senior";
            
            $coupe1=explode($cutWord,$test);
            $coupe2=explode(" - ",$coupe1[1],4);
            $comp=$coupe1[0];
            $date_m=$coupe2[1]." ".substr($coupe2[2], 0, 5);
            //var_dump($coupe2);
            $ekp_un=substr($coupe2[2], 6, -3);
            //$res_ekp_un=substr($coupe2[2],-2);
            $score=substr($coupe2[2],-2)." - ".substr($coupe2[3], 0, 4);
            $ekp_deux=substr($coupe2[3], 3, -1);
            //$res_ekp_deux=substr($coupe2[3], 0, 4);
            
            /*
            echo "</br>";
            //var_dump($coupe2);
            echo "competition :". $comp."</br>";
            echo "date :". $date_m."</br>";
            echo "equipe 1 :". $ekp_un."</br>";
            //echo "score ekp 1 :". $res_ekp_un."</br>";
            echo "score :".$score."</br>";
            echo "equipe 2 :". $ekp_deux."</br></br></br>";
            //echo "score ekp 2 :". $res_ekp_deux."</br></br></br>";
            */
            //la var match contient une ligne pour chaque match decoupé 
            $match[$i]=['coupe'=>$comp,'date'=>$date_m,'equipe1'=>$ekp_un,'equipe2'=>$ekp_deux,'score'=>$score];
        }
        return $match;
    }
    data_tri($tab,$nom_eqp);
    function insertion_Match(array $match,int $cat){
        $bdd=bdd_connection();
        //Loop pour tout les match
        foreach ($match as $key => $value) {
            
            //Ajout de match 
            if($bdd->query("INSERT INTO rencontre (categorie,nom,`date`,equipe_int,equipe_ext,score) VALUES (".$cat.",'".$value["coupe"]."')")){}
        }
    }

}


?>