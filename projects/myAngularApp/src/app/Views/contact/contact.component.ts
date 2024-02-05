import { OnInit, Component } from '@angular/core';
import { FormComponent } from './form/form.component';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { SchoolService } from '../../Services/school.service';

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrl: './contact.component.css'
})

export class ContactComponent implements OnInit {
  schoolId: number | null = null;
  schoolName: string | undefined;

  constructor(private FormComponent: FormComponent, private Route: ActivatedRoute, private SchoolService: SchoolService)
  {console.log(SchoolService);}

    ngOnInit(): void {
      const url = new URL(window.location.href);
      console.log(window.location.href);
      const schoolIdParam = url.searchParams.get('schoolId ');
      const parsedSchoolId = schoolIdParam?parseInt(schoolIdParam): null;
     console.log(parsedSchoolId)
      if(parsedSchoolId){
         this.SchoolService.getSchoolById(parsedSchoolId).subscribe(school => {
            this.schoolName = school ? school.nom_etablissement: undefined;
         });
      }
    }
}
    


