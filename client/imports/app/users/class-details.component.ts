import { Component, OnInit, OnDestroy } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import { Subscription } from 'rxjs/Subscription';
import { Meteor } from 'meteor/meteor';
import { MeteorObservable } from 'meteor-rxjs';
import { InjectUser } from "angular2-meteor-accounts-ui";

import 'rxjs/add/operator/map';

import { Classes } from '../../../../both/collections/classes.collection';
import { Class_ } from  '../../../../both/models/class.model';
 
import template from './class-details.component.html';

@Component({
  selector: 'class-details',
  template
})
@InjectUser('user')
export class ClassDetailsComponent implements OnInit, OnDestroy {
  classId: string;
  paramsSub: Subscription;
  class: Class_;
  user: Meteor.User;


  constructor(
    private route: ActivatedRoute
  ) {}

  ngOnInit() {
    this.paramsSub = this.route.params
      .map(params => params['classId'])
      .subscribe(classId => {
        this.classId = classId
        
        this.class = Classes.findOne(this.classId);
      });
  }

  get isOwner(): boolean {
    return this.class && this.user && this.user._id === this.class.tutorId;
  }

  // get isEnrolled(): boolean {
      // if (this.user) {
      //   console.log(Classes.find({
      //     usersIds:{
      //       $elemMatch:{$eq: this.user._id}
      //     }
      //   }))
      // }
  // }

//  getcourses() {
    // if (this.user) {
    //   console.log(classes.find({},{'usersIds':this.user._id}).zone());
    // }
//  }

// this should be turned into ask for enrolllment later
  enroll(){
    Classes.update(this.class._id, {
        $push:{ usersIds: Meteor.userId() }
      });
  }

  saveClass(){
    if (!Meteor.userId()) {
      alert('Please log in to change this party');
      return;
    }
    Classes.update(this.class._id, {
          $set:{
              name: this.class.name,
              language: this.class.language,
              tutorId: this.class.tutorId,
              schedule: this.class.schedule
        }
      });
  }

  ngOnDestroy() {
    this.paramsSub.unsubscribe();
  }
}