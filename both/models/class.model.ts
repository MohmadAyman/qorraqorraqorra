import { CollectionObject } from './collection-object.model';

export interface Class_ extends CollectionObject {
  tutorId: string; //tutor's UserId
  name: string;
  language: string;
  startDate: Date;
  startTime: string;
  description?: string;
  rating?: Number;
  maxCapacity?: Number;
  usersIds?: string[];
  requestesIds?: string[];
  active?: boolean;
  tutorEmail?: string;
}

interface Schedule {
  startDate: Date;
  startTime?: string;
}