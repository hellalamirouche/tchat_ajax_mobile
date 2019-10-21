<?php
  
// // Inclusion des fichiers principaux
$pdo = new PDO('mysql:host=localhost;dbname=tchat-amirouche;charset=utf8', 'root', '');
  
// je l'ai récuperer par ajax
$pseudo=$_POST['pseudo'];
$recherche= $_POST['recherche'] ;




$user_connect=$pdo->query("SELECT * FROM membre WHERE pseudo LIKE '$recherche%' AND pseudo != '$pseudo' ORDER BY  pseudo asc " ) ;

   
    
   /*** recup les membres connectés */
   while($utilisateur_c=$user_connect-> fetch(PDO::FETCH_ASSOC)){ 
      // si l'utilisateur est connecté
   if($utilisateur_c['statut']==1){ 
   
      
?>
   <li class="list-group-item"> <a href="?page=discussion&action=select&id_membre=<?php echo $utilisateur_c['id_membre'].'&pseudo='.$utilisateur_c['pseudo'] ?>"> <?=  ucfirst($utilisateur_c['pseudo'] . ' '.$utilisateur_c['age'].' ans')  
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


























