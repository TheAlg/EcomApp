import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CartService {


  constructor(private http: HttpClient) { }


  add(id: number): any {
    const httpOptions = {
      headers: new HttpHeaders({'Content-Type':"application/x-www-form-urlencoded"})
    };
    this.http.post('http://localhost:8000/cart/add',{id:id}, httpOptions)
    .subscribe({
      next:(response) => {
        console.log(response);
      },
      error:(err: HttpErrorResponse) => {
        console.error( err.error.text) //servers response
      }
    })
  }
  remove(id:number){
    const httpOptions = {
      headers: new HttpHeaders({'Content-Type':"application/x-www-form-urlencoded"})
    };
    return this.http.post('http://localhost:8000/cart/remove',{id:id}, httpOptions);
  }
  getContent() {
    return this.http.get('http://localhost:8000/cart/getCart')
  }
}
