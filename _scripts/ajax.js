

  

		
/****************************************************************************************************** ***********************************************/



     
       // si j'appuie sur envoyer je recupere résultat par ajax 
       $('#envoyer').click(function(e){
        e.preventDefault(); // stoper la recharge 
    
        /************************************************** ce code juste pour récuperer les données formulaire************************************************************ */
     // envoyer les donnes du formulaire car j'ai un probleme pour envoyer le file de limage don je rajoite ce code pour récuperer le file de l'image et le reste je le récupere par ajax en bas 
         
            var form = $('.formulaire').get(0);
            var formData = new FormData(form);// get the form data
            // on envoi formData vers mail.php
            $.ajax({
                type		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url		:  "http://localhost/app/ajax.php", // the url where we want to POST
                data		: formData, // our data object
                dataType	: 'json', // what type of data do we expect back from the server
                processData: false,
                contentType: false
            })
            
  /******************************************************************************************************************************************* */
 /* ce code est pour vider les input apres le click ,c'est tres important sinon le text ou le file reste dans l'input et on envoie le message plusieur fois si on rappuier*/
//  je reset mon formulaire en l'attaignant avec son id
 document.getElementById("form_tchat").reset();

/************************************************************************************************************* */

    //  je récupere le message et le destinataire  pas l'image 
        var message = document.getElementById('message').value ;
        var destinataire = document.getElementById('destinataire').value;
        var pseudo = document.getElementById('pseudo').value;
        // les paramettres a envoyer 
        /* REMARQUE : 
        ICI JE N4ENVOIE PAS DE PARAMETTRE PAR params qui se trouve juste au dessous car j'ai envoyé les données du formulaire vers ajax.php juste au dessu la avec la fonction ajax 
        
        */
        //-------------> mes parametres que j'annule  :  params = "destinataire=" + destinataire  + "&messenger=" + message + "&pseudo=" + pseudo;
   
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){ 
            if(xhr.readyState != 4){
                
                // si tu veux mettre un gif qui fait patienté 

            } 
            if(xhr.readyState == 4 && xhr.status == 200){
            
            document.getElementById('resulat_message_sans_ajax').style.display='none';
            document.getElementById('message_ajax').innerHTML = xhr.responseText; 


            if(xhr.responseText == false)
            {
                document.getElementById('result').innerHTML = '<h2 class="text-center">Ah pas de message</h2>';
            }
        }
    }
    /* en GET */

    // document.getElementById('cover').innerHTML ='<img src="http://www.aveva.com/Images/ajax-loader.gif" style="width:400px;height:400px;"/>';
    // xhr.open('GET','http://localhost/discussion/ajax.php?'+params,true);
    // xhr.send();

    /* en POST */

    xhr.open('POST',"http://localhost/app/ajax.php",true);
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded") ; // si tu mets pas cette  ligne de setRequestHeader  en mode POST sa ne marche pas 
    xhr.send(params);
  
});

   

/******************************ajaxe pour récuperer les messages en instantané ******************************************************/
function recharge_message_auto(){
    
    
                    var destinataire = document.getElementById('destinataire').value;
                    var pseudo = document.getElementById('pseudo').value;
                    // les paramettres a envoyer 
                    params = "destinataire=" + destinataire  + "&pseudo=" + pseudo;
            
                    var MESSAGE = new XMLHttpRequest();
                    MESSAGE.onreadystatechange = function(){ 
                        if(MESSAGE.readyState != 4){
                            
                            // si tu veux mettre un gif qui fait patienté 

                        } 
                        if(MESSAGE.readyState == 4 && MESSAGE.status == 200){
                        
                        document.getElementById('resulat_message_sans_ajax').style.display='none';
                        document.getElementById('message_ajax').innerHTML = MESSAGE.responseText; 


                        if(MESSAGE.responseText == false)
                        {
                            document.getElementById('result').innerHTML = '<h2 class="text-center">Ah pas de message</h2>';
                        }
                    }
                }
                /* en GET */

                // document.getElementById('cover').innerHTML ='<img src="http://www.aveva.com/Images/ajax-loader.gif" style="width:400px;height:400px;"/>';
                // MESSAGE.open('GET','http://localhost/discussion/ajax.php?'+params,true);
                // MESSAGE.send();

                /* en POST */

                MESSAGE.open('POST',"http://localhost/app/ajax.php",true);
                MESSAGE.setRequestHeader("content-type","application/x-www-form-urlencoded") ; // si tu mets pas cette  ligne de setRequestHeader  en mode POST sa ne marche pas 
                MESSAGE.send(params);
        
              setTimeout(recharge_message_auto,5000);


} recharge_message_auto();



