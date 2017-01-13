import { MongoObservable } from 'meteor-rxjs';
import { Tutor } from '../models/tutor.model';

export const Tutors = new MongoObservable.Collection<Tutor>('tutors');

function loggedIn() {
  return true;
}


Tutors.allow({
  insert: loggedIn,
  update: loggedIn,
  remove: loggedIn
});