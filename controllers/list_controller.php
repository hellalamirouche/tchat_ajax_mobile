<?php 

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

// affichage de tout les membres dans la bare laterale gauche.
                            
    if(isset($_GET['action']) && $_GET['action']=="enligne_contact"){ //  affiche que les membres enligne
            $user_connect=$pdo->query("SELECT * FROM membre WHERE pseudo != '$pseudo' and statut=1") ;
        }// tout les contact
        elseif (isset($_GET['action']) && $_GET['action']=="tout_contact"){
            $user_connect=$pdo->query("SELECT * FROM membre WHERE pseudo != '$pseudo' ORDER BY  pseudo ASC " ) ;
        }else{
            // affichage des membres avec les enlignes en premier
            $user_connect=$pdo->query("SELECT * FROM membre WHERE pseudo != '$pseudo' ORDER BY   statut DESC") ;
        }


      // selectionné tout les messages dont le statut est non pour la lecture afin de les affichés pour chaque expediteur dans la liste des contacts 
    //    je l'ai fait en ajax aussi mais pour que sa fonctionne mm si on desactive javascript
      $selectMessageNonLU= $pdo->query("SELECT distinct  expediteur FROM messages WHERE destinataire= '$pseudo' and lecture='non'" ) ;
      $selectMessageNonLU->execute();
      $nombreMessageNonLu=$selectMessageNonLU->rowCount();
      while($messageNonLu=$selectMessageNonLU -> fetch(PDO::FETCH_ASSOC)){
        // creer la liste pour la verifier avec in_array() pour comparer dans list_view
        $list_utilisateur_avec_nouveau_message=array( $messageNonLu['expediteur']);

         }   
         
         
?>
    
