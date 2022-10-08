import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { changePasswordComponent } from './change-password/change-password.component';
import { ForgetpasswordComponent } from './forgetpassword/forgetpassword.component';
import { LoginComponent } from './login/login.component';
import { checkRequestsComponent } from './check-requests/request.component';
import { SingUpComponent } from './sing-up/sing-up.component';


const routes: Routes = [
  {
    path : 'check-request/:requestType/:requestId/:userId',
    component: checkRequestsComponent,
  },
  {
    path : 'login',
    component: LoginComponent,
  },
  {
    path : 'signup',
    component: SingUpComponent,
    },
    {
    path : 'forgotpassword',
    component: ForgetpasswordComponent,
    }, 
    {
    path : 'changepassword',
    component: changePasswordComponent,
    },
]



@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AuthRoutingModule { }
