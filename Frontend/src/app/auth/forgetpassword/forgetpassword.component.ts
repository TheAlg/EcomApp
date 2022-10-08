import { Component, Injector, OnInit } from '@angular/core';
import { FormGroup, Validators } from '@angular/forms';
import { User } from 'src/app/models/user';
import { baseComponent } from '../base.component';

@Component({
  selector: 'app-forgetpassword',
  templateUrl: './forgetpassword.component.html',
  styleUrls: ['./forgetpassword.component.scss']
})
export class ForgetpasswordComponent extends baseComponent implements OnInit {

  ForgotPasswordForm : FormGroup;

  constructor(injectorObj: Injector) {
    super(injectorObj);
  }

  ngOnInit() {
    this.ForgotPasswordForm = this.createForgotPasswordForm();
  }

  forgetPassword( user: User ){
    this.userService.forgetPassword(user);
  }

  createForgotPasswordForm(){

    // user details form validations
    return this.fb.group({
        email: ['', {
          validators:[
          Validators.required,
          Validators.email],
        }],
    })
  }
  
}
