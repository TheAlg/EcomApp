import { Component, Injector, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';
import { FormsService } from 'src/app/services/forms.service';
import { formErrors } from '../../config/Messages';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})

export class LoginComponent implements OnInit {

  
  signInForm = {
    email : this.formsProvider.email(),
    password : this.formsProvider.password(),
    rememberMe: new FormControl('false')
  }
  signInFormGroup = this.fb.group(this.signInForm)

  authErrors= formErrors;
  serverResponse = {
    error : false,
    message : ''
  }

  constructor(
    private router : Router,
    private authService : AuthService,
    private formsProvider : FormsService,
    private fb : FormBuilder,

  ) {
  }



  ngOnInit() {
  }

  loginUser( user: any ){
    this.serverResponse.error = false;
    this.authService.signIn(user).subscribe(
      (response:any)=>
      { 
        if (response.complete){
          //setting user in observable 
          //this.authService.setUser(response.user)
          this.router.navigate(['/products']);
        }
        else{
          this.serverResponse.error = true;
          this.serverResponse.message = response.message

        }
      }
    );
  }

}


