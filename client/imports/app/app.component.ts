import { Component } from '@angular/core';
import { Observable } from 'rxjs/Observable';

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

  constructor() {
  }

  logout() {
    Meteor.logout();
  }
}