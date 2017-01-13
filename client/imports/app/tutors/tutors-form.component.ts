import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormArray } from '@angular/forms';
import { Meteor } from 'meteor/meteor';
// import { AccountsModule } from 'angular2-meteor-accounts-ui';

import { Tutors } from '../../../../both/collections/tutors.collection';

import template from './tutors-form.component.html';

@Component({
  selector: 'tutors-form',
  template
})

export class TutorsFormComponent implements OnInit {
  addForm: FormGroup;
  // language_list = [
  //   { display: 'Arabic' },
  //   { display: 'English' },
  //   { display: 'French' },
  // ];

  constructor(
    private formBuilder: FormBuilder
  ) {}

  // AccountsModule.onCreateUser(function(options, user) {
  //     console.log(user._id);

  //     return user;
  // });

  ngOnInit() {
    this.addForm = this.formBuilder.group({
      name: ['', Validators.required],
      hourly_rating: ['', Validators.required],
      language: ['', Validators.required]
    });
  }

  addTutor(): void {
    if (this.addForm.valid) {
      Tutors.insert(this.addForm.value);
 
      this.addForm.reset();
    }
  }
//   addTutor(): void {
//     if (Meteor.userId()) {
//       alert('login first to be able to register as a Tutor');
//       return;
//     }

//     if (this.addForm.valid) {
//       Tutors.insert({
//         name: this.addForm.value.name,
//         description: this.addForm.value.description,
//         location: {
//           name: this.addForm.value.location
//         },
//         images: this.images,
//         public: this.addForm.value.public,
//         owner: Meteor.userId()
//       });

//       this.addForm.reset();
//     }
//   }

//   onImage(imageId: string) {
//     this.images.push(imageId);
//   }
}
