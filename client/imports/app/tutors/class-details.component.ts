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
  classSub: Subscription;
  class: Class_;
  user: Meteor.User;
  students: string[];
  numberOfInStudends: number;
  skypeCallString: string;

  constructor(
    private route: ActivatedRoute
  ) {}

  ngOnInit() {
    this.paramsSub = this.route.params
      .map(params => params['classId'])
      .subscribe(classId => {
        this.classId = classId
        
        if (this.classSub) {
          this.classSub.unsubscribe();
        }

        this.classSub = MeteorObservable.subscribe('classes', this.classId).subscribe(() => {
          MeteorObservable.autorun().subscribe(() => {
            this.class = Classes.findOne(this.classId);
            if(this.class.usersIds){
              this.numberOfInStudends = this.class.usersIds.length;
            }
            if(this.class.tutorEmail)
              this.skypeCallString = 'skype:'+this.class.tutorEmail+'?call';
          });
        });
     });
 }

  get isOwner(): boolean {
    return this.class && this.user && this.user._id === this.class.tutorId;
  }
  
  get isEnrolled(): boolean {
    if(this.class.usersIds){
      return Classes.findOne({
          usersIds:{
            $elemMatch:{$eq: this.user._id}
          }
        }).name == this.class.name;
    }
    return false;
  }

  get isUser(): boolean {
    return this.class && this.user;
  }

  //  getcourses() {
      // if (this.user) {
      //   console.log(classes.find({},{'usersIds':this.user._id}).zone());
      // }
  //  }

  // this should be turned into ask for enrolllment later

  enroll(){
    if(!this.isOwner){
      Classes.update(this.class._id, {
          $push:{ usersIds: Meteor.userId() }
        });
    }
  }


  activateClass(c: Class_):void{
    if (!Meteor.userId()||!this.isOwner) {
      alert('Are you the tutor of this class?');
      return;
    }
    Classes.update(this.class._id, {
          $set:{
              name: this.class.name,
              language: this.class.language,
              tutorId: this.class.tutorId,
              schedule: this.class.schedule,
              active: true
        }
      });
  }


  deactivateClass(c: Class_):void{
    if (!Meteor.userId()||!this.isOwner) {
      alert('Are you the tutor of this class?');
      return;
    }
    Classes.update(this.class._id, {
          $set:{
              name: this.class.name,
              language: this.class.language,
              tutorId: this.class.tutorId,
              schedule: this.class.schedule,
              active: false
        }
      });
  }

  saveClass(){
    if (!Meteor.userId()||!this.isOwner) {
      alert('Are you the tutor of this class?');
      return;
    }
    Classes.update(this.class._id, {
          $set:{
              name: this.class.name,
              language: this.class.language,
              tutorId: this.class.tutorId,
              schedule: this.class.schedule,
              active: false
        }
      });
  }

  ngOnDestroy() {
    this.classSub.unsubscribe();
    this.paramsSub.unsubscribe();
  }
}