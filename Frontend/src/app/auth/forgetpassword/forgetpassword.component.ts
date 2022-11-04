import { Component, OnInit } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { AuthService } from 'src/app/services/auth.service';
import { FormsService } from 'src/app/services/forms.service';
import { formErrors } from '../../config/Messages';

@Component({
  selector: 'app-forgetpassword',
  templateUrl: './forgetpassword.component.html',
  styleUrls: ['./forgetpassword.component.scss']
})
export class ForgetpasswordComponent implements OnInit {


  ForgotPasswordForm = this.fb.group({
    email : this.formsProvider.email()
  });
  authErrors = formErrors;

  constructor(
    private userService : AuthService,
    private fb : FormBuilder,
    private formsProvider : FormsService)
  {
   
  }

  ngOnInit() {
  }

  forgetPassword( user: any ){
    this.userService.forgetPassword(user).subscribe(
      (x)=>console.log(x)
    )
  }

  
}
