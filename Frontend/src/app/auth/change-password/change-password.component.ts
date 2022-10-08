import { Component, Injector, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { baseComponent } from '../base.component';
import { PasswordValidator } from '../validators/password.validators';

@Component({
  selector: 'app-reset-password',
  templateUrl: './change-password.component.html',
  styleUrls: ['./change-password.component.scss']
})
export class changePasswordComponent extends baseComponent implements OnInit {


resetPasswordForm: FormGroup;

constructor(injectorObj: Injector) {
  super(injectorObj);
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
