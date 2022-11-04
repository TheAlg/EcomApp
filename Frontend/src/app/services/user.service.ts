import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { User } from '../models/user';
import { Router } from '@angular/router';
import { API } from '../config/api';  



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
      next:(user :User | Boolean) => {
        this.setUser(user);
        this.loader =  Promise.resolve(true);
      }
    })
  }

  close()
  {
    this.user$.next(false);
  }

  //check if data is loaded
  isReady() : Promise<Boolean>
  {
    return this.loader;
  }
  
  setUser(response : any)
  {
    this.user$.next(response);
  }
  setAddress(address : any)
  {
    this.userAddress$.next(address);
  }
  setPayement(payement : any){
    this.userPayment$.next(payement);

  }
  getSession() : Observable<User | Boolean> 
  {
    return this.user$;
  }

  getUserAddress() 
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
  }

  updateUser(user: any)
  {
    return this.http.post(API.user.update, user, this.options);
  }

  updateAddress(address:any)
  {
    return this.http.post(API.user.address, address, this.options);

  }
  updatePayement(payement:any)
  {
    return this.http.post(API.user.payment, payement, this.options);

  }






}




