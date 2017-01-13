import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Tutors } from '../../../../both/collections/tutors.collection';
import { Classes } from '../../../../both/collections/classes.collection';

import template from './addClass-form.component.html';
 
@Component({
  selector: 'addClass-form',
  template
})
export class AddClassFormComponent implements OnInit{

 addForm: FormGroup;
 
  constructor(
    private formBuilder: FormBuilder
  ) {}
 
  ngOnInit() {
    this.addForm = this.formBuilder.group({
      name: ['', Validators.required],
      language: ['', Validators.required],
      schedule : []
    });
  }

  addClass(): void {
     if (!Meteor.userId()) {
      alert('Please log in to add a party');
      return;
    }
  
    if (this.addForm.valid) {
      Classes.insert(Object.assign({},this.addForm.value,{ tutorId: Meteor.userId() }));
 
      this.addForm.reset();
    }
  }

}