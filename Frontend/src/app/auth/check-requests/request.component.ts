import { Component, Injector, OnInit } from '@angular/core';


@Component({template: '',})
export class checkRequestsComponent implements OnInit {


  requests =['resetPassword', 'confirmEmail']
  
  constructor(injectorObj: Injector) {

  }

  ngOnInit(): void {
  /*let params = this.route.snapshot.paramMap

  if ( this.requests.includes(params.get('requestType'))){

    this.userService.checkAuthRequest(params.get('requestType'), 
      {code : params.get('requestId'), email: params.get('userId')})
        .subscribe(
        (response) =>{
        if (response.complete && params.get('requestType') === "resetPassword"){
          return this.router.navigate(['/changepassword'])  
          }
        if (response.complete && params.get('requestType') === "confirmEmail"){
          this.openSnackBar('your email have been confirmed succesfully')
          return this.router.navigate(['']);
          }
        })
    }  
    this.router.navigate(['']);*/
  }


}
