import { Component, Injector, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { ParentErrorStateMatcher, PasswordValidator } from '../../validators/password.validators';
import { AuthService } from 'src/app/services/auth.service';
import { FormsService } from 'src/app/services/forms.service';
import { formErrors } from '../../config/Messages';


@Component({
  selector: 'app-reset-password',
  templateUrl: './change-password.component.html',
  styleUrls: ['./change-password.component.scss']
})
export class changePasswordComponent implements OnInit {

authErrors = formErrors;
public parentErrorStateMatcher= new ParentErrorStateMatcher();
resetPasswordForm: FormGroup;

constructor(
  private userService : AuthService,
  private formsProvider : FormsService,
  private fb : FormBuilder) 
{
}


  ngOnInit(): void {
    this.resetPasswordForm = this.creatResetPasswordForm();
  }

  creatResetPasswordForm() {

    return new FormGroup({
      password: new FormControl('', Validators.compose([
        Validators.minLength(5),
        Validators.required,
        Validators.pattern('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]+$')
      ])),
      confirm_password: new FormControl('', Validators.required)
    }, (formGroup: FormGroup) => {
      return PasswordValidator.areEqual(formGroup);
    });

  }
  changePassword(formData) {
   this.userService.changePassword(formData);
  }

}
