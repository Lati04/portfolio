import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs';
import { School } from '../../Interfaces/school';


@Injectable({
  providedIn: 'root'
})
export class SchoolService {
  
  constructor(private http: HttpClient) { }
  
  getSchools(): Observable<School[]>{
    const baseUrl: string = 'https://data.education.gouv.fr/api/explore/v2.1/catalog/datasets/fr-en-annuaire-education/records?select=latitude%2Clongitude%2Cnom_etablissement%2Cadresse_1%2Ccode_postal%2Ctype_etablissement%2Cstatut_public_prive&where=code_postal%20like%20%2257290%22%20or%20code_commune%20like%20%22Fameck%22&limit=20&lang=fr';
    
    return this.http.get(baseUrl).pipe(map((response:any) => {
   
      const results: any[] = response.results || [];
  
      const schools: School[] = [];
   
      for(let i=0; i < results.length; i++){
        const result = results[i];
        const school: School = {
          id: i,
          latitude: result.latitude,
          longitude: result.longitude,
          nom_etablissement: result.nom_etablissement,
          adresse_1: result.adresse_1,
          code_postal: result.code_postal,
          type_etablissement: result.type_etablissement,
          statut_public_prive: result.statut_public_prive
        };
        schools.push(school);
      }
      return schools
    }))
  }

  getSchoolById(schoolId: number): Observable<School | null>{
    return this.getSchools().pipe(map(schools => schools.find(school => school.id === schoolId)?? null));   
  }
}
  