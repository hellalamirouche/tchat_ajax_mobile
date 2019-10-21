<!doctype html>
<html>
<head>

    <?php include_once 'views/includes/head.php' ?>

    <title><?=ucfirst($page) ?></title>
</head>

<body>

<?php include_once 'views/includes/header.php';  ?>

  

<div class="fluid-container px-0 mb-3 d-md-none" >
            
            <div class="row col-xl-10 px-2 mx-auto bg-info conteneur-principal" >
                      <!-- Button trigger modal -->


                <div class="col-md-4 px-0 " id="liste_contact">
                    <div class="col-12 px-0 header-list_contact">
                        <div class=" row col-12 d-md-none bg-dark text-white mx-auto mb-4">
                               <?php if(isconnected() ){ // si n'est pas connecté affiche connexion et inscription ?>
                            <div class="col-8 row d-flex my-2">
                            <input type="hidden" value="<?php echo $_SESSION['membre']['pseudo'] ?> " id="pseudo_ajax_nouveaumsg" >
                                <div class="col-5 d-flex">
                                    <img class=" text-center avatar img-fluid " src="<?php
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
                                
                                    <p class="col-7 pt-2"><?php echo $_SESSION['membre']['pseudo'] ?></p>
                                </div>
                            </div>
                                <a class=" col-4 pt-2 pl-2 text-white text-right my-2 " href="<?php echo '?action=deconnexion' ?>" style="text-decoration:none">Deconnexion</a>
                                <?php } ?>
                            
                        </div>
                
                    </div>
                    <div class="col-12 row px-0  mx-0 recherche position-sticky sticky-top mb-3">
                        <input class="col-11 mx-auto  h-100 text-center form-control " type="text" name="recherche" placeholder="Recherche" id="recherche">
                    </div>
                    <div class="col-12 px-0  body_list_contact "  > 
                     <!-- voir le nombre de messages recus -->
                     <input type="hidden" id="notification" value="<?php echo $nombreMessageNonLu ?>">

                     <div  id="notification_message" style="padding:10px;text-align:center">
                     
                     <!-- resultat ajax pour nbr msg recus -->

                     </div>
                        <ul id="list_sans_ajax" class="list-contact list-group col-12 px-0 mt-0 mb-2"  style="height:60vh ; overflow: auto;">
                        <?php
                         
                            /*** recup les membres connectés */
                            while($utilisateur_c=$user_connect-> fetch(PDO::FETCH_ASSOC)){ 
                                // si l'utilisateur est connecté
                            if($utilisateur_c['statut']==1){ 
                             
                                if(isset($messageNonLu['expediteur']) && $messageNonLu['expediteur'] == $utilisateur_c['pseudo']){
                            
                            echo '<br> <span class="text-danger">'.$messageNonLu['destinataire'].' </span> ';
                          
                                }
                           ?>
                            <li class="list-group-item"> <a href="?page=discussion&action=select&id_membre=<?php echo $utilisateur_c['id_membre'].'&pseudo='.$utilisateur_c['pseudo'] ?>"> <?=  ucfirst($utilisateur_c['pseudo'] . ' '.$utilisateur_c['age'].' ans')  
                                ?>
                                <?php
                                // verifie si dans la liste array des expediteur qui m'ont contacté dont le message a le statut non lu  il correspont à un utilisateur dans la liste des contact , si oui il affiche nouveau message   donc cet utilisateur  vous a envoyer un message 
                                        if(in_array($utilisateur_c['pseudo'], $list_utilisateur_avec_nouveau_message) ){
                                
                                                echo '<br> <span class="text-danger"> Nouveau message </span> ';
                                                        
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
                                        if(in_array($utilisateur_c['pseudo'], $list_utilisateur_avec_nouveau_message) ){
                                
                                                echo '<br> <span class="text-danger"> Nouveau message </span> ';
                                            
                                                        
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
                             <?php } } ?>
    
                        </ul>
                        <ul id="list_ajax" class="list-contact list-group col-12 px-0 mt-0 mb-2"  style="height:60vh ; overflow: auto;">
                          <!-- resultat ajax list -->
                          
                        </ul>
                        <!-- resultat ajax avec la recherche de membre -->
                        <ul id="list_ajax_recherche" class="list-contact list-group col-12 px-0 mt-0 mb-2"  style="height:60vh ; overflow: auto;">
                          <!-- resultat ajax list -->
                          
                        </ul>
                    </div>
                    <div class="row col-12 px-0 mx-auto footer_list_contact bouton_select_contact bg-dark " style="position:fixed;bottom:20px">
                        <div class="col-md-6 px-0 bg-dark">
                            <li class="list-group-item text-center bg-dark " id="tout_contact"><a class="text-decoration-none text-white " href="?action=tout_contact">Tout</a> </li>
                        </div>
                        <div class="col-md-6 px-0 ">
                            <li class="list-group-item text-center bg-dark" id="enligne_contact"><a class="text-decoration-none text-white" href="?action=enligne_contact">En ligne</a> </li>
                        </div>
                        
                    </div>
                </div>

<script> 
 
/******************************ajaxe pour récuperer les messages en instantané ******************************************************/

function new_message_auto(){
    
    
    /* les paramettres a envoyer  
    * selon que je clique sur le bouton pour afficher les contact enligne ou tout contact
    * la valeur de l'input de recherche 
    */
   var pseudo = document.getElementById('pseudo_ajax_nouveaumsg').value ;
   var params = "pseudo=" + pseudo  ;

    var NEWMSG = new XMLHttpRequest();
    NEWMSG.onreadystatechange = function(){ 
        if(NEWMSG.readyState != 4){
            
            // si tu veux mettre un gif qui fait patienté 

        } 
        if(NEWMSG.readyState == 4 && NEWMSG.status == 200){
        
        document.getElementById('list_sans_ajax').style.display='none';
        document.getElementById('list_ajax').innerHTML = NEWMSG.responseText; 


        if(NEWMSG.responseText == false)
        {
            document.getElementById('result').innerHTML = '<h2 class="text-center">Ah pas de message</h2>';
        }
    }
}

/* en POST */

NEWMSG.open('POST',"http://localhost/app/ajax_list.php",true);
NEWMSG.setRequestHeader("content-type","application/x-www-form-urlencoded") ; // si tu mets pas cette  ligne de setRequestHeader  en mode POST sa ne marche pas 
NEWMSG.send("pseudo=" + pseudo);


    setTimeout(new_message_auto,2000);
}
new_message_auto();
</script>

<script> 
 
    /******************************ajaxe pour récuperer lenombre de messages recu en instantané ******************************************************/
    
    function nembre_message_auto(){
        
        
        /* les paramettres a envoyer  
        * selon que je clique sur le bouton pour afficher les contact enligne ou tout contact
        * la valeur de l'input de recherche 
        */
       var pseudo = document.getElementById('pseudo_ajax_nouveaumsg').value ;
       var params = "pseudo=" + pseudo  ;
    
        var NBRMSG = new XMLHttpRequest();
        NBRMSG.onreadystatechange = function(){ 
            if(NBRMSG.readyState != 4){
                
                // si tu veux mettre un gif qui fait patienté 
    
            } 
            if(NBRMSG.readyState == 4 && NBRMSG.status == 200){
            
            document.getElementById('notification_message').innerHTML = NBRMSG.responseText; 
    
    
            if(NBRMSG.responseText == false)
            {
                document.getElementById('result').innerHTML = '<h2 class="text-center">Ah pas de message</h2>';
            }
        }
    }
    
    /* en POST */
    
    NBRMSG.open('POST',"http://localhost/app/ajax_list_nbr_msg.php",true);
    NBRMSG.setRequestHeader("content-type","application/x-www-form-urlencoded") ; // si tu mets pas cette  ligne de setRequestHeader  en mode POST sa ne marche pas 
    NBRMSG.send("pseudo=" + pseudo);
    
    
        setTimeout(nembre_message_auto,2000);
    }
    nembre_message_auto();
</script>



<script>

// recup var recherche input
document.getElementById('recherche').addEventListener("keyup", function(){
 
// recherche en temps reel 
// recup pseudo 
var pseudo = document.getElementById('pseudo_ajax_nouveaumsg').value;

var inputRecherche = document.getElementById('recherche').value  ;

//creation de l objet ajax 

function recherche_auto(){
    
    
    /* les paramettres a envoyer  
    * la valeur de l'input de recherche 
    * pseudo
    */
    params = "pseudo=" + pseudo + "&recherche=" + inputRecherche ;

    var RECHERCHEAUTO = new XMLHttpRequest();
        RECHERCHEAUTO.onreadystatechange = function(){ 
        if(RECHERCHEAUTO.readyState != 4){
            
            // si tu veux mettre un gif qui fait patienté 

        } 
        if(RECHERCHEAUTO.readyState == 4 && RECHERCHEAUTO.status == 200){
        
        document.getElementById('list_sans_ajax').style.display='none';
        document.getElementById('list_ajax').style.display='none';
        document.getElementById('list_ajax_recherche').innerHTML = RECHERCHEAUTO.responseText; 


        if(RECHERCHEAUTO.responseText == false)
        {
            document.getElementById('list_ajax_recherche').innerHTML  = '<h2 class="text-center">Pas de contact avec ce pseudo </h2>';
        }
    }
}

/* en POST */

RECHERCHEAUTO.open('POST',"http://localhost/app/ajaxRecherche_list.php",true);
RECHERCHEAUTO.setRequestHeader("content-type","application/x-www-form-urlencoded") ; // si tu mets pas cette  ligne de setRequestHeader  en mode POST sa ne marche pas 
RECHERCHEAUTO.send(params);


// setTimeout(recherche_auto,1000);


}
recherche_auto();
 
}); 
  
</script>

<script>
var notification = document.getElementById("notification").value;
 if( notification != 0){
       Push.create("Nouveau message!",{
            body: "Azul regarde tes messages",
            icon: 'data:image/jpeg;base64,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',
            
            onClick: function () {
                window.focus();
                this.close();
            }
        });
        Push.Permission.has();
   
 }
</script>

     <?php include_once 'views/includes/modal_membre.php'; ?>
     <?php include_once 'views/includes/footer.php'; ?>

</body>
</html>
