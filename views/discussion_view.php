<!doctype html>
<html>
<head>

    <?php include_once 'views/includes/head.php' ?>

    <title><?=ucfirst($page) ?></title>
</head>

<body>

<?php include_once 'views/includes/header.php'; ?>


<div class="col-md-8 px-0 " id="discussion" >

<?php if (isset($_GET['action']) && $_GET['action']=='select'){ // si l'utilisateur a séléctionné un destinataire on affiche le résultat?>
                <div class="row col-12 mx-auto px-0 contenu_discussion " >
                    
                    <div class=" row col-12 affiche_liste d-flex mx-0 pt-md-3 pt-2" id="header-discussion">
                        <p id="les_contact" class="col-6 pb-4 text-left d-md-none"> <a href="?page=list">Liste de contacts </a> </p>
                        <i  class=" col-6 col-md-12  fa fa-comments fa-2x  text-right pb-4 "  data-toggle="modal" data-target="#modal_list_discussion" aria-hidden="true"></i> 
                    </div>
                       
                    <ul class=" list-group col-12 px-0 position-sticky sticky-top  " >
                        <li class="list-group-item nom-contact-selectionne "> 
                            <a href="#" ><?= $recupDestinataire->info_destinataire['pseudo'] .' '.' '. $recupDestinataire->info_destinataire['age'] . ' '. ' ans' ?> <img class="  avatar" src="<?php if (isset           ($destinataire))
                                // affichage des avatars si la photo n'existe pas selon le sexe
                                if (!empty($recupDestinataire->info_destinataire['photo']))
                                {
                                    echo $recupDestinataire->info_destinataire['photo'];
                                }
                                elseif (empty($recupDestinataire->info_destinataire['photo']) && $recupDestinataire->info_destinataire['sexe'] == "f")
                                {
                                    echo WEBSITE_URL.'assets/images/utilisateurs/avatar/femme.png' ;
                                    
                                }
                                else
                                {
                                    echo WEBSITE_URL.'assets/images/utilisateurs/avatar/homme.png' ;

                                }
                                ?>" alt=""> 
                            </a>
                        </li>     
                    </ul>
                    <div class="col-12 discussion " id="resulat_message_sans_ajax">
                        <?php
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
                                        
                                    
                                     if(!empty($tout_message['image'])){

                                      

                                    }
                                   
                                ?>
                                    
                            </div>
                        </div>
                        <?php } // fermeture du if 
                        else { ?>
                        <div class="message-recu row col-11 mx-0 col-md-10 offset-sm-2 d-flex  px-0 mt-4 align-items-center">
                            <img class="avatar-msg image_message-recu col-2 px-0 img-fluid" src="
                                <?php if (isset           ($destinataire))
                                // affichage des avatars si la photo n'existe pas selon le sexe
                                if (!empty($recupDestinataire->info_destinataire['photo']))
                                {
                                    echo $recupDestinataire->info_destinataire['photo'];
                                }
                                elseif (empty($recupDestinataire->info_destinataire['photo']) && $recupDestinataire->info_destinataire['sexe'] == "f")
                                {
                                    echo WEBSITE_URL.'assets/images/utilisateurs/avatar/femme.png' ;
                                    
                                }
                                else
                                {
                                    echo WEBSITE_URL.'assets/images/utilisateurs/avatar/homme.png' ;

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
                                   
                                    // images recues
                                    if (!empty($tout_message['image'])){
                                    echo '<div> <a href="' . $tout_message['image'] . '" target="_blank" style="display: block;
                                    width: 100%;"><img class="image_chat w-100" src="' . $tout_message['image'] . '" style="display: block;
                                    width: 100%;
                                    border-radius: 0;" > </a></div>';
                                    } 
                                ?>
                                    
                            </div>
                        </div>
                        
                        <?php 
                                    } // fin de else 
                                } // fin de if
                                
                            } // fin de while 
                        ?>
                        
                    </div>
                    <div class="col-12 discussion " id="message_ajax">
               
                        <!--  resultat ajax  -->
                    </div>
                    <!-- formulaire de message -->
                     
                    <form  class=" formulaire row mx-auto  col-12 px-0 " id="form_tchat"  method="POST" enctype="multipart/form-data">
                        <input class="col-8 col-md-10 h-100" id="message" type="text" name="messenger" placeholder="écris ton message ici..." />
                        <input type="file" name="image" class="file  h-100" id="image_chat" style="display:none">
                        <i id="file_icone" class="  fa fa-paperclip  col-2 col-md-1 pt-2" aria-hidden="true" id="icone_file"></i>
                            <!-- input type hidden pour l'envoie du pseudo destinataire -->
                        <input type="hidden" value="<?php echo $destinataire ?>" name="destinataire"  id="destinataire"  >
                        <input type="hidden" value="<?php echo $pseudo ?>" name="pseudo"  id="pseudo"  >
                         <!-- le dernier id message que j'envoie par ajax -->
                       <input id="dernier_message" type="hidden" name="lastMessage" value="<?php echo $dernierId['max_id_message'] ?>">
                        <button type="submit" class="submit h-100 col-2 col-md-1 " name="envoyer" id="envoyer"><i class="fa fa-paper-plane icone_envoyer_tchat " aria-hidden="true" ></i></button>  
                    </form>
                    
                    <?php } // fin de select ?>
                </div>
                
            </div>
           
        </div>

      
      <!-- Modal liste de mes discussions -->
      <div class="modal fade" id="modal_list_discussion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <ul class="list-group">
                            <!-- // affichage de la liste des membres avec qui je discute --> 
                               <?php
                               $nombredecontact=intval($rec_mes_message->rowCount());
                               for( $i=0 ;$i<$nombredecontact;$i++){  
                                  $list_destinataires=$rec_mes_message->fetch(PDO::FETCH_ASSOC) ?>
                                   <li id="colone_list_contact_<?= $i ?>" class="list-group-item d-flex justify-content-between align-items-center" style="display:flex;">
                                      <a href="?action=select&id_membre=<?php echo $list_destinataires['id_membre'].'&pseudo='.$list_destinataires['pseudo']  ?>"><?php echo $list_destinataires['pseudo'] . ' ' . $list_destinataires ['sexe'] . ' ' . $list_destinataires ['age'] ?>
                                       <span class="badge badge-primary badge-pill">14</span> <?php if($list_destinataires['statut']==1){
                                           echo '<span class="badge badge-success badge-pill"> Connecté </span>';
                                       } else { echo '<span class="badge badge-danger badge-pill"> deconnecté</span>';
                                       }
                                        ?>  </a>  
                                        <a href="?action=supprimer&destinataire=<?= $list_destinataires['pseudo'] ?>">
                                        <img id="suppression_contact_<?= $i ?>" src="https://img.icons8.com/metro/26/000000/trash.png"> 
                                        </a>
                                        
                                   </li>
                                  
                                   <?php  }   //fin  ?> 
                                   <!-- // recuperation de la valeur finale de $i de la boucle for pour liste de mes contact afin de la récuperer dans le fichier ajax.php et d'utiliser une boucle labas selon le nombre de bouton generer avec les contacts -->
                                  <?php 
                                  // affichage du  message qui m'invite a selectionner un contact
                                  if ($i=0){?>
                                  <p class="text-center"> Veuillez selectionner un contact pour le voir ici </p>
                                  <?php } ?>
            
                                    
                            </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      

      <?php include_once 'views/includes/modal_membre.php'; ?>
     <?php include_once 'views/includes/footer.php'; ?>

</body>
</html>