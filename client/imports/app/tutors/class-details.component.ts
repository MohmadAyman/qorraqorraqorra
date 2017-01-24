import { Component, OnInit, OnDestroy } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import { Subscription } from 'rxjs/Subscription';
import { Meteor } from 'meteor/meteor';
import { MeteorObservable } from 'meteor-rxjs';
import { InjectUser } from "angular2-meteor-accounts-ui";
import {ROUTER_DIRECTIVES, Router, Location} from 'angular2/router';


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

  enroll(): void {
    if(!this.isOwner && this.user && !this.isEnrolled){
      Classes.update(this.class._id, {
          $push:{ requestesIds: Meteor.userId() }
        });
    }
  }

  acceptEnrollment(): void {

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

    // only activate when owner
    removeClass(): void {
      if(this.class.tutorId === this.user._id){ //checking agin before excuting the query
          Classes.remove(this.class._id);
          alert('Class removed sucessfuly');
          this.location.replaceState('/');
      }else{
        alert('Are you the tutor of this class?');
      }
    }

  ngOnDestroy() {
    this.classSub.unsubscribe();
    this.paramsSub.unsubscribe();
  }
}