import { Component } from '@angular/core';
import { Observable } from 'rxjs/Observable';

import { Tutors } from '../../../both/collections/tutors.collection';
import { Tutor } from '../../../both/models/tutor.model';
import {InjectUser} from "angular2-meteor-accounts-ui";

import template from './app.component.html';
 
@Component({
  selector: 'app',
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