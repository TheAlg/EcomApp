import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';
import { API } from '../config/api';  



@Injectable({
  providedIn: 'root'
})
export class CartService {


  options  =  {headers: new HttpHeaders({'Content-Type':"application/x-www-form-urlencoded"})};
  

  private cart$: BehaviorSubject<any> = new BehaviorSubject(null);
  private loader: Promise<boolean>;


  constructor(private http: HttpClient) 
  { 
    this.initialize();
  }

  //load the data from api
  initialize()
  {
    this.http.get(API.cart.get).subscribe({
      next:(response :any) => {
        this.setContent(response);
        this.loader =  Promise.resolve(true);
      }
    })
  }

  //check if data is loaded
  isReady() : Promise<Boolean>
  {
    return this.loader;
  }

  getContent() : Observable<any>
  {
    return this.cart$.asObservable();
  }

  setContent(cart : any) 
  {
    this.cart$.next(cart);
  }

  add(id: number): any {
    this.http.post(API.cart.add,{id:id}, this.options)
    .subscribe({
      next:(response:any) => {
        this.setContent(response)
      },
      error:(err: HttpErrorResponse) => {
        console.error( err.error.text) //servers response
      }
    })
  }
  remove(id:number){
    this.http.post(API.cart.remove,{id:id}, this.options).subscribe({
      next:(response:any) => this.setContent(response)
    })
    return this.cart$.asObservable();
  }

}

