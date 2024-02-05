import { AfterViewInit, Component } from '@angular/core';
import * as L from 'leaflet';
import { MarkerService } from '../../../Services/marker.service';
import { School } from '../../../../Interfaces/school';
import { SchoolService } from '../../../Services/school.service';

@Component({
  selector: 'app-leaflet-map',
  templateUrl: './leaflet-map.component.html',
  styleUrl: './leaflet-map.component.css'
})

export class LeafletMapComponent implements AfterViewInit {
  private map : L.Map | undefined
  
  constructor(private markerService: MarkerService, private schoolService: SchoolService){}
 
  ngAfterViewInit(): void {
    let x : number = 49.3040; // Latitude de Fameck
    let y : number = 6.1035;  // Longitude de Fameck
    let z : number = 15;      // Niveau de zoom 

    this.map = new L.Map('map', {
      center: [x, y],
      zoom: z
    })!;

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(this.map)

    this.schoolService.getSchools().subscribe((schools: School[]) =>{
      
      // Appeler la méthode placeMarker() 
      if(this.map){
        this.markerService.placeMarker(this.map, schools);
         console.log('Marker placement completed');
      }
    });
  }
}