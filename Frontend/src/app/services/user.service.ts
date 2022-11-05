import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { User } from '../models/user';

import { Router } from '@angular/router';
import { API } from '../config/api';  
import { filter } from 'rxjs/operators';



@Injectable()
export class UserService {

  options  =  {headers: new HttpHeaders({'Content-Type':"application/x-www-form-urlencoded"})};

  private user$: BehaviorSubject<any> = new BehaviorSubject(null);
  private userAddress$: BehaviorSubject<any> = new BehaviorSubject(null);
  private userPayment$: BehaviorSubject<any> = new BehaviorSubject(null);

  private loader: Promise<boolean>;

  constructor(private http: HttpClient) 
    { 
      this.initialize();
    }

  initialize()
  {
    this.http.get<User | Boolean>(API.user.get).subscribe({
      next:(respone :any | Boolean) => {
        if (respone.complete){
          this.setUser(respone.user);
          this.setAddress(respone.address)
          this.setPayement(respone.payment)
          this.loader =  Promise.resolve(true);
        }
      }
    })
  }

  close()
  {
    this.user$.next(null);
    this.userAddress$.next(null);
    this.userPayment$.next(null);
  }

  //check if data is loaded
  isReady() : Promise<Boolean>
  {
    return this.loader;
  }
  
  setUser(response : any) : void
  {
    this.user$.next(response);
  }
  getUser() : Observable<User | Boolean> 
  {
    return this.user$.pipe(filter(value => !!value));
  }
  setAddress(address : any) : void
  {
    this.userAddress$.next(address);
  }
  getAddress() : Observable<any | []> 
  {
    return this.userAddress$;
  }
  setPayement(payement : any) : void
  {
    this.userPayment$.next(payement);

  }
  getPayment() : Observable<any | []> 
  {
    return this.userPayment$;
  }


  /*getUserAddress() 
  {
    this.http.get(API.user.address, this.options).subscribe(
        (response:any) => {
          if (response.complete){
            this.setAddress(response.address)
          }
        }
            
    );
   
     return this.userAddress$.asObservable();
  }
  getUserPayment() 
  {
    this.http.get(API.user.payment).subscribe(
      (response:any) => {
        if (response.complete){
            this.setPayement(response.payment)
        }
      } 
  );
  return this.userPayment$.asObservable();
  }*/

  postUser(user: any)
  {
    return this.http.post(API.user.update, user, this.options);
  }

  postAddress(address:any)
  {
    return this.http.post(API.user.address, address, this.options);

  }
  postPayement(payement:any)
  {
    return this.http.post(API.user.payment, payement, this.options);

  }






}




