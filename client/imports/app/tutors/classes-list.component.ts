import { Component, OnInit, OnDestroy } from '@angular/core';
import { Observable } from 'rxjs/Observable';
import { Subscription } from 'rxjs/Subscription';
import { Meteor } from 'meteor/meteor';
import { MeteorObservable } from 'meteor-rxjs';
import { Classes } from '../../../../both/collections/classes.collection';
import { Class_ } from  '../../../../both/models/class.model';
import { Request } from  '../../../../both/models/request.model';
import { Requests } from '../../../../both/collections/requests.collection';

import template from './classes-list.component.html';
 
@Component({
  selector: 'classes-list',
  template
})
export class ClassesListComponent implements OnInit, OnDestroy {
  classes: Observable<Class_[]>;
  classSub: Subscription;
  requests: Observable<Request[]>;
  reqSub: Subscription;
  is_a_user: boolean;

    ngOnInit() {
      if(Meteor.userId()){
        this.is_a_user = true;
          this.reqSub = MeteorObservable.subscribe('requests').subscribe(() => {
              this.requests = Requests.find({userId:{$eq:Meteor.userId()}}).zone();
          });
          this.classSub = MeteorObservable.subscribe('classes').subscribe(() => {
              this.classes = Classes.find({userId:{$eq:Meteor.userId()}}).zone();
          });
        }
      }
  
  ngOnDestroy() {
    if(Meteor.userId()){
        this.reqSub.unsubscribe();
        this.classSub.unsubscribe();
    }
  }
}