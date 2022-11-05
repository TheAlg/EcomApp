import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { User } from '../models/user';
import { Router } from '@angular/router';
import { API } from '../config/api';  
import { UserService } from './user.service';



@Injectable()
export class AuthService {

  options  =  {headers: new HttpHeaders({'Content-Type':"application/x-www-form-urlencoded"})};
  
  constructor(
    private http: HttpClient,
    private userService : UserService,
    private router : Router) 
    { 

    }

    addUser(user: any): any 
    {
      return this.http.post(API.auth.singup, user, this.options)
    }

    signIn(user: User) : Observable<any>
    {
      return this.http.post<any>(API.auth.login,user, this.options)
    }

    forgetPassword(user: User) : Observable<any>
    {
        return this.http.post(API.auth.forgetPassword ,user, this.options)
    }

    changePassword(formData) 
    {
        return this.http.post(API.auth.changePassword, formData, this.options )
    }

    logout() 
    {
      this.http.post(API.auth.logout, null, this.options).subscribe()
      this.userService.close();
      return this.router.navigate(['/login'])
    }

    checkAuthRequest(requestType:string , params:any) : Observable<any>
    {
        return this.http.post('http://localhost:8000/session/'+requestType, params, this.options )
    }

}




