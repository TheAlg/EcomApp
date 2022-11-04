export const sm = {
    'aboutMe': [
      { type: 'maxlength', message: 'Bio cannot be more than 256 characters long' },
    ],
    'gender': [
      { type: 'required', message: 'Please select your gender' },
    ],
    'birthday': [
      { type: 'required', message: 'Please insert your birthday' },
    ],
    'phone': [
      { type: 'required', message: 'Phone is required' },
      { type: 'validCountryPhone', message: 'Phone incorrect for the country selected' }
    ]
  };

export const formErrors = {
    'username': [
      { type: 'required', message: 'Username is required' },
      { type: 'minlength', message: 'Username must be at least 5 characters long' },
      { type: 'maxlength', message: 'Username cannot be more than 25 characters long' },
      { type: 'pattern', message: 'Your username must contain only numbers and letters' },
      { type: 'validUsername', message: 'Your username has already been taken' }
    ],
    'firstName': [
      { type: 'required', message: 'First Name is required' },
      { type: 'minlength', message: 'First name cannot be less then 3 characters long' },

    ],
    'lastName': [
      { type: 'required', message: 'Last Name is required' },
      { type: 'minlength', message: 'Last name cannot be less then 3 characters long' },
    ],
    'email': [
      { type: 'required', message: 'Email is required' },
      { type: 'email', message: 'Enter a valid email' }
    ],
    'confirm_password': [
      { type: 'required', message: 'Confirm password is required' },
      { type: 'areEqual', message: 'Password mismatch' }
    ],
    'birthday' :[
      {type : 'required', message: 'birthday is required'},
      {type : 'minDate', message: 'You must be at least 16 years old'}
    ],
    'password': [
      { type: 'required', message: 'Password is required' },
      { type: 'minlength', message: 'Password must be at least 5 characters long' },
      { type: 'pattern', message: 'Your password must contain at least one uppercase, one lowercase, and one number' }
    ],
    'terms': [
      { type: 'pattern', message: 'Terms must be accepted' }
    ]
  }

  export const checkoutErrors = {
    'email': [
      { type: 'required', message: 'Email is required' },
      { type: 'email', message: 'Enter a valid email' }
    ],
    'password': [
      { type: 'required', message: 'Password is required' },
    ],
  }