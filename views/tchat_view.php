<!doctype html>
<html>
<head>

    <?php include_once 'views/includes/head.php' ?>

    <title><?=ucfirst($page) ?></title>
</head>

<body>

<?php include_once 'views/includes/header.php';  debug($list_destinataires);?>

  
<div id="frame">
	<div id="sidepanel">
		<div id="profile">
			<div class="wrap">
				<img id="profile-img" src="<?php
                // affichage des avatars si la photo n'existe pas selon le sexe
                if (!empty($_SESSION['membre']['photo']))
                {
                    echo $_SESSION['membre']['photo'];
                }
                elseif (empty($_SESSION['membre']['photo']) && $_SESSION['membre']['sexe'] == "f")
                {
                    echo WEBSITE_URL.'assets/images/utilisateurs/avatar/femme.png' ;
                }
                else
                {
                    echo WEBSITE_URL.'assets/images/utilisateurs/avatar/homme.png' ;
                } ?>" class="online" alt="" />
				<p><?= $_SESSION['membre']['pseudo'] ?></p>
				<i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
				<div id="status-options">
					<ul>
						<li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
						<li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
						<li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
						<li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
					</ul>
				</div>
				<div id="expanded">
					<label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
					<input name="twitter" type="text" value="mikeross" />
					<label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>
					<input name="twitter" type="text" value="ross81" />
					<label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
					<input name="twitter" type="text" value="mike.ross" />
				</div>
			</div>
		</div>
		<div id="search">
			<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
			<input class="w-100" type="text" placeholder="Recherche un contact..." />
		</div>
		<div id="contacts">
			<ul style="margin-bottom:50px ;padding-left:0px;">
                <?php
                    // affichage de tout les membres dans la bare laterale gauche.
                    
                    // select le tout du membre dont le pseudo est different au pseudo du membre de la session afin d'éviter la répitition et dont le staturt est en ligne .
                    // afficher les  membres  selon que j'appuie un bouton :
                    // homme femme tout contact ou enligne seulement 
                    // hommes
                    if(isset($_GET['action']) && $_GET['action']=="homme"){
                    $user_connect=$pdo->query("SELECT * FROM membre WHERE pseudo != '$pseudo' and sexe='m' and statut=1") ;
                    }
                    //femmes
                    else if(isset($_GET['action']) && $_GET['action']=="femme"){
                        $user_connect=$pdo->query("SELECT * FROM membre WHERE pseudo != '$pseudo' and sexe='f' and statut=1") ;

                    }elseif(isset($_GET['action']) && $_GET['action']=="enligne_contact"){ //  affiche que les membres enligne
                        $user_connect=$pdo->query("SELECT * FROM membre WHERE pseudo != '$pseudo' and statut=1") ;
                    }// tout les contact
                    elseif (isset($_GET['action']) && $_GET['action']=="tout_contact"){
                        $user_connect=$pdo->query("SELECT * FROM membre WHERE pseudo != '$pseudo' ORDER BY  pseudo ASC " ) ;
                    }else{
                        // affichage des membres avec les enlignes en premier
                        $user_connect=$pdo->query("SELECT * FROM membre WHERE pseudo != '$pseudo' ORDER BY   statut DESC") ;
                    }
                    while($utilisateur_c=$user_connect-> fetch(PDO::FETCH_ASSOC)){ 
                        // si l'utilisateur est connecté
                      if($utilisateur_c['statut']==1){ ?>
                        <li class="contact">
                            <div class="wrap pb-4" >
                                <span class="contact-status online"></span>
                                <a href="?action=select&id_membre=<?php echo $utilisateur_c['id_membre'].'&pseudo='.$utilisateur_c['pseudo']  ?>">
                                <img src="<?php
                                            // affichage des avatars si la photo n'existe pas selon le sexe
                                            if(!empty($utilisateur_c['photo'])) {
                                                echo $utilisateur_c['photo'];
                                            }elseif(empty($utilisateur_c['photo']) && $utilisateur_c['sexe'] == "f" ){
                                                echo WEBSITE_URL .'assets/images/utilisateurs/avatar/femme.png' ;
                                            }else{
                                                echo WEBSITE_URL.'assets/images/utilisateurs/avatar/homme.png' ;
                                            } ?>" alt="photos utilisateur" />
                                        </a>
                                <div class="meta">
                                    <p class="name"><a href="?action=select&id_membre=<?php echo $utilisateur_c['id_membre'].'&pseudo='.$utilisateur_c['pseudo']  ?>"><?=  $utilisateur_c['pseudo'] . ' '.$utilisateur_c['age'].' ans' ?></a></p>
                                    <p class="preview">je suis ici pour trouver rien</p>
                                </div>
                            </div>
                        </li>
                    <?php }else{ // si l'utilisateur n'est pas connecté?>
                    <li class="contact">
                            <div class="wrap">
                                <span class="contact-status offline"></span>
                            <a href="?action=select&id_membre=<?php echo $utilisateur_c['id_membre'].'&pseudo='.$utilisateur_c['pseudo']  ?>">
                                <img src="<?php
                                            // affichage des avatars si la photo n'existe pas selon le sexe
                                            if(!empty($utilisateur_c['photo'])) {
                                                echo $utilisateur_c['photo'];
                                            }elseif(empty($utilisateur_c['photo']) && $utilisateur_c['sexe'] == "f" ){
                                                echo WEBSITE_URL .'assets/images/utilisateurs/avatar/femme.png' ;
                                            }else{
                                                echo WEBSITE_URL.'assets/images/utilisateurs/avatar/homme.png' ;
                                            } ?>" alt="photos utilisateur" />
                            </a>
                                <div class="meta">
                                    <p class="name"><a href="?action=select&id_membre=<?php echo $utilisateur_c['id_membre'].'&pseudo='.$utilisateur_c['pseudo']  ?>"><?=  $utilisateur_c['pseudo'] . ' '.$utilisateur_c['age'].' ans' ?></a></p>
                                    <p class="preview">je suis ici pour trouver rien</p>
                                </div>
                            </div>
                        </li>
                 <?php } }?>
			</ul>
		</div>
		<div id="bottom-bar" >
            <button ><a href="?action=homme"><span class="status-circle text-white ">Hommes enligne</span> </a></button>
			<button > <a href="?action=femme"><span  class="status-circle text-success">Femmes enligne</span></a></button>
			<button ><a href="?action=tout_contact" data-toggle="modal" data-target="#exampleModalLong"><span class="status-circle text-danger">Mes discussions</span> </a></button>
			<button > <a href="?action=enligne_contact"><span  class="status-circle text-warning">Contacts en ligne</span></a></button>
		</div>
   
	</div>
	
      <?php if (isset($_GET['action']) && $_GET['action']=='select'){ // si l'utilisateur a séléctionné un destinataire on affiche le résultat?>
        <div class="content">
		<div class="contact-profile">
			<img src="<?php if (isset($destinataire))
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
            ?>" alt="photo destinataire" />
			<p><?= $recupDestinataire->info_destinataire['pseudo'] .' '.' '. $recupDestinataire->info_destinataire['age'] . ' '. ' ans' ?></p>
			<div class="social-media">
				<i class="fa fa-facebook" aria-hidden="true"></i>
				<i class="fa fa-twitter" aria-hidden="true"></i>
				 <i class="fa fa-instagram" aria-hidden="true"></i>
			</div>
		</div>
		<div class="messages" style="background-color:skyblue">
        <div class="load_more" style="display:none;text-align:center" > <img src="http://localhost/discussion/assets/images/gif.gif" alt=""> </div>
			<ul id="resulat_message_sans_ajax">
                <?php
                    // affichage des messages : si l expiditeur est moi tu m'affiche les messages selon un style et sinon c'est avec un aure style .tout ca dans le while .
                    
                    while ($tout_message = $rec_tout_message->fetch(PDO::FETCH_ASSOC))
                    { 
                        // si le message n'est pas vide ou la photo n'est pas vide execute le if:
                        if (!empty($tout_message['messages']) || !empty($tout_message['image']))
                        {
                            if ($tout_message['expediteur'] == $pseudo)
                            { ?>

                        <li class="sent " >
                            <img src="<?php
                                // affichage des avatars si la photo n'existe pas selon le sexe
                                if (!empty($_SESSION['membre']['photo']))
                                {
                                    echo $_SESSION['membre']['photo'];
                                }
                                elseif (empty($_SESSION['membre']['photo']) && $_SESSION['membre']['sexe'] == "f")
                                {
                                    echo WEBSITE_URL.'assets/images/utilisateurs/avatar/femme.png' ;
                                }
                                else
                                {
                                    echo WEBSITE_URL.'assets/images/utilisateurs/avatar/homme.png' ;
                                } ?>" alt="" />
                            <?php
                                // message texte  s'il n'est pas vide s'affiche
                                if (!empty($tout_message['messages'])){
                                    echo '<p >';
                                    echo $tout_message['messages'];
                                    echo '</p>';
                                } 
                                    
                                

                                if (!empty($tout_message['image']))  {

                                    
                                    echo '<div> <img class="image_chat" width="250" height="250" src="'.$tout_message['image'] . '" style="display: block;
                                    width: 250px;
                                    border-radius: 0;" ></div>';
                                    
                                }
                                
                                ?>
                            
                        </li>
                       
                        <?php } // fermeture du if 
                        else { ?>
                        <li class="replies">
                            <img src="<?php if (isset($destinataire))
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
                            ?>" alt="" />
                            
                            <div style="display: flex;
                                flex-direction: column;
                                width: 40%;
                                margin-left: 54%;">
                                <?php
                                    // messages recus apparait s'il n'est pas vide
                                    if (!empty($tout_message['messages'])){ 
                                        echo '<p >' ;
                                        echo $tout_message['messages'] ;
                                        echo '</p>';
                                        }
                                    ?>
                                <?php
                                    // images recues
                                    if (!empty($tout_message['image'])){
                                    echo '<div> <a href="' . $tout_message['image'] . '" target="_blank" style="display: block;
                                    width: 100%;"><img width="250" height="250" src="' . $tout_message['image'] . '" style="display: block;
                                    width: 100%;
                                    border-radius: 0;" > </a></div>';
                                    } 
                                ?>
                            
                            </div>
                        </li>
                    <?php } // fin de else 
                } // fin de if
                 
            } // fin de while ?>
				
            </ul>
            <ul id="message_ajax">
               
				<!--  resultat ajax  -->
            </ul>
    
      <?php } // fin de la condition select
       else {?>
      <div class="content" style="background-image:url('http://localhost/discussion/assets/images/image_hors_ligne.jpg') ; background-size:cover">
       <div class="contenu_horligne"  >
             
        </div>
       
       <?php
        } // fin de else de select
      ?>
		
		<div class="message-input">
			<form class="wrap formulaire" id="form_tchat"  method="POST" enctype="multipart/form-data">
            <input id="message" type="text" name="messenger" placeholder="écris ton message ici..." />
                <i class="fa fa-paperclip attachment" aria-hidden="true" id="icone_file"></i>
                <input type="file" name="image" class="file" id="image_chat" style="display:none">
                <!-- input type hidden pour l'envoie du pseudo destinataire -->
                <input type="hidden" value="<?php echo $destinataire ?>" name="destinataire"  id="destinataire"  >
                <input type="hidden" value="<?php echo $pseudo ?>" name="pseudo"  id="pseudo"  >
                <button type="submit" class="submit" name="envoyer" id="envoyer"><i class="fa fa-paper-plane" aria-hidden="true" ></i></button>  
			</form>
		</div>
        <div class='reponse'></div>
	</div>
</div>
<div id='result'>
<div id='cover'></div>
</div>
              
<!-- modal des personnes avec qui je discute -->


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="modal_contact" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="modal_contact" style=padding-left:32%;>Liste de mes contacts</h5>
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
      <div class="modal-footer" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>





     <?php include_once 'views/includes/modal_membre.php'; ?>
     <?php include_once 'views/includes/footer.php'; ?>

</body>
</html>
