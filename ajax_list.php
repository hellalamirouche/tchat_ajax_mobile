<?php
  
// // Inclusion des fichiers principaux
$pdo = new PDO('mysql:host=localhost;dbname=tchat-amirouche;charset=utf8', 'root', '');
  
// je l'ai récuperer par ajax
$pseudo=$_POST['pseudo'];


// affichage des membres enlignes en premier
$user_connect=$pdo->query("SELECT * FROM membre WHERE pseudo != '$pseudo' ORDER BY   statut DESC") ;

// selectionné tout les messages dont le statut est non pour la lecture afin de les affichés pour chaque expediteur dans la liste des contacts 

$selectMessageNonLU= $pdo->query("SELECT distinct  expediteur , Count('messages') as nombre_messages FROM messages WHERE destinataire= '$pseudo' and lecture='non'" ) ;
$selectMessageNonLU->execute();
  
// $nombreMessageNonLu =$selectMessageNonLU->rowCount('nombre_messages');
   
    while($messageNonLu=$selectMessageNonLU -> fetch(PDO::FETCH_ASSOC)){
      
      // creer la liste pour la verifier avec in_array() pour comparer dans list_view
      $list_utilisateur_avec_nouveau_message=array( $messageNonLu['expediteur']);
      
    }
    
    
   /*** recup les membres connectés */
   ?>
   
   <?php
   while($utilisateur_c=$user_connect-> fetch(PDO::FETCH_ASSOC)){ 
      // si l'utilisateur est connecté
   if($utilisateur_c['statut']==1){ 
   
      
?>

   <li class="list-group-item"> <a href="?page=discussion&action=select&id_membre=<?php echo $utilisateur_c['id_membre'].'&pseudo='.$utilisateur_c['pseudo'] ?>"> <?=  ucfirst($utilisateur_c['pseudo'] . ' '.$utilisateur_c['age'].' ans')  
      ?>
      <?php
      // verifie si dans la liste array des expediteur qui m'ont contacté dont le message a le statut non lu  il correspont à un utilisateur dans la liste des contact , si oui il affiche nouveau message   donc cet utilisateur  vous a envoyer un message 
               if(isset($list_utilisateur_avec_nouveau_message)){ // si cette variable existe pour eviter undefined variable 
                 if(in_array($utilisateur_c['pseudo'], $list_utilisateur_avec_nouveau_message) ){
      
                     echo '<br> <span class="text-danger"> Nouveau message </span> ';
                     
                              
                  } 
               }
      ?>

      <span class="connecte float-right"></span><img class="  avatar" src="<?php
                     // affichage des avatars si la photo n'existe pas selon le sexe
                     if(!empty($utilisateur_c['photo'])) {
                           echo $utilisateur_c['photo'];
                     }elseif(empty($utilisateur_c['photo']) && $utilisateur_c['sexe'] == "f" ){
                           echo WEBSITE_URL .'assets/images/utilisateurs/avatar/femme.png' ;
                     }else{
                           echo WEBSITE_URL.'assets/images/utilisateurs/avatar/homme.png' ;
                     } ?>" alt=""></a>
   </li>
   <?php 
   }else{ 
      
            ?>
   <li class="list-group-item"> <a href="?page=discussion&action=select&id_membre=<?php echo $utilisateur_c['id_membre'].'&pseudo='.$utilisateur_c['pseudo'] ?>"><?=  ucfirst($utilisateur_c['pseudo'] . ' '.$utilisateur_c['age'].' ans')  ?>
   
   <?php
      // verifie si dans la liste array que j'ai crée des messages non lu il se trouve l'utilisateur dans la liste de  contact , si oui donc cet utilisateur  vous a envoyer un message 
               if(isset($list_utilisateur_avec_nouveau_message)){ // si cette variable existe pour eviter undefined variable 
                  if(in_array($utilisateur_c['pseudo'], $list_utilisateur_avec_nouveau_message) ){
      
                     echo '<br> <span class="text-danger"> Nouveau message </span> ';
                  
                              
                  }
               }
      ?>
      <span class="deconnecte float-right"></span><img class="  avatar" src="<?php
                     // affichage des avatars si la photo n'existe pas selon le sexe
                     if(!empty($utilisateur_c['photo'])) {
                           echo $utilisateur_c['photo'];
                     }elseif(empty($utilisateur_c['photo']) && $utilisateur_c['sexe'] == "f" ){
                           echo WEBSITE_URL .'assets/images/utilisateurs/avatar/femme.png' ;
                     }else{
                           echo WEBSITE_URL.'assets/images/utilisateurs/avatar/homme.png' ;
                     } ?>" alt=""></a>
   </li>
   <?php } }  
   ?>
   


























