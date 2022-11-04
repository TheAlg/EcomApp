import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { LoginComponent } from './login/login.component';
import { SingUpComponent } from './sing-up/sing-up.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AngularMaterialModule } from '../angular-material.module';
import { AuthService } from '../services/auth.service';
import { ForgetpasswordComponent } from './forgetpassword/forgetpassword.component';
import { changePasswordComponent } from './change-password/change-password.component';
import { AuthRoutingModule } from './auth-routing.module';
import { UserService } from '../services/user.service';



@NgModule({
  declarations: [
    SingUpComponent,
    LoginComponent,
    ForgetpasswordComponent,
    changePasswordComponent
  ],
  imports: [
    CommonModule,
    AuthRoutingModule,
    ReactiveFormsModule,
    AngularMaterialModule,
    BrowserAnimationsModule,
  ],
  providers: [
    AuthService,
    UserService,
    //AuthGuard
  ],
})
export class AuthModule {

}
