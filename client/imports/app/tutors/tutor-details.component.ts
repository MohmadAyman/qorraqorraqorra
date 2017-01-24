import { Component, OnInit, OnDestroy } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import { Subscription } from 'rxjs/Subscription';
import { Meteor } from 'meteor/meteor';
import { MeteorObservable } from 'meteor-rxjs';
import { InjectUser } from "angular2-meteor-accounts-ui";
import {ROUTER_DIRECTIVES, Router, Location} from "angular2/router";


import 'rxjs/add/operator/map';

import { Users } from '../../../../both/collections/users.collection';

import { Classes } from '../../../../both/collections/classes.collection';
import { Class_ } from  '../../../../both/models/class.model';

import { Tutors } from '../../../../both/collections/tutors.collection';
import { Tutor } from  '../../../../both/models/tutor.model';

import template from './tutor-details.component.html';

@Component({
  selector: 'tutor-details',
  template
})
@InjectUser('user')
export class TutorDetailsComponent implements OnInit, OnDestroy {
  tutorId: string;
  tutor: Tutor;
  paramsSub: Subscription;
  classesSub: Subscription;
  tutorSub: Subscription;
  mailtoTutor: string;
  tutor_user_email: string;
  //TODO enable tutors to hold more than one class.
  class: Class_;
  tutorClasses: Class_[];
  user: Meteor.User;

  constructor(
    private route: ActivatedRoute
  ) {}

  ngOnInit() {
    this.paramsSub = this.route.params
      .map(params => params['tutorId']) 
      .subscribe(tutorId => {
        this.tutorId = tutorId;
        if (this.tutorSub) {
          this.tutorSub.unsubscribe();
        }
    });
    this.tutorSub = MeteorObservable.subscribe('tutors').subscribe(() => {
      this.tutor=Tutors.findOne({userId: {$eq: this.tutorId} });
    });
    
    this.tutorSub = MeteorObservable.subscribe('users').subscribe(() => {
      this.tutor_user_email=Users.findOne(this.tutorId).emails[0].address;
      this.mailtoTutor="mailto:"+ this.tutor_user_email;
      console.log(this.mailtoTutor);
  });
    
    
    //TODO only find classes that this tutor do
    // this.classesSub = MeteorObservable.subscribe('classes').subscribe(() => {
    //   this.tutorClasses = Classes.find().zone();
    // });
  }

    ngOnDestroy() {
      // this.classesSub.unsubscribe();
      this.paramsSub.unsubscribe();
      this.tutorSub.unsubscribe();
    }

}