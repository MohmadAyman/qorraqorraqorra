import { Component, OnInit, OnDestroy } from '@angular/core';
import { Observable } from 'rxjs/Observable';
import { Subscription } from 'rxjs/Subscription';
import { Meteor } from 'meteor/meteor';
import { MeteorObservable } from 'meteor-rxjs';

import { Classes } from '../../../../both/collections/classes.collection';
import { Class_ } from  '../../../../both/models/class.model';
 
import template from './classes-list.component.html';
 
@Component({
  selector: 'classes-list',
  template
})
export class ClassesListComponent implements OnInit, OnDestroy {
  classes: Observable<Class_[]>;
  classSub: Subscription;

    ngOnInit() {
          this.classSub = MeteorObservable.subscribe('classes', this.classId).subscribe(() => {
          MeteorObservable.autorun().subscribe(() => {
            this.classes = Classes.find({});
          });
        });
      }

    // only activate when owner
    removeClass(c: Class_): void {
        Classes.remove(c._id);
    }
  ngOnDestroy() {
    this.classSub.unsubscribe();
  }
}