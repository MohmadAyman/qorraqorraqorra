import { Component, OnInit, OnDestroy } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import { Subscription } from 'rxjs/Subscription';
import { Meteor } from 'meteor/meteor';
import { MeteorObservable } from 'meteor-rxjs';
import { InjectUser } from "angular2-meteor-accounts-ui";
import {ROUTER_DIRECTIVES, Router, Location} from 'angular2/router';
import { Requests } from '../../../../both/collections/requests.collection';
import { Request } from '../../../../both/models/request.model';
import { Tutor } from  '../../../../both/models/tutor.model';


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
  tutorSub: Subscription;
  class: Class_;
  user: Meteor.User;
  users_requests: string[];
  numberOfInStudends: number;
  skypeCallString: string;
  tutor: Tutor;
  
  constructor(
    private route: ActivatedRoute
  ) {}

  ngOnInit() {
    // this.paramsSub = this.route.params
    //   .map(params => params['classId'])
    //   .subscribe(classId => {
    //     this.classId = classId;
        
    //     // if (this.classSub) {
    //     //   this.classSub.unsubscribe();
    //     // }
    //  });

    //   this.classSub = MeteorObservable.subscribe('classes').subscribe(() => {
    //       console.log(this.classId);
    //       this.class = Classes.findOne(this.classId);
    //       this.users_requests = this.class.enrollmentRequests;
    //     //   if(this.class.usersIds){
    //     //     this.numberOfInStudends = this.class.usersIds.length;
    //     //   }
    //     //   if(this.class.tutorEmail)
    //     //     this.skypeCallString = 'skype:'+this.class.tutorEmail+'?call';
    //     // }
    //     });

   this.paramsSub = this.route.params
      .map(params => params['classId']) 
      .subscribe(classId => {
        this.classId = classId;
        if (this.tutorSub) {
          this.classSub.unsubscribe();
        }
    });
    this.classSub = MeteorObservable.subscribe('classes').subscribe(() => {
      this.class=Classes.findOne(this.classId);
      // this.tutorAsUserId=this.tutor.userId;
    });
    
    if(Meteor.userId()===this.class.tutorId){
      this.tutor=true;
    }else{this.tutor=false;}
    
 }

  get isOwner(): boolean {
    return this.class && this.user && this.user._id === this.class.tutorId;
  }
  
  // get isEnrolled(): boolean {
  //   if(this.class.usersIds){
  //     return Classes.findOne({
  //         usersIds:{
  //           $elemMatch:{$eq: this.user._id}
  //         }
  //       }).name == this.class.name;
  //   }
  //   return false;
  // }

  get isEnrolled(): boolean {
    if(this.class.userId){
      return Classes.findOne({
          userId:{$eq: this.user._id}
        });
      }
    return false;
  }

  get alreadyRequested(): boolean{
    if(this.class.enrollmentRequests){
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


  askForEnrollment(){
    if(!this.isOwner && this.user && !this.isEnrolled){
      Classes.update(this.class._id, {
        $push:{ enrollmentRequests: Meteor.userId() }
      });
      alert('your request has benn made, thanks');
      window.location.href = '/thanks';
    }
  }

  acceptEnrollment(): void {

  }

  activateClass(c: Class_):void{
    // if (!Meteor.userId()||!this.isOwner) {
    //   alert('Are you the tutor of this class?');
    //   return;
    // }
    // Classes.update(this.class._id, {
    //       $set:{
    //           name: this.class.name,
    //           language: this.class.language,
    //           tutorId: this.class.tutorId,
    //           schedule: this.class.schedule,
    //           active: true
    //     }
    //   });
  }


  deactivateClass(c: Class_):void{
    // if (!Meteor.userId()||!this.isOwner) {
    //   alert('Are you the tutor of this class?');
    //   return;
    // }
    // Classes.update(this.class._id, {
    //       $set:{
    //           name: this.class.name,
    //           language: this.class.language,
    //           tutorId: this.class.tutorId,
    //           schedule: this.class.schedule,
    //           active: false
    //     }
    //   });
  }

  saveClass(){
    // if (!Meteor.userId()||!this.isOwner) {
    //   alert('Are you the tutor of this class?');
    //   return;
    // }
    // Classes.update(this.class._id, {
    //       $set:{
    //           name: this.class.name,
    //           language: this.class.language,
    //           tutorId: this.class.tutorId,
    //           schedule: this.class.schedule,
    //           active: false
    //     }
    //   });
  }

    // only activate when owner
    removeClass(): void {
      if(this.class.tutorId === this.user._id){ //checking agin before excuting the query
          Classes.remove(this.class._id);
          alert('Class removed sucessfuly');
      }else{
        alert('Are you the tutor of this class?');
      }
    }

  ngOnDestroy() {
    this.classSub.unsubscribe();
    this.paramsSub.unsubscribe();
  }
}