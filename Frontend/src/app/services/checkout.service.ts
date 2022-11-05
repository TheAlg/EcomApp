import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { API } from '../config/api';  


@Injectable({
  providedIn: 'root'
})
export class CheckoutService {
  
  options = {
    headers: new HttpHeaders({'Content-Type':"application/x-www-form-urlencoded"})
  };


  constructor(private http: HttpClient) { }


  getContent() 
  {
    return this.http.get(API.checkout.get)
  }






}
