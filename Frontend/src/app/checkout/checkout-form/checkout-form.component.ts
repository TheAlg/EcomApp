import { AfterViewInit, Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormControl } from '@angular/forms';
import { FormsService } from 'src/app/services/forms.service';
import {formErrors} from '../../config/Messages';
import countries from '../../metadata/countries.json'
import { MatStepper } from '@angular/material/stepper';
import { map } from 'rxjs/operators';
import { UserService } from 'src/app/services/user.service';
import { MatDatepicker } from '@angular/material/datepicker';
import moment, { Moment } from 'moment';


@Component({
  selector: 'app-checkout-form',
  templateUrl: './checkout-form.component.html',
  styleUrls: ['./checkout-form.component.scss'],
})
export class CheckoutFormComponent implements OnInit, AfterViewInit {



  formErrors = formErrors;

  selectedCountries = countries;
  countryCode = new FormControl('');
  userForm = this.fb.group({
    firstName   : this.formsProvider.firstName(),
    lastName    : this.formsProvider.lastName(),
    birthday    : this.formsProvider.date(16),
    isoCode     : this.countryCode,
    phoneNumber : this.formsProvider.phoneNumber(this.countryCode)
  })

  addressForm = this.fb.group({
    id          : 0,
    street      : this.formsProvider.text(30),
    complement  : this.formsProvider.text(20),
    postCode    : this.formsProvider.postCode(),
    city        : this.formsProvider.city(),
  })

  paymentForm = this.fb.group({
    id         : 0,
    number     :  this.formsProvider.cardNumber(),
    name       : this.formsProvider.cardName(),
    expiry     :  new FormControl(moment()),
    code       : this.formsProvider.number(3), 
  })

  startDate = new Date(2010, 0, 1);

  @ViewChild('stepper') private stepper: MatStepper;

  user : any = {} ;
  address : any = {} ;
  payment : any = {} ;
  initStep : number = 0;


  loadingSepper : Promise<Boolean>;
  
  constructor(
    private fb : FormBuilder,
    private formsProvider : FormsService,
    private userService : UserService) 
    {
    }
  async ngAfterViewInit() {
  }

  async ngOnInit()
  {
    this.init().then(()=>{
       /* if (this.userForm.valid ){
          this.initStep = 1;
        }
        if (this.addressForm.valid )
          this.initStep = 2;
        if (this.paymentForm.valid )
          this.initStep = 3;*/
        //this.stepper.selectedIndex = this.initStep
    }).then(()=>this.loadingSepper =  Promise.resolve(true))
    
  
  }
  previous(){
    this.stepper.previous();
  }

  async init()
  {
    //check user
    await this.initUser();
    //check address
    await this.initAddress();
    //check payement
    await this.initPayment()
  }


  async initUser()
  {
    this.userService.getUser().subscribe(
      (userObj:any)=>{
        this.user = userObj;
          this.userForm.patchValue(userObj)  
      }
    );
  }
  async initAddress()
  {
    this.userService.getAddress().pipe
    (map((address:any[]) => { 
      return address?.filter(e => 
        { return e.default==='T'})[0]
    }))
    .subscribe(
      (address:any)=>{
          this.addressForm.patchValue(address)
          this.address = address;
      })
  }
  async initPayment()
  {
    this.userService.getPayment().pipe
    (map( (payment:any[]) => { 
      return payment?.filter(e => 
        { return e.default==='T'})[0]
    }))
    .subscribe(
      (payment:any)=>{
        //console.log(payment)
          this.paymentForm.patchValue(payment)
          //only for now
          this.paymentForm.patchValue({code: '555'})
          this.payment = payment;
          
        })
  }

  updateUser(){
    let formValue = this.userForm.value;
    //console.log(formValue)
    this.userService.postUser(formValue).subscribe(
      (response:any)=>{
        if (response.complete){
          this.userService.setUser(response.user)
          this.user = response.user;
        }
        //else show error
      }
    )
    
  }
  updateAddress(){
    let formValue = this.addressForm.value;
    this.userService.postAddress(formValue).subscribe(
      (response:any)=>{
        if (response.complete){
          this.address = response.address;
          this.userService.setAddress(response.address)
        }
        //else show error
      }
    )
    
  }
  updatePayement(){
    let formValue = this.paymentForm.value;
    //console.log(formValue)
    this.userService.postPayement(formValue).subscribe(
      (response:any)=>{
        //console.log(response)
        if (response.complete){
          this.payment = response.payment;
          this.userService.setPayement(response.payment)
        }
        //else show error
      }
    )
    
  }


  onKey(value:string) { 
    this.selectedCountries = this.search(value);
    }
    
  search(value: string) { 
    let filter = value.toLowerCase();
    return countries.filter(option => option.name.toLowerCase().startsWith(filter));
  }

  closeOnMonth(moment: Moment, datepicker: MatDatepicker<Moment>){
    const ctrlValue = this.paymentForm.get('expiry').value;
    ctrlValue.month(moment.month());
    ctrlValue.year(moment.year());
    this.paymentForm.get('expiry').setValue(ctrlValue);
    datepicker.close();
  }




}
