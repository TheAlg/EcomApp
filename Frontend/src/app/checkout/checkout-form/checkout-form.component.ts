import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormControl } from '@angular/forms';
import { DatePipe } from '@angular/common';
import { FormsService } from 'src/app/services/forms.service';
import {formErrors} from '../../config/Messages';
import countries from '../../metadata/countries.json'
import { CheckoutService } from 'src/app/services/checkout.service';
import { AuthService } from 'src/app/services/auth.service';
import { MatStepper } from '@angular/material/stepper';
import { filter, map } from 'rxjs/operators';
import { UserService } from 'src/app/services/user.service';
import { MatDatepicker } from '@angular/material/datepicker';
import moment, { Moment } from 'moment';


@Component({
  selector: 'app-checkout-form',
  templateUrl: './checkout-form.component.html',
  styleUrls: ['./checkout-form.component.scss'],
})
export class CheckoutFormComponent implements OnInit {


  formErrors = formErrors;
  countryCode = new FormControl('');
  personalInfoFormGroup = this.fb.group({
    firstName   : this.formsProvider.firstName(),
    lastName    : this.formsProvider.lastName(),
    birthday    : this.formsProvider.date(16),
    isoCode     : this.countryCode,
    phoneNumber : this.formsProvider.phoneNumber(this.countryCode)
  })

  addressFormGroup = this.fb.group({
    id          : 0,
    street      : this.formsProvider.text(30),
    complement  : this.formsProvider.text(20),
    postCode    : this.formsProvider.postCode(),
    city        : this.formsProvider.city(),
  })

  creditCardFormGroup = this.fb.group({
    id         : 0,
    number     :  this.formsProvider.cardNumber(),
    name       : this.formsProvider.cardName(),
    expiry     :  new FormControl(moment()),
    code       : this.formsProvider.number(3), 
  })

  countries = countries;
  selectedCountries = this.countries;

  startDate = new Date(2010, 0, 1);

  @ViewChild('stepper') private stepper: MatStepper;

  
  constructor(
    private fb : FormBuilder,
    private formsProvider : FormsService,
    private checkoutService : CheckoutService,
    private userService : UserService) 
    {
    }

  ngOnInit(): void {
    //check user personnal info
    this.userService.getSession().subscribe({
      next:(userObj:any)=>{
          this.personalInfoFormGroup.patchValue(userObj)  
          if (this.personalInfoFormGroup.valid && this.stepper)
            this.stepper.selectedIndex = 1;
      }
    });
    //check address
    this.userService.getUserAddress().pipe
    (map( (address:any[]) => { 
      return address?.filter(e => 
        { return e.default==='T'})[0]
    }))
    .subscribe({
      next:(address:any)=>{
          this.addressFormGroup.patchValue(address)
          //prevent console error
          if (this.stepper)
            this.stepper.selectedIndex = 2;
        }
      })
      //check payement
      this.userService.getUserPayment().pipe
      (map( (payment:any[]) => { 
        return payment?.filter(e => 
          { return e.default==='T'})[0]
      }))
      .subscribe({
        next:(payment:any)=>{
          console.log(payment)
            this.creditCardFormGroup.patchValue(payment)
            //prevent console error
            if (this.stepper)
              this.stepper.selectedIndex = 3;
          }
        })

    }


  checkUser(){
    let formValue = this.personalInfoFormGroup.value;
    //console.log(formValue)
    this.checkoutService.updateUser(formValue).subscribe(
      (response:any)=>{
        if (response.complete){
          this.userService.setUser(response.user)
        
        }
        //else show error
      }
    )
    
  }
  checkAddress(){
    let formValue = this.addressFormGroup.value;
    this.userService.updateAddress(formValue).subscribe(
      (response:any)=>{
        if (response.complete){
          this.userService.setAddress(response.address)
        
        }
        //else show error
      }
    )
    
  }
  checkPayement(){
    let formValue = this.creditCardFormGroup.value;
    console.log(formValue)
    this.userService.updatePayement(formValue).subscribe(
      (response:any)=>{
        console.log(response)
        if (response.complete){
          console.log(response.payement)
          this.userService.setPayement(response.address)
        
        }
        //else show error
      }
    )
    
  }


  changePrefix(){

  }

  onKey(value:string) { 
    this.selectedCountries = this.search(value);
    }
    
  search(value: string) { 
    let filter = value.toLowerCase();
    return this.countries.filter(option => option.name.toLowerCase().startsWith(filter));
  }

  datePickerClose(moment: Moment, datepicker: MatDatepicker<Moment>){
    const ctrlValue = this.creditCardFormGroup.get('expiry').value;
    ctrlValue.month(moment.month());
    ctrlValue.year(moment.year());
    this.creditCardFormGroup.value.expiry = ctrlValue;
    datepicker.close();
  }




}
