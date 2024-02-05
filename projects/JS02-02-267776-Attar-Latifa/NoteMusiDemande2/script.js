(function(){
    // Rajouter cette variable pour vérifier si le formulaire est déjà inséré
    var formulaireInsere = false;
 
    var demande2={
        init:function(){
            window.addEventListener('DOMContentLoaded', function(){
                var boutonNotation = document.getElementById('boutonNotation');

                /////////////////////////////////////////////////////////////////////////////////
                /////   Gestionnaire d'événement pour le click sur le bouton notation       /////
                /////////////////////////////////////////////////////////////////////////////////
                document.getElementById('boutonNotation').addEventListener('click', function(){
                     // Si le formulaire est déjà inséré
                    if(formulaireInsere && document.getElementById('formulaire')){
                        afficherFormulaire();  
                        var selectElement = document.getElementById('noteSelect');
                        selectElement.addEventListener('change', handleSelectChange);
                      
                    }else{
                    // Sinon, demandez le formulaire au serveur avec une requête AJAX
                    // Récuperer la div col-md-9 
                        var formDivs = document.getElementsByClassName('col-md-9');
                        var formDiv = formDivs[0];
                        // Créez une requête AJAX 
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function(){
                            if(xmlhttp.readyState === 4 && xmlhttp.status === 200){
                                // Insertion du HTML du formulaire dans la div col-md-9 de la page
                                 formDiv.innerHTML = this.responseText;

                                // Cacher le bouton "Notation"
                                 boutonNotation.style.display = 'none';
                                // Definir les styles pour centrer 
                                boutonNotation.style.margin = '0 auto';
                                // Afficher le bouton "Fermer"
                                 afficherBoutonFermer();
                                 formulaireInsere = true;

                                 var selectElement = document.getElementById('noteSelect');
                                 selectElement.addEventListener('change', handleSelectChange);
                            }
                        };
                        xmlhttp.open('GET', 'formulaire.php', true);
                        xmlhttp.send();
                    }
                  
                });
                /////////////////////////////////////////////
                // Fonction pour Afficher le Bouton fermer //
                /////////////////////////////////////////////
                function afficherBoutonFermer(){
                    //  le bouton "Fermer"
                    var boutonFermer = document.createElement('button');

                    boutonFermer.id = 'boutonFermer';
                    boutonFermer.textContent = 'Fermer';
                    boutonFermer.addEventListener('click', function(){
                        masquerFormulaire();
                    });

                /////////////////////////////////////////////////////////////////
                ////////       CREATION de la structure BOOTSTRAP      //////////
                /////////////////////////////////////////////////////////////////
                    var rowDiv = document.createElement('div');
                    rowDiv.classList.add('row', 'justify-content-center');

                    var colDiv = document.createElement('div');
                    colDiv.classList.add('col-md-9');

                    // Ajout du bouton 'Fermer' à la structure 
                    colDiv.appendChild(boutonFermer);
                    rowDiv.appendChild(colDiv);

                    var formulaire = document.getElementById('formulaire');
                    formulaire.insertAdjacentElement('afterend', boutonFermer);

                    // Ajout de la classe de bouton
                    boutonFermer.classList.add('button');
                    boutonFermer.style.display = 'block';
                    boutonFermer.style.margin = '20px auto 0';
                    boutonFermer.style.paddingLeft = '40px';
                    boutonFermer.style.paddingRight = '40px';
                    boutonFermer.style.paddingTop = '5px';
                    boutonFermer.style.paddingBottom = '5px';
                  
                }

                //////////////////////////////////////////
                // Fonction pour Afficher le Formulaire //
                //////////////////////////////////////////
                function afficherFormulaire(){
                    var formulaire = document.getElementById('formulaire');
                    formulaire.style.display = 'block';

                    var boutonNotation = document.getElementById('boutonNotation');
                    // Cacher le bouton "Notation"
                    boutonNotation.style.display = 'none';
                    //Definir les styles pour centrer 
                    boutonNotation.style.margin = '0 auto';

                    var boutonFermer = document.getElementById('boutonFermer');
                    boutonFermer.style.display = 'block';

                    // Ajouter l'animation au formulaire
                    formulaire.classList.add('fadeIn');
                }
                
                /////////////////////////////////////////
                // Fonction pour Masquer le Formulaire //
                /////////////////////////////////////////
                function masquerFormulaire(){
                    var formulaire = document.getElementById('formulaire');
                    formulaire.style.display = 'none';

                    var boutonFermer = document.getElementById('boutonFermer');
                    boutonFermer.style.display = 'none';

                    var boutonNotation = document.getElementById('boutonNotation');
                    boutonNotation.style.display = 'block';
                }

                //////////////////////////////////////////////////////////////////////////////////////////////////////
                //////             Fonction de traitement de l'événement de modification de sélection          ///////
                //////////////////////////////////////////////////////////////////////////////////////////////////////
                function handleSelectChange(){
                    var selectElement = document.getElementById('noteSelect');
                    var selectedNote = selectElement.value;
                    
                    var messageDisplay = document.getElementById('messageDisplay');
                    messageDisplay.innerHTML = '';
                   
                    // Vérifier si la note sélectionnée est defini
                    if(selectedNote !== undefined){
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function(){
                            console.log('Ready state:', xmlhttp.readyState);
                            console.log('Status:', xmlhttp.status);
                            console.log('Response:', xmlhttp.responseText);
                            if(xmlhttp.readyState === 4 &&  xmlhttp.status === 200){
                                // var messageDisplay = document.getElementById('messageDisplay');
                                var response = xmlhttp.responseText
                                // Afficher la réponse dans l'élément DOM pour l'affichage
                                messageDisplay.innerHTML = response;
                            }else{
                                // Afficher un message d'erreur dans l'interface utilisateur
                                messageDisplay.innerText = 'Une erreur s\'est produite lors de la requête AJAX';
                            }
                        };
                    
                    xmlhttp.open('POST', 'index.php', true);
                    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
                    xmlhttp.send('note_classique=' + encodeURIComponent(selectedNote));  
                    }else{ // Si le champ vide est sélectionnée 
                        // Construire le message si le champ vide sélectionné
                        var message = 'Pas de choix fait, veuillez choisir une note';
                        // Afficher le message dans l'élément de texte "noteDisplay"
                        messageDisplay.textContent = message;
                    }
                }
            });
        }
    };
    demande2.init();
})();