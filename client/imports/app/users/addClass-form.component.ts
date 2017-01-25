import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Tutors } from '../../../../both/collections/tutors.collection';
import { Requests } from '../../../../both/collections/requests.collection';
import { Meteor } from 'meteor/meteor';
import template from './addClass-form.component.html';


@Component({
  selector: 'addClass-Userform',
  template
})
export class AddClassUserFormComponent implements OnInit{
 startDate: any;
 addForm: FormGroup;
 
  constructor(
    private formBuilder: FormBuilder
      ) {
    this.location = location; 
  }
 
  ngOnInit() {
    this.addForm = this.formBuilder.group({
      language: ['', Validators.required],
      startDate: [''],
      startTime: [''],
      comment: ['']
    });
  }

  addClass(): void {

     if (!Meteor.userId()) {
      alert('Please log in first');
      return;
    }
    
    if (this.addForm.valid) {
      Requests.insert(Object.assign({},this.addForm.value,{ userId: Meteor.userId() }));
 
      this.addForm.reset();
      window.location.href = '/tutors';
    }
  }

}