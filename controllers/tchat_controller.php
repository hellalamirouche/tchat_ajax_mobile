<?php 
 // inclure la classe de verif photo
 include_once "_classes/chat/photo_chat.php";
 //
 include_once "_classes/chat/rec_destinataire_on_select.php";

//le pseudo du membre connecté :
$pseudo= $_SESSION['membre']['pseudo'];
$sexe=$_SESSION['membre']['sexe'];
// si tu n'es pas connecté :
if(!isconnected()){
    header("location:index.php");  // si l'utilisateur n'est pas connecté il se redérige vers connexion.php
    exit();
}

//déconnexion avec la fonction dans function.php
if(isset($_GET['action']) && $_GET['action']=='deconnexion' ){ //si l'indice action exite dans le chemin GET de l url deconnexion  dans le lien deconnexion de la page nav : execute moi cette fonction qui va me rederiger vers connexion
    Deconnexion();// fontion de deconnexion
}

/* recuperation information du destinataire en appuiyant sur son icone select dans le chat .
   avec la class Recup_desinataire */
  $recupDestinataire= new Recup_desinataire(); 
// insertion de $recupDestinataire->info_destinataire['age'] , ['sexe'] , ['photo']  chat_view.php pour affivher les données du destinataire



// récupération de tout les messages entre deux personnes:

$rec_tout_message=$pdo->query("SELECT * FROM (
    SELECT * FROM messages WHERE expediteur='$pseudo' AND destinataire = '$destinataire' OR expediteur='$destinataire' AND destinataire = '$pseudo' ORDER BY id_message DESC limit 10 ) sub ORDER BY id_message ASC  ");
$rec_tout_message->execute();

// affichage des message avec la boucle while dans view 

// liste des persinnes avec qui je discute
$rec_mes_message=$pdo->prepare("SELECT *
FROM membre
INNER JOIN mes_discussion ON membre.pseudo = mes_discussion.destinataire and expediteur = '$pseudo' and etat_contact='1' ");
$rec_mes_message->execute();
// affichage avec la boucle dans view

// suppression des listes de contactes avec qui je discute 
if (isset($_GET['action'])&& $_GET['action']=='supprimer')  {
    
    $dest = $_GET['destinataire'];
    
    $suppression_contact_de_ma_liste=$pdo->query(" UPDATE mes_discussion SET etat_contact = '0' WHERE expediteur='$pseudo' and destinataire='$dest' ");
    $suppression_contact_de_ma_liste->execute();
}  

//empecher le renvoie du formulaire et l'icone qui nous invite a accepter le renvoie du formulaire
if(isset($_POST['envoyer']) ){
    //ce code sert à renvoyer sur la meme page
    $fichierActuel = $_SERVER['PHP_SELF'] ;
    if(!empty($_SERVER['QUERY_STRING']))
    {
        $fichierActuel .= '?' . $_SERVER['QUERY_STRING'] ;
    }
    
        header('Location: ' . $fichierActuel);
        exit;
        
}




/***************************************************************************************************************** */
 



//recuperation du nombre de messages recus par le destinataire pour faire les notif avec ajax :
    // $nombremessage=$pdo->query("SELECT COUNT('id-message') FROM messages WHERE destinataire='$pseudo' and expediteur='$destinataire'");
    // $nombremessage->execute();
    // $ligne=$nombremessage->fetch(PDO::FETCH_ASSOC);
    // $nombre=$ligne["COUNT('id-message')"];

?>
    
