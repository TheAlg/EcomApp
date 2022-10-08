import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { observable, Observable, of, throwError } from 'rxjs';
import { User } from '../models/user';
import { catchError, map, tap } from 'rxjs/operators';
import { AuthModule } from '../auth/auth.module';
import { ParamMap } from '@angular/router';



@Injectable()
export class AuthService {


  User : User;

  constructor(private http: HttpClient) { }



  getUserToken() {

   this.http.get('http://ecommerce.test/auth/securityToken', {responseType: 'text'}).subscribe({
      next: (val: string) => {
        console.log('got security token: ' + val)
      },
      error:(err: HttpErrorResponse) => console.log('got an error : security token' + err.error.text)
    })

  }

addUser(user: any): any {
    const httpOptions = {
      headers: new HttpHeaders({'Content-Type':"application/x-www-form-urlencoded"})
    };
    this.http.post('http://127.0.0.1/auth/addUser',user, httpOptions)
    .subscribe({
      next:(response) => {
        console.log('row server response : ' + JSON.stringify(response));
      },
      error:(err: HttpErrorResponse) => {
        console.log('error : row server response :' + err.error.text) //servers response
      }
    })
}

signInUser(user: User) {
  const httpOptions = {
    headers: new HttpHeaders({'Content-Type':"application/x-www-form-urlencoded"})
  };
    this.http.post('http://127.0.0.1/auth/login',user, httpOptions)
    .subscribe({
      next:(response) => {
        console.log('row server response : ' + JSON.stringify(response));
      },
      error:(err: HttpErrorResponse) => {
        console.log('error : row server response :' + err.error.text) //servers response
      }
    })
}

forgetPassword(user: User) {
  const httpOptions = {
    headers: new HttpHeaders({'Content-Type':"application/x-www-form-urlencoded"})
  };
    this.http.post('http://127.0.0.1/auth/forgetPassword',user, httpOptions)
    .subscribe({
      next:(response) => {
        console.log('row server response : ' + JSON.stringify(response));
      },
      error:(err: HttpErrorResponse) => {
        console.error('error : row server response :' + err.error.text) //servers response
      }
    })
}

checkAuthRequest(requestType:string , params:any) : Observable<any>
{
  const httpOptions = {
    headers: new HttpHeaders({'Content-Type':"application/x-www-form-urlencoded"})
  };
    return this.http.post('http://127.0.0.1/auth/'+requestType, params, httpOptions )
}

changePassword(formData) {
  const httpOptions = {
    headers: new HttpHeaders({'Content-Type':"application/x-www-form-urlencoded"})
  };
     this.http.post('http://127.0.0.1/auth/changePassword', formData, httpOptions )
    .subscribe({
      next:(response) => {
        console.log('row server response : ' + JSON.stringify(response));
      },
      error:(err: HttpErrorResponse) => {
        console.error('error : row server response :' + err.error.text) //servers response
      }
    })
  }
getCurrentSession() {

  this.http.get('http://ecommerce.test/auth/getCurrentSession', {responseType: 'text'}).subscribe({
    next: (val: string) => {
      console.log('got security token: ' + val)
    },
    error:(err: HttpErrorResponse) => console.log('got an error : security token' + err.error.text)
    })
  }
}


