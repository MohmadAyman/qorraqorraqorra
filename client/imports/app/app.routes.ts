import { Route } from '@angular/router';
 
import { TutorsListComponent } from './tutors/tutors-list.component';
import { AddClassFormComponent } from './tutors/addClass-form.component'; 
import { ClassesListComponent } from './tutors/classes-list.component';
import { ClassDetailsComponent } from './tutors/class-details.component';
import {LoginComponent} from "./auth/login.component";
import {SignupComponent} from "./auth/singup.component";
import {RecoverComponent} from "./auth/recover.component";
import { SignupTutorComponent } from "./auth/singup-tutor.component";
import { VideoOneToOneComponent } from './communication/video-one-to-one.component';
import { HomeComponent } from './home.component';

export const routes: Route[] = [
  { path: '', component: HomeComponent },
  { path: 'tutors', component: TutorsListComponent },
  { path: 'addClass', component: AddClassFormComponent },
  { path: 'classesList', component: ClassesListComponent},
  { path: 'class/:classId', component: ClassDetailsComponent},
  { path: 'login', component: LoginComponent },
  { path: 'signup', component: SignupComponent },
  { path: 'recover', component: RecoverComponent },
  { path: 'tutor/signup', component: SignupTutorComponent},
  { path: 'one2one', component: VideoOneToOneComponent}
];