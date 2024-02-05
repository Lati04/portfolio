import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { RouterModule } from '@angular/router';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HomeComponent } from './Views/home/home.component';
import { ContactComponent } from './Views/contact/contact.component';
import { HeaderComponent } from './Views/Components/header/header.component';
import { FooterComponent } from './Views/Components/footer/footer.component';
import { LeafletMapComponent } from './Views/Components/leaflet-map/leaflet-map.component';
import { MarkerService } from './Services/marker.service';
import { SchoolService } from './Services/school.service';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { FormComponent } from './Views/contact/form/form.component';
import { MatButtonModule} from '@angular/material/button';
import { MatCheckboxModule } from '@angular/material/checkbox';
import { MatFormFieldModule} from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { MatSelectModule } from '@angular/material/select';


@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    ContactComponent,
    HeaderComponent,
    FooterComponent,
    LeafletMapComponent,
    FormComponent,
   
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    RouterModule,
    BrowserAnimationsModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    MatButtonModule,
    MatCheckboxModule,
    MatFormFieldModule,
    MatInputModule,
    MatSelectModule,
    
  ],
  providers: [SchoolService, ContactComponent, MarkerService, FormComponent],
  bootstrap: [AppComponent]
})
export class AppModule {}
