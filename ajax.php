<?php
// // Inclusion des fichiers principaux
// $pdo = new PDO('mysql:host=localhost;dbname=tchat-amirouche;charset=utf8', 'root', '');
// // session start pour recuperer le pseudo
// session_start();
// $pseudo=$_SESSION['membre']['pseudo'];
// /* supprimer le personne de ta liste de discussion */
// // recuperation de la valeur de l'input hidden envoyer dans la requete dans ajax.js
// if( $_REQUEST["destinataire"] ) {

//    $destinataire = $_REQUEST['destinataire'];
   
//    $suppression_contact_de_ma_liste=$pdo->query(" UPDATE mes_discussion SET etat_contact = '0' WHERE expediteur='$pseudo' and destinataire='$destinataire'");
// }


   
// // Inclusion des fichiers principaux
$pdo = new PDO('mysql:host=localhost;dbname=tchat-amirouche;charset=utf8', 'root', '');
 // inclure la classe de verif photo
 include_once "_classes/chat/photo_chat.php";
 //
 include_once "_classes/chat/rec_destinataire.php";
 include_once "_functions/functions.php";
 include_once "_config/config.php";
  session_start();

 // avec ce code on évite le renvoie du formulaire a chaque rafraichissement de la page .
    //1 on récupere le POST du message dans une variable $_POST
     $message=htmlentities($_POST['messenger']);
     $pseudo=htmlentities($_POST['pseudo']);
     $destinataire=htmlentities($_POST['destinataire']);
   
    
/* recuperation information du destinataire pour afficher sa photos dans les messages recus
avec la class Recup_desinataire */

    
  // recuperation du destinataire en cliquant sur select un destinataire de chat
  $destinataire_ajax=$pdo->query("SELECT * FROM membre WHERE pseudo = '$destinataire'");
  $destinataire_ajax->execute();
  $info_destinataire=$destinataire_ajax->fetch(PDO::FETCH_ASSOC);
  


 

    

    
    // inclure la classe de verification de la photo  s'elle n'est pas vide.
    
        $verif_photo_chat= new Verif_photo_chat(); 
         // verifier la photo envoyer par le chat
        $verif_photo_chat->verifPhotoChat();
        // affecté la valeur de la photo issue du traitement dans la classe Verif_photo_chat à la variable $photo_envoye_chat pour l'inserer à la base de donnée
        $photo_envoye_chat=$verif_photo_chat->photo; 
       
        // verif de l'existence de la discussion deja
        //verification de l'existence ou pas de l'id message ou l'expediteur est moi 
          insert_id_discussion() ; // elle se trouve dans function .php 
           
        if(empty($msg)){
            
            insert_message();
            
            }
        // mettre a jour le statut à  pour l'ajouter à ta liste de siscussions 
        $mettre_ajour_statut_discussion=$pdo->query("UPDATE mes_discussion SET etat_contact = '1' WHERE expediteur='$pseudo' and destinataire='$destinataire'");
        
  


      
        $rec_tout_message=$pdo->query("SELECT * FROM (
        SELECT * FROM messages WHERE  expediteur='$pseudo' AND destinataire = '$destinataire' OR expediteur='$destinataire' AND destinataire = '$pseudo' ORDER BY id_message DESC limit 8 ) sub ORDER BY id_message ASC  ");
        $rec_tout_message->execute();
        // affichage des messages : si l expiditeur est moi tu m'affiche les messages selon un style et sinon c'est avec un aure style .tout ca dans le while .

    
        while ($tout_message = $rec_tout_message->fetch(PDO::FETCH_ASSOC)) { 
            // si le message n'est pas vide ou la photo n'est pas vide execute le if:
            if (!empty($tout_message['messages']) || !empty($tout_message['image'])) {
                if ($tout_message['expediteur'] == $pseudo) { 
    ?>
    <div class="message-envoye row col-md-10 d-flex mt-4 px-0 align-items-center">
        <div class="text-message-envoyer">
            <?php
                // message texte  s'il n'est pas vide s'affiche
                if (!empty($tout_message['messages'])){
                    echo '<p >';
                    echo $tout_message['messages'];
                    echo '</p>';
                } 

                // message photo
                if (!empty($tout_message['image']))  {
                    
                    // les extentions autorisées:
                    $extention = strtolower(  substr(  strrchr($tout_message['image'], '.')  ,1)  );// extraire l'extention
                    $extention_img = array("png", "jpg", "jpeg" ) ;
                    $extention_doc=array("pdf","doc");
                    if(in_array($extention, $extention_img)){// tester si cette extention est une image
                    
                        
                            echo '<div> <img class="image_chat w-100" width="250" height="250" src="'.$tout_message['image'] . '" style="display: block;
                            width: 250px;
                            border-radius: 0;" ></div>';
                     }
                     elseif(in_array($extention, $extention_doc)){
                     
                         echo'<div class="text-center"> <a class="text-danger" href="'.$tout_message['image'] . '">Téléchargement</a></div>' ;
                        
                    }

            
                }
            
                    
                
            ?>
                
        </div>
    </div>
    <?php } // fermeture du if 
    else { ?>
    <div class="message-recu row col-11 mx-0 col-md-10 offset-sm-2 d-flex  px-0 mt-4 align-items-center">
        <img class="avatar-msg image_message-recu col-2 px-0 img-fluid" src="
            <?php 
                if (!empty($info_destinataire['photo'])){
                // affichage des avatars si la photo n'existe pas selon le sexe
                if (!empty($info_destinataire['photo']))
                {
                    echo $info_destinataire['photo'];
                }
                elseif (empty($info_destinataire['photo']) && $info_destinataire['sexe'] == "f")
                {
                    echo '/assets/images/utilisateurs/avatar/femme.png' ;
                    
                }
                else
                {
                    echo '/assets/images/utilisateurs/avatar/homme.png' ;

                }
            }
            ?>" 
        alt="recu">
        <div class="text-message-recu col-10 col-lg-8">
            
            <?php
                // messages recus apparait s'il n'est pas vide
                if (!empty($tout_message['messages'])){ 
                    echo '<p >' ;
                    echo $tout_message['messages'] ;
                    echo '</p>';
                }
               
              // message photo
              if (!empty($tout_message['image']))  {
                    
                // les extentions autorisées:
                $extention = strtolower(  substr(  strrchr($tout_message['image'], '.')  ,1)  );// extraire l'extention
                $extention_img = array("png", "jpg", "jpeg" ) ;
                $extention_doc=array("pdf","doc");
                if(in_array($extention, $extention_img)){// tester si cette extention est une image
                
                    
                        echo '<div> <img class="image_chat w-100" width="250" height="250" src="'.$tout_message['image'] . '" style="display: block;
                        width: 250px;
                        border-radius: 0;" ></div>';
                 }
                 elseif(in_array($extention, $extention_doc)){
                 
                     echo'<div class="text-center"> <a class="text-danger" href="'.$tout_message['image'] . '">Téléchargement</a></div>' ;
                    
                }

        
            }
            ?>
                
        </div>
    </div>
    
    <?php 
                } // fin de else 
            } // fin de if
            
        } // fin de while  
    
    ?>
    

