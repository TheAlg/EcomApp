import { Component, Injector, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { User } from 'src/app/models/user';
import { baseComponent } from '../base.component';


@Component({
  selector: 'app-sing-up',
  templateUrl: './sing-up.component.html',
  styleUrls: ['./sing-up.component.css']
})
export class SingUpComponent extends baseComponent implements OnInit {


  signUpForm : FormGroup;


  constructor(injectorObj: Injector) {
    super(injectorObj);
  }

  ngOnInit() {
    this.signUpForm = this.createSingUpForm();
  }

  addUser( user: User ){
    this.userService.addUser(user);
  }
  createSingUpForm(){

    // user details form validations
    return this.fb.group({
        firstName: ['', {
          validators :[
            Validators.required,
            Validators.minLength(3),
            Validators.maxLength(20)],
          updateOn: 'blur'
        }],
        lastName: ['', {
          validators:[
            Validators.required,
            Validators.minLength(3),
            Validators.maxLength(20)
          ],
          updateOn: 'blur' 
        }],
        //this one is not beeing used
        /*username: new FormControl('', Validators.compose([
          UsernameValidator.validUsername,
          Validators.maxLength(25),
          Validators.minLength(5),
          Validators.pattern('^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$'),
          Validators.required
         ])),*/
        email: ['',{
          validators:[
            Validators.required,
            Validators.email
          ],
          updateOn: 'blur'
        } ],
        password : ['', {
          validators:[
            Validators.minLength(5),
            Validators.required,
            Validators.pattern('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]+$')
          ],
          updateOn: 'blur'
        }],
        terms: new FormControl(false, Validators.pattern('true'))
        });
  }

  /*createProfileForm(){

    this.signUpForm = this.fb.group({
      aboutMe: ['', Validators.maxLength(256)],
      birthday: ['', Validators.required],
      gender: new FormControl('', Validators.required), //provide choices for initial value 
      countryPhone:  new FormControl('', Validators.required), //provide choices for initial value 
    });
  }

  matchingPasswordsGroup():FormGroup{
    // matching passwords validation
    return new FormGroup({
        password: new FormControl('', {
          validators:[
            Validators.minLength(5),
            Validators.required,
            Validators.pattern('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]+$')
          ],
          updateOn: 'blur'
        }),
        confirm_password: new FormControl('', Validators.required)
        }, (formGroup: FormGroup) => {
        return PasswordValidator.areEqual(formGroup);
        });
  }*/


}

