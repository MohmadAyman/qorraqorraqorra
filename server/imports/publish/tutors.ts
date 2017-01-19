import { Tutors } from '../../../both/collections/tutors.collection';

Meteor.publish('tutors', () => Tutors.find());
