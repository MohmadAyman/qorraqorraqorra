import { Component } from '@angular/core';
import { Observable } from 'rxjs/Observable';
import { Meteor} from 'meteor/meteor';
import { Tutors } from '../../../both/collections/tutors.collection';
import { Tutor } from '../../../both/models/tutor.model';
import {InjectUser} from "angular2-meteor-accounts-ui";

import template from './home.component.html';
// import style from './home.component.scss';

@Component({
  selector: 'home',
  template
//   styles : [style] 
})
@InjectUser('user')
export class HomeComponent {

  constructor() {
  }

logout() {
    Meteor.logout();
  }
}