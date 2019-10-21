

/*inscription*/
// $(document).ready(function(){

//   document.getElementById('inscription').addEventListener('click' ,function(){

//     $('#formulaire_inscription').toggle("blind");


// });

// $('#valider').click(function(event){
//   event.preventDefault()
//   $('#formulaire_inscription').css("display","block");

// });
// });
// ajout de l'evenement clique en cliquant sur l'icone de fontawsomme pour selectionner un fichier à envoyer 
$(document).ready(function(){

  document.getElementById('file_icone').addEventListener('click' ,function(){

    document.getElementById('image_chat').click();


});
});


/****metre la liste de contact en left en mode mobile */

$(function(){
  /*si j'appuie sur liste de contact tu me les affiche en mode mobile */
  $("#les_contact").click(function() {
    $("#discussion").toggle("slide");
    $("#liste_contact").show();
    });
  /** si j'appuie sur l'icone retour je retourne à la discussion  */
  $("#retour_discussion").click(function() {
    $("#liste_contact").toggle("slide");
    $("#discussion").show();
    });
  });


  /****efface div liste discussion en scroll top */
  
  $(window).scroll(function() {
    if ($(this).scrollTop()) {
        $('#header-discussion').css('display','none');
        $('.discussion').css('height','83% ');
        $('.bouton_select_contact').hide();
    } else {
        $('#header-discussion').css('display','block');
        $('.bouton_select_contact').show();
    }
});

/****cacher les boutons select contact online ou non et input recherche  */
$('.list-contact').scroll(function() {
  if ($(this).scrollTop()) {
    $(this).css('height' , '90vh');
      $('.bouton_select_contact').hide();
      //cacher l'input recherche
      $('.recherche').hide();
      
  }else{
    $('.recherche').show();
      $('.bouton_select_contact').show();
  }

  
});


   // pour envoie de message en key down
   $(window).on('keydown', function(e) {
    if (e.which == 13) {
      newMessage();
      return false;
    }
  });


