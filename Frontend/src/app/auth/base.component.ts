import { Component, Injector } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { ActivatedRoute, NavigationEnd, Router } from '@angular/router';
import {MatSnackBar} from '@angular/material/snack-bar';
import { AuthService } from '../services/auth.service';
import { authErrors } from './Messages';
import { ParentErrorStateMatcher } from './validators/password.validators';

@Component({template:''})

export abstract class baseComponent  {


  protected fb: FormBuilder;
  protected userService : AuthService;
  public route : ActivatedRoute;
  protected router : Router
  public authErrors = authErrors;
  public snackBar : MatSnackBar;
  public parentErrorStateMatcher= new ParentErrorStateMatcher();
  
  
  constructor(private injectorObj: Injector) {

    this.router = this.injectorObj.get(Router);
    this.fb = this.injectorObj.get(FormBuilder);
    this.userService = this.injectorObj.get(AuthService);
    this.route = this.injectorObj.get(ActivatedRoute);
    this.snackBar =  this.injectorObj.get(MatSnackBar);

  }


  durationInSeconds = 5;
  messages = {
    success : "succes",
    error : "error"
  }
  
  openSnackBar(message:string) {

    this.snackBar.open(message, "great", {
      duration: this.durationInSeconds * 1000,
    });
  }

}


