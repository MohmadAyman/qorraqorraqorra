import { CollectionObject } from './collection-object.model';

export interface Request extends CollectionObject {
  tutorId?: string; //tutor's UserId
  language: string;
  startDate: Date;
  startTime: Time;
  userId: string;
  comment?: string;
}
