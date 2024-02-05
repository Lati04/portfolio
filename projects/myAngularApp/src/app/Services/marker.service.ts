import {Injectable} from '@angular/core';
import * as L from 'leaflet';
import { Router } from '@angular/router';
import { SchoolService } from './school.service';
import { School } from '../../Interfaces/school';
import { MatDialog } from '@angular/material/dialog';

// Définition des options visuelles des markers Leaflet
const iconRetinaUrl = '../../assets/marker-icon-2x.png';
const iconUrl = '../../assets/marker-icon.png';
const shadowUrl = '../../assets/marker-shadow.png';
const iconDefault = L.icon({ iconRetinaUrl, iconUrl, shadowUrl});
L.Marker.prototype.options.icon = iconDefault;

@Injectable({
 providedIn: 'root'
})

export class MarkerService {

  navigateToContact(schoolId: number){
    this.router.navigateByUrl('/contact?schoolId =' + schoolId);
  } 
  
 constructor(private router: Router, private schoolService: SchoolService, private Dialog: MatDialog){} 

 getPopupContent(school:School): string{
  return '<div class="popupContent">'
  + school.latitude + ', ' + school.longitude + '<br>' +
  '<strong>Nom de l\'école:</strong>' + school.nom_etablissement + '<br>' +
  '<strong>Adresse:</strong>' + school.adresse_1 + '<br>' +
  '<strong>Code_postal:</strong>' + school.code_postal + '<br>' +
  '<strong>Type de l\'établissement:</strong>' + school.type_etablissement + '<br>' +
  '<strong>Statut:</strong>' + school.statut_public_prive + '<br><br>' +
  '<button class="contact-button" data-id="'+ school.id +'">Contact</button>' +
  '</div>';
 }
 
 placeMarker(map : L.Map , schools:School[]): void{

  schools.forEach((school: School) => {
        const marker = L.marker([school.latitude,school.longitude], { icon:iconDefault });
        
        const popupContent = this.getPopupContent(school);
        marker.bindPopup(popupContent);
        marker.addTo(map);
  });
   
    map.on('popupopen', (e:L.PopupEvent) => {
      const popup = e.popup;
      const popupContainer = popup.getElement();

      const ctcButton = popupContainer?.querySelector('.contact-button');
      if(ctcButton){
        ctcButton.addEventListener('click', (e:Event) => {
          const schoolId = parseInt(ctcButton.getAttribute('data-id')??'0');
          console.log('button clicked! School ID:',schoolId);
          this.navigateToContact(schoolId);
        }); 
      }
    });
  } 
}
