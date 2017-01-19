import { Component } from '@angular/core';
import { Observable } from 'rxjs/Observable';
 
import { Tutors } from '../../../../both/collections/tutors.collection';
import { Tutor } from  '../../../../both/models/tutor.model';
 
import template from './tutors-list.component.html';
 
@Component({
  selector: 'tutors-list',
  template
})
export class TutorsListComponent {
  tutors: Observable<Tutor[]>;
  t : Tutor;
 
  constructor() {
    this.tutors = Tutors.find({}).zone();
  }

    removeTutor(tutor: Tutor){
      Tutors.remove(tutor._id);
    }

}