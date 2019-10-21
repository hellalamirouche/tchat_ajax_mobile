<?php
  
// // Inclusion des fichiers principaux
$pdo = new PDO('mysql:host=localhost;dbname=tchat-amirouche;charset=utf8', 'root', '');
  
// je l'ai récuperer par ajax
$pseudo=$_POST['pseudo'];


// affichage des membres enlignes en premier
$user_connect=$pdo->query("SELECT * FROM membre WHERE pseudo != '$pseudo' ORDER BY   statut DESC") ;

// selectionné tout les messages dont le statut est non pour la lecture afin de les affichés pour chaque expediteur dans la liste des contacts 

$selectMessageNonLU= $pdo->query("SELECT  Count('messages') as nombre_messages FROM messages WHERE destinataire= '$pseudo' and lecture='non'" ) ;
$selectMessageNonLU->execute();
  
// $nombreMessageNonLu =$selectMessageNonLU->rowCount('nombre_messages');
   
    while($messageNonLu=$selectMessageNonLU -> fetch(PDO::FETCH_ASSOC)){
      
      $nombreMessageNonLu = intval( $messageNonLu['nombre_messages']);
      
    }
    
    
   /*** recup les membres connectés */
   ?>
   <!-- input type hidden pour récuperer le nombre de message recu et aussi afin de l'utiliser pour les notification avec push.js aussi -->

   
   Vous avez <span class="badge badge-pill badge-danger"><?php echo ' ' .$nombreMessageNonLu ?> </span> nouveaux message (s)
   
  
   


























