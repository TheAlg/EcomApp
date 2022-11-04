import { Injectable } from '@angular/core';
import { FormBuilder, FormControl, Validators } from '@angular/forms';
import { phoneValidator } from '../validators/phone.validators';
import { minDate } from '../validators/date.validator';



@Injectable({
  providedIn: 'root'
})
export class FormsService {

  constructor(private fb : FormBuilder) {
  }

    email() : FormControl
    {
      return new FormControl('', {
        validators:[
          Validators.required,
          Validators.email
        ]
      });
    }
    password() : FormControl
    {
      return new FormControl('', {
        validators:[
          Validators.required,
        ]
      });
    }
    firstName() : FormControl
    {
      return new FormControl('', {
        validators:[
          Validators.required,
          Validators.minLength(2),
          Validators.maxLength(20)
        ]
      });
    }

    lastName() : FormControl
    {
      return new FormControl('', {
        validators:[
          Validators.required,
          Validators.minLength(2),
          Validators.maxLength(20)
        ],
      });
    }

    phoneNumber(countrycode : FormControl){
      return new FormControl('', {
        validators:[
          Validators.required,
          phoneValidator(countrycode)
        ],
      });

    }

    terms() : FormControl
    {      
      return new FormControl('', {
      validators:[
        Validators.requiredTrue,
      ],
    });

    }

    text(arg: number) :FormControl
    {
      return new FormControl('', {
        validators:[
          Validators.maxLength(arg),
        ]
      });
    }

    number(arg: number) {
      return new FormControl('', {
        validators:[
          Validators.pattern('^[0-9]*$'), //numbers only
          Validators.minLength(arg),
        ]
      });
    }
    date(date?: number) {
      return new FormControl('', {
        validators:[
          minDate(date)
        ]
      })
    }
    cardName() {
      return new FormControl('', {
        validators:[
          Validators.minLength(2),
        ]
      });
    }
    cardNumber() {
      return new FormControl('', {
        validators:[
          Validators.pattern('^[0-9]*$'),
          Validators.minLength(13),
          Validators.maxLength(19),
        ]
      });
    }
    city() {
      return new FormControl('', {
        validators:[
          Validators.maxLength(20),
        ]
      });
    }
    postCode() {
      return new FormControl('', {
        validators:[
          Validators.pattern('^[0-9]*$'),
          Validators.minLength(2),
          Validators.maxLength(7),
        ]
      });
    }



}

function PhoneValidator(arg0: string): import("@angular/forms").ValidatorFn {
  throw new Error('Function not implemented.');
}
