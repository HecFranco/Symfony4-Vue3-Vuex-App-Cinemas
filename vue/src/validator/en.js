export default {
  custom: {
    email: {
      required: 'E-mail is required',
      email: 'E-mail is not valid'
    },
    username: {
      required: 'Username is required',
    },
    password: {
      required: 'Password is required',
      min: 'Password is too short',
    },
    password_confirmation: {
      required: 'Password is required',
      min: 'Password is too short',
      confirmed: 'Password does not match'
    },
  }
}
