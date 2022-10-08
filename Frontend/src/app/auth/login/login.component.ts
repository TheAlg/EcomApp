import { Component, Injector, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { User } from 'src/app/models/user';
import { baseComponent } from '../base.component';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})

export class LoginComponent extends baseComponent implements OnInit {

  
  signInForm : FormGroup;

  constructor(injectorObj: Injector) {
    super(injectorObj);
  }


  ngOnInit() {
    this.signInForm = this.createSingInForm();
  }

  loginUser( user: User ){
    this.userService.signInUser(user);
  }
  
  createSingInForm(){

    // user details form validations
    return this.fb.group({
        email: ['', {
          validators:[
          Validators.required,
          Validators.email
        ],
        updateOn: 'blur'
      }],
        password : new FormControl('', {
          validators : [Validators.required],
          updateOn: 'blur'
      }),
        rememberMe: new FormControl('false')
      })
  }
}

