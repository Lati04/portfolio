import { Component } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { Validators } from '@angular/forms';

@Component({
  selector: 'app-form',
  templateUrl: './form.component.html',
  styleUrl: './form.component.css'
})
export class FormComponent {
   // Création du formGroup, qui contient chaque FormControl
   form = new FormGroup({
    firstname: new FormControl('', [Validators.required, Validators.minLength(4), Validators.required, Validators.maxLength(20)]),
    lastname: new FormControl('', [Validators.required, Validators.minLength(4), Validators.required, Validators.maxLength(20)]),
    email: new FormControl('', [Validators.required, Validators.email]),
    subject: new FormControl('', [Validators.required]),
    message: new FormControl('', [Validators.required]),
    acceptTerms: new FormControl(false, [Validators.requiredTrue])
  });

  // Getter permettant d'accéder au propriétés depuis notre template
  get firstname() { return this.form.get('firstname');}
  get lastname() { return this.form.get('lastname');}
  get email() { return this.form.get('email');}
  get subject() { return this.form.get('subject');}
  get message() { return this.form.get('message');}
  get acceptTerms() { return this.form.get('acceptTerms');}
}
