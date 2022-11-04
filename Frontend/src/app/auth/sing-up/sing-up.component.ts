import { HttpErrorResponse } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';
import { FormsService } from 'src/app/services/forms.service';
import { formErrors } from '../../config/Messages';


@Component({
  selector: 'app-sing-up',
  templateUrl: './sing-up.component.html',
  styleUrls: ['./sing-up.component.css']
})
export class SingUpComponent implements OnInit {

  authErrors = formErrors;
  serverError= {
    error : false,
    message : ''
  }

  constructor(
    private formsProvider : FormsService,
    private fb : FormBuilder,
    private authService : AuthService,
    private router : Router) 
  {
   
  }

  signUpForm = {
    email   : this.formsProvider.email(),
    password: this.formsProvider.password(),
    terms   : this.formsProvider.terms(),
  }
  signUpFormGroup = this.fb.group(this.signUpForm)



  ngOnInit() {
   
  }

  addUser( user: any ){
    this.serverError.error = false;
    this.authService.addUser(user)      
    .subscribe({
      next:(response:any) => {
        if (response.complete ){
          //this.authService.setUser(response.user);
          this.router.navigate(['/products'])
          //todo -> message : welcome user 
        }
        else {
          this.serverError.error = true
          this.serverError.message = response.message
        }
      },
      error:(err: HttpErrorResponse) => {
        console.error(err.error.text) //servers response
      }
    })
  }




}

