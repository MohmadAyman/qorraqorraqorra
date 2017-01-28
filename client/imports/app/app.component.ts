import { Component, OnInit, OnDestroy } from '@angular/core';
import { Observable } from 'rxjs/Observable';
import { MeteorObservable } from 'meteor-rxjs';

import { Meteor } from 'meteor/meteor';
import { Tutors } from '../../../both/collections/tutors.collection';
import { Tutor } from '../../../both/models/tutor.model';
import {InjectUser} from "angular2-meteor-accounts-ui";
import style from './app.component.scss';
import template from './app.component.html';
 

@Component({
  selector: 'app',
  // styles: [ style ],
  template
})
@InjectUser('user')
export class AppComponent {
  // tutorSub: Subscription;
  // tutor: Observable<Tutor>;
  // is_a_tutor: boolean;
  constructor() {
  }
  // ngOnInit() {
  //   if(Meteor.userId()){
  //     this.tutorSub = MeteorObservable.subscribe('tutors').subscribe(() => {
  //           this.tutor = Tutors.find({userId:{$eq:Meteor.userId()}});        
  //           if(this.tutor){
  //             this.is_a_tutor=true;
  //           }else{
  //             this.is_a_tutor=false;
  //           }
  //           console.log(this.tutor._id);
  //     });
  //   }
  // }
  logout() {
    Meteor.logout();
  }
  // ngOnDestroy() {
  //   if(Meteor.userId()){
  //       this.tutorSub.unsubscribe();
  //   }
  // }
}