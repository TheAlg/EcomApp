import { AbstractControl, ValidationErrors, ValidatorFn } from '@angular/forms';
import moment from 'moment'

export function minDate(date?: number): ValidatorFn {

  return (control: AbstractControl): ValidationErrors | null => {

    const controlDate = moment(control.value);
    
    if (!controlDate.isValid){
      return {'notvalid': 'date is not valid'}
    }

    date = date ? date : 18;
    return controlDate.add(date, 'years') <= moment(Date.now())  ? null :
        {'minDate': 'User must be at least ' + date + ' years old'} 
      
  };

  }
  