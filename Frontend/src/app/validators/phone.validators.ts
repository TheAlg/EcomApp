import { ValidatorFn, AbstractControl, FormControl } from '@angular/forms';
import { PhoneNumberUtil, PhoneNumber } from 'google-libphonenumber';

const phoneNumberUtil = PhoneNumberUtil.getInstance();



export function phoneValidator(countryControl: FormControl): ValidatorFn {
  let subscribe: boolean = false;


  return (phoneControl: AbstractControl): { [key: string]: any } => {

    if (!subscribe) {
      subscribe = true;
      countryControl.valueChanges.subscribe(() => {
        phoneControl.updateValueAndValidity();
      });
    }
    let validNumber = false;
    try {
      const phoneNumber = phoneNumberUtil.parseAndKeepRawInput(
        phoneControl.value, countryControl.value
      );
      validNumber = phoneNumberUtil.isValidNumber(phoneNumber);
    } catch (e) { }

    return validNumber ? null : { 'wrongNumber': { value: phoneControl.value } };
  }
}