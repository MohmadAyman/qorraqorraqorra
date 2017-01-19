import { CollectionObject } from './collection-object.model';
import { Meteor } from 'meteor/meteor';

export interface Tutor extends CollectionObject{
  userId: string;
  name: string;
  hourly_rating: number;
  language: string;
  classesIds?: string[];
}
