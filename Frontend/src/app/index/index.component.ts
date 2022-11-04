import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, FormControl, Validators } from '@angular/forms';
import { MatSnackBar } from '@angular/material/snack-bar';
import { ActivatedRoute, Router } from '@angular/router';
import { switchMap } from 'rxjs/operators';
import { PasswordValidator } from '../validators/password.validators';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-index',
  templateUrl: './index.component.html',
  styleUrls: ['./index.component.scss']
})
export class IndexComponent implements OnInit {



  public snackBar : MatSnackBar;


  constructor(
    protected route: ActivatedRoute,
    protected userService : AuthService,
    protected fb: FormBuilder,
    protected router : Router,

  ) { 
  }

  ngOnInit(): void {
    //this.userService.getCurrentSession();

      //checking if any request exist to auth component
      if ( this.route.snapshot.queryParamMap.get('requestType')) {

        console.log(this.route.snapshot.queryParamMap.get('requestType'))
        
        this.route.queryParams.pipe(
          switchMap( params => { 
              return this.userService.checkAuthRequest(params.requestType, params) }
            
            ))
          .subscribe(x => {
            if (x.complete){
              this.openSnackBar('success');
              if ( this.route.snapshot.queryParams['requestType'] === 'resetPassword'){
                this.router.navigate(['auth/changepassword']);
              }
            }
            else 
              this.openSnackBar('error');
          })
      }
  }

  openSnackBar(message:string) {

    this.snackBar.open(message, "great", {
      duration: 5 * 1000,
    });
  }

}