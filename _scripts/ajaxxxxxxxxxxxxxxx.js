// suppression d'un contact de ma liste de contact en cliquant


// $(document).ready(function(){
    
//     $('#envoyer').click(function(e){
//     var valeur_message = document.getElementById('message').value;
//     var valeur_photo = document.getElementById('image_chat').value;
//     // e.preventDefault(); //stoper l'envoie
    
//     var valeur_message = document.getElementById('message').value;
//     var valeur_destinataire = document.getElementById('destinataire').value;
    //  $.post(
    //    // pour savoir les differents chemins tape    console.log(window.location);  dans la console 
    //    // pour attaindre un chemin ecris window.location.origin  ici c'est origin pour ecrire l'url parent regarde juste la ligne en bas de ce commentaire
    //    window.location.origin +"/discussion/controllers/ajax.php",
    //    //la data à envoyer par post
    //    { destinataire  : valeur_destinataire ,
    //      message : valeur_message ,
    //      photo :   valeur_photo
    //    },
    //    // afficher le resultat dans une div à notre choix  je le met en commentaire sinon quand je supprime 1 ils disparaissent tous.
    //      function(data) {
    //          // afficher le resultat de la requette ici si il ya un résultat ou erreur , mais ici c'est juste une requete qui va etre executé dans ajax.php
    //          $('.reponse').html(data);
    //      }
    //  ); 


  
//     });
// });

// la meme chose q'on haut mais ici en recupere directement les post avec les mm name du formulaire
$(document).ready(function(){
	
    $('#envoyer').click(function(e){
    e.preventDefault(); // stoper la recharge   
    
    var form = $('.formulaire').get(0);
	var formData = new FormData(form);// get the form data
	// on envoi formData vers mail.php
	$.ajax({
		type		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
		url		:  window.location.origin +"/discussion/ajax.php", // the url where we want to POST
		data		: formData, // our data object
		dataType	: 'json', // what type of data do we expect back from the server
		processData: false,
		contentType: false
	})

   
	});

});

