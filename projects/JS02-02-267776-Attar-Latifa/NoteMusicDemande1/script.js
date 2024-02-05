/*Tableau de "notes" contenant les notes classiques françaises */
var notes = ["do", "ré", "mi", "fa", "sol", "la", "si"];
//////////////////////////////////////////////////////////////////////////////////////////////////
/////////                            L'événement 'onload' de la page                   ///////////
//////////////////////////////////////////////////////////////////////////////////////////////////
(function(){
    var demande1 = {
        init:function(){
            window.addEventListener('load', function(){
                ///////////////////////////////////////////////////////////////
                //////              Créer le formulaire                  //////
                ///////////////////////////////////////////////////////////////
            
                var formElement = document.createElement('form');
                // Ajouter la méthode POST
                formElement.method = 'POST';
                // Ajouter l'action
                formElement.action = 'index.php';
                // Ajouter la classe Bootstrap pour le positionnement en ligne
                formElement.classList.add('form-line');
                // Ajouter l'animation au formulaire
                formElement.classList.add('fadeIn');

            
                                        /////////////////////
                                        // Créer un label ///
                                        /////////////////////
                var labelElement = document.createElement('label');
                // Ajouter la classe Bootstrap pour les marges
                labelElement.classList.add('mr-sm-2');
                labelElement.setAttribute('for', 'noteSelect');
                labelElement.textContent = 'Choisissez une note de musique:';
                
                // Centrer le texte
                 labelElement.style.textAlign = 'center';
                 // Definir la marge
                 labelElement.style.margin = '30px';
                
                                        //////////////////////////////////////////////////////////
                                        ///       Créer le menu déroulant(balise <select>)     ///
                                        //////////////////////////////////////////////////////////
            
                var selectElement = document.createElement('select');
                // Ajouter la classe Bootstrap pour la mise en forme du menu déroulant
                selectElement.classList.add('form-control');
                selectElement.id = 'noteSelect';
            
                // Définir la largeur du select
                selectElement.style.width = '50%';
            
                // Centrer le select
                selectElement.style.marginLeft = 'auto';
                selectElement.style.marginRight = 'auto';
                
                // Centrer 
                selectElement.style.textAlign = 'center';

                                        ///////////////////////////////////////
                                        // Créer une option vide par default //
                                        ///////////////////////////////////////
                var defaultOption = document.createElement('option');
                defaultOption.value = '';
              
                // Ajouter une option vide au selectElement
                selectElement.appendChild(defaultOption);
            
                                        /////////////////////////////////////////////////////////////
                                        // Parcourir toutes les entrées du tableau correspondances //
                                        /////////////////////////////////////////////////////////////
               notes.forEach(function(noteClassique){
                      // Créer un nouvel élément d'option
                      var option = document.createElement('option');
                      // Définir la valeur et le texte de l'option en utilisant la note classique
                      option.value = noteClassique;
                      option.textContent = noteClassique;
                      // Ajouter l'option nouvellement créée au selectElement
                      selectElement.appendChild(option);
                });
                
                ////////////////////////////////////////////////
                /////// Créer une div contenant le message /////
                ////////////////////////////////////////////////
                var messageDisplay = document.createElement('div');
                messageDisplay.id = 'messageDisplay';
            
                ////////////////////////////////////////
                // Ajouter des élements au formulaire //
                ////////////////////////////////////////
                formElement.appendChild(labelElement)
                           .appendChild(selectElement)
                           .appendChild(messageDisplay);
            
                ////////////////////////////////////////////////////////////
                ////// Ecouter l'événement de modification de sélection ////
                ////////////////////////////////////////////////////////////
                selectElement.addEventListener('change', handleSelectChange);
            
                ///////////////////////////////////////////////////////////////////  
                ///////////////////// Créer les div Bootstrap /////////////////////
                ///////////////////////////////////////////////////////////////////
            
                var containerDiv = document.createElement('div');
                containerDiv.classList.add('container');
            
                var rowDiv = document.createElement('div');
                rowDiv.classList.add('row', 'justify-content-center');
            
                var colDiv = document.createElement('div');
                colDiv.classList.add('col-md-9');
            
                var messageColDiv = document.createElement('div');
                messageColDiv.classList.add('col-md-12');
                // Ajouter une marge en haut 
                messageColDiv.style.marginTop = '30px';
                // Centrer le texte à l'intérieur de messageColDiv
                messageColDiv.style.textAlign = 'center';
            
                // Créer l'élément img et lui attribuer l'URL de l'image
                var imgElemnt = document.createElement('img');
                imgElemnt.src = 'image/partition_music.jpg';
                // Definir les styles pour centrer l'image horizontalement 
                imgElemnt.style.display = 'block';
                imgElemnt.style.margin = '0 auto';
                // Inserer l'élement img juste avant l'élement LabelElement
                labelElement.parentNode.insertBefore(imgElemnt, labelElement);
                
                                /////////////////////////
                                // Définir les padding //
                                /////////////////////////
            
                document.body.style.paddingBottom = '30px';
                containerDiv.style.padding ='40px';
                formElement.style.padding = '30px';
                colDiv.style.padding = '20px';
                messageColDiv.style.padding ='20px';
            
                ///////////////////////////////////////
                // Inserer les divs dans le document //
                ///////////////////////////////////////
            
                document.body.appendChild(containerDiv);
                containerDiv.appendChild(rowDiv);
                rowDiv.appendChild(colDiv);
                colDiv.appendChild(formElement);
                messageColDiv.appendChild(messageDisplay);
                colDiv.appendChild(messageColDiv)
            
            /////////////////////////////////////////////////////////////////////////////////////////////////////
            ////////////////// Fonction de traitement de l'événement de modification de sélection ///////////////
            /////////////////////////////////////////////////////////////////////////////////////////////////////
            
            function handleSelectChange(){
                var selectElement = document.getElementById('noteSelect');
                var selectedNote = selectElement.value;
                
                var messageDisplay = document.getElementById('messageDisplay');
                messageDisplay.innerHTML = '';
                
                // Vérifier si la note sélectionnée a une correspondance américaine dans l'objet "correspondances"
                if(selectedNote){
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function(){
                        // console.log('Ready state:', xmlhttp.readyState);
                        // console.log('Status:', xmlhttp.status);
                        // console.log('Response:', xmlhttp.responseText);
                        if(xmlhttp.readyState === 4 &&  xmlhttp.status === 200){
                             var correspondanceAmericaine = xmlhttp.responseText;
                             // Afficher la réponse dans l'élément DOM pour l'affichage
                             messageDisplay.innerHTML = correspondanceAmericaine;
                        }else{
                            // Afficher un message d'erreur dans l'interface utilisateur
                            messageDisplay.innerHTML = 'Une erreur s\'est produite lors de la requête AJAX';
                        }
                    };
                
                xmlhttp.open('POST', formElement.action, true);
                xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
                xmlhttp.send('selectedNote=' + encodeURIComponent(selectedNote));  
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
demande1.init();
})();