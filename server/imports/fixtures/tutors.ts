import { Tutors } from '../../../both/collections/tutors.collection';

export function loadTutors() {
  if (Tutors.find().cursor.count() === 0) {
    // const tutors = [{
    //   name: 'Dubstep-Free Zone',
    //   description: 'Can we please just for an evening not listen to dubstep.',
    //   location: 'Palo Alto'
    // }];
 
    // parties.forEach((party) => Parties.insert(party));
  }
}
