import { validateHorizontalPosition } from '@angular/cdk/overlay';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class MetdataService {

  constructor(private http: HttpClient) { }

  countries : any;

  getCoutnriesByCode() 
  {

 
   }
}
