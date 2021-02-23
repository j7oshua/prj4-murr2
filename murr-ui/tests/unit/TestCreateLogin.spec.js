// import statement need for tests
import { shallowMount } from '@vue/test-utils'
import CreateLogin from '@/components/CreateLogin'
import { expect } from 'chai'

// global variable for wrapper container
let wrapper

// create the shallow mount
describe('CreateLogin.vue', () => {
  // before each test
  beforeEach(() => {
    // create a new wrapper container for the shallow mount
    wrapper = shallowMount(CreateLogin)
  })

  /**
   * Title: Resident enters valid email, valid phone number, and valid password
   * Purpose: This test will test that ALL fields are correctly inputted and returned valid
   * Expected Result: Success
   * Return: a newly created login
   **/
  it('Should successfully be valid with all fields entered', async () => {
    // find the input field with #email
    const inputEmail = wrapper.find('#email')
    // set the value in the input field to equal hello@email.com
    await inputEmail.setValue('hello@email.com')
    // if the input in the field equals the set value --> expected result
    expect(wrapper.find('#email').element.value).to.equal('hello@email.com')
    // expected response back
    expect(wrapper.find('#properEmail').text()).to.equal('Your email is valid!')
    // find the input field with #phone
    const inputPhone = wrapper.find('#phone')
    // set the value in the input field to equal 3333333333
    await inputPhone.setValue('3'.repeat(10))
    // if the input in the field equals the set value --> expected result
    expect(wrapper.find('#phone').element.value).to.equal('3'.repeat(10))
    // expected response back
    expect(wrapper.find('#properPhoneNumber').text()).to.equal('Your phone number is valid!')
    // find the input field with #password
    const inputPassword = wrapper.find('#password')
    // set the value in the input field to equal password
    await inputPassword.setValue('password')
    // if the input in the field equals the set value --> expected result
    expect(wrapper.find('#password').element.value).to.equal('password')
    // expected response back
    expect(wrapper.find('#properPassword').text()).to.equal('Your password is valid!')
    // find the input field with #repeatPassword
    const inputRepeatPassword = wrapper.find('#repeatPassword')
    // set the value in the input field to equal password
    await inputRepeatPassword.setValue('password')
    // if the input in the field equals the set value --> expected result
    expect(wrapper.find('#repeatPassword').element.value).to.equal('password')
    // expected response back
    expect(wrapper.find('#properRepeatedPassword').text()).to.equal('Your passwords are identical!')
  })

  /**
   * Title: Resident enters valid email and valid password
   * Purpose: To Test that only the password and email are entered and the phone number is left blank and will return
   * valid
   * Expected Result: Success
   * Return: newly created login
   **/
  it('Should successfully be valid when resident enters valid email and password', async () => {
    const inputEmail = wrapper.find('#email')
    await inputEmail.setValue('hello@email.com')
    expect(wrapper.find('#email').element.value).to.equal('hello@email.com')
    expect(wrapper.find('#properEmail').text()).to.equal('Your email is valid!')
    // demonstrates that the phone number is left blank but still returns valid
    expect(wrapper.find('#properPhoneNumber').text()).to.equal('Your phone number is valid!')
    const inputPassword = wrapper.find('#password')
    await inputPassword.setValue('password')
    expect(wrapper.find('#password').element.value).to.equal('password')
    expect(wrapper.find('#properPassword').text()).to.equal('Your password is valid!')
    const inputRepeatPassword = wrapper.find('#repeatPassword')
    await inputRepeatPassword.setValue('password')
    expect(wrapper.find('#repeatPassword').element.value).to.equal('password')
    expect(wrapper.find('#properRepeatedPassword').text()).to.equal('Your passwords are identical!')
  })

  /**
   * Title: Resident enters valid phone number and password
   * Purpose: To Test that only the password and phone number are entered and the email is left blank and will return
   * valid
   * Expected Result: Success
   * Return: newly created login
   **/
  it('Should successfully be valid when resident enters valid phone number and password', async () => {
    // demonstrates that the email is left blank but still returns valid
    expect(wrapper.find('#properEmail').text()).to.equal('Your email is valid!')
    const inputPhone = wrapper.find('#phone')
    await inputPhone.setValue('3'.repeat(10))
    expect(wrapper.find('#phone').element.value).to.equal('3'.repeat(10))
    expect(wrapper.find('#properPhoneNumber').text()).to.equal('Your phone number is valid!')
    const inputPassword = wrapper.find('#password')
    await inputPassword.setValue('password')
    expect(wrapper.find('#password').element.value).to.equal('password')
    expect(wrapper.find('#properPassword').text()).to.equal('Your password is valid!')
    const inputRepeatPassword = wrapper.find('#repeatPassword')
    await inputRepeatPassword.setValue('password')
    expect(wrapper.find('#repeatPassword').element.value).to.equal('password')
    expect(wrapper.find('#properRepeatedPassword').text()).to.equal('Your passwords are identical!')
  })

  /**
   * Title: Resident enters just a password
   * Purpose: Demonstrates that the error that will occur when both the email and the phone are left blank.
   * Expected Result: Failure
   * Return: Error Message description: "Email or Phone is required".
   **/
  it('Should display error Email or Phone is required', async () => {
    // demonstrates that the email is left blank --> expected result
    expect(wrapper.find('#improperEmail').text()).to.equal('Email or Phone is required')
    // demonstrates that the phone is left blank --> expected result
    expect(wrapper.find('#improperPhone').text()).to.equal('Email or Phone is required')
    const inputPassword = wrapper.find('#password')
    await inputPassword.setValue('password')
    expect(wrapper.find('#password').element.value).to.equal('password')
    expect(wrapper.find('#properPassword').text()).to.equal('Your password is valid!')
    const inputRepeatPassword = wrapper.find('#repeatPassword')
    await inputRepeatPassword.setValue('password')
    expect(wrapper.find('#repeatPassword').element.value).to.equal('password')
    expect(wrapper.find('#properRepeatedPassword').text()).to.equal('Your passwords are identical!')
  })

  /**
   * Title: Resident enters invalid email format and valid password
   * Purpose: Demonstrates that an error will occur when the format of an email is not valid
   * Expected Result: Failure
   * Return: Error Message description: "Email is not in proper format".
   **/
  it('Should display error when invalid email format is entered', async () => {
    const inputEmail = wrapper.find('#email')
    // email is set to the value of just hello
    await inputEmail.setValue('hello')
    expect(wrapper.find('#email').element.value).to.equal('hello')
    // expected response back
    expect(wrapper.find('#improperEmail').text()).to.equal('Email is not in proper format')
  })

  /**
   * Title: Resident enters a phone number containing more than ten digits.
   * Purpose: Demonstrates that an error will occur when the phone number contains more than ten digits.
   * Expected Result: Failure
   * Return: Error Message description: "Phone Number must be 10 digits!".
   **/
  it('Should display error when invalid phone containing more than 10 digits is entered', async () => {
    const inputPhone = wrapper.find('#phone')
    // set the value to equal 33333333333
    await inputPhone.setValue('3'.repeat(11))
    expect(wrapper.find('#phone').element.value).to.equal('3'.repeat(11))
    // expected response back
    expect(wrapper.find('#improperPhone').text()).to.equal('Phone Number must be 10 digits!')
  })

  /**
   * Title: Resident enters a phone number containing less than ten digits.
   * Purpose: Demonstrates that an error will occur when the phone contains less than ten digits
   * Expected Result: Failure
   * Return: Error Message description: "Phone Number must be 10 digits!"
   **/
  it('Should display error when invalid phone containing less than 10 digits is entered', async () => {
    const inputPhone = wrapper.find('#phone')
    // set the value to equal 333333333
    await inputPhone.setValue('3'.repeat(9))
    expect(wrapper.find('#phone').element.value).to.equal('3'.repeat(9))
    // expected response back
    expect(wrapper.find('#improperPhone').text()).to.equal('Phone Number must be 10 digits!')
  })

  /**
   * Title: Resident enters an invalid phone number with characters
   * Purpose: Demonstrates that an error will occur when an invalid phone number is entered with characters
   * Expected Result: Failure
   * Return: Error Message description: "Phone Number must contain only digits!"
   **/
  it('Should display error when characters is entered into the phone number and 10 chars', async () => {
    const inputPhone = wrapper.find('#phone')
    // set the value to equal h
    await inputPhone.setValue('h'.repeat(10))
    expect(wrapper.find('#phone').element.value).to.equal('h'.repeat(10))
    // expected response back
    expect(wrapper.find('#improperPhone').text()).to.equal('Phone Number must contain only digits!')
  })

  /**
   * Title: Resident enters an incorrect password, shorter than 7 characters.
   * Purpose: Demonstrates that an error will occur when a password shorter than 7 characters.
   * Expected Result: Failure
   * Return: Error Message description: "Password must be at least 7 characters!"
   **/
  it('Should display error when password is inputted with under 7 characters', async () => {
    const inputPassword = wrapper.find('#password')
    // set the value to equal pass
    await inputPassword.setValue('pass')
    expect(wrapper.find('#password').element.value).to.equal('pass')
    // expected response back
    expect(wrapper.find('#improperPassword').text()).to.equal('Password must be at least 7 characters!')
  })

  /**
   * Title: Resident enters an incorrect password, longer than 7 characters.
   * Purpose: Demonstrates that an error will occur when
   * Expected Result: Failure
   * Return: Error Message description:
   **/
  it('Should display error when password is inputted with over 30 characters', async () => {
    const inputPassword = wrapper.find('#password')
    // set the value to equal pppppppppppppppppppppppppppppppp
    await inputPassword.setValue('p'.repeat(31))
    expect(wrapper.find('#password').element.value).to.equal('p'.repeat(31))
    // expected response back
    expect(wrapper.find('#improperPassword').text()).to.equal('Password can\'t be over 30 characters!')
  })

  /**
   * Title: Resident enters an incorrect password, password is left blank.
   * Purpose: Demonstrates that an error will occur when
   * Expected Result: Failure
   * Return: Error Message description: "Password is required".
   **/
  it('Should display error when password is left blank', async () => {
    const inputPassword = wrapper.find('#password')
    // set the value to equal blank
    await inputPassword.setValue('')
    expect(wrapper.find('#password').element.value).to.equal('')
    // expected response back
    expect(wrapper.find('#improperPassword').text()).to.equal('Password is required')
  })

  /**
   * Title: Resident enters an incorrect passwords, passwords do not match.
   * Purpose: Demonstrates that an error will occur when
   * Expected Result: Failure
   * Return: Error Message description: "Your password is valid!"
   *         Error Message description: "Passwords must be identical!"
   **/
  it('Should display error if the repeated password does not match password', async () => {
    const inputPassword = wrapper.find('#password')
    // set the value to equal password
    await inputPassword.setValue('password')
    expect(wrapper.find('#password').element.value).to.equal('password')
    // expected response back
    expect(wrapper.find('#properPassword').text()).to.equal('Your password is valid!')
    const inputRepeatPassword = wrapper.find('#repeatPassword')
    // set the value to equal pass
    await inputRepeatPassword.setValue('pass')
    expect(wrapper.find('#repeatPassword').element.value).to.equal('pass')
    // expected response back
    expect(wrapper.find('#improperRepeatedPassword').text()).to.equal('Passwords must be identical!')
  })

  /**
   * Title: Resident enters no information
   * Purpose: Demonstrates that an error will occur when
   * Expected Result: Failure
   * Return: Error Message description: "Email or Phone is required".
   *         Error Message description: "Email or Phone is required".
   *         Error Message description: "Password is required".
   *         Error Message description: "Please re-enter your password".
   **/
  it('Should display errors when no information is entered', async () => {
    const inputEmail = wrapper.find('#email')
    // set the value to equal blank
    await inputEmail.setValue('')
    expect(wrapper.find('#email').element.value).to.equal('')
    expect(wrapper.find('#improperEmail').text()).to.equal('Email or Phone is required')
    const inputPhone = wrapper.find('#phone')
    // set the value to equal blank
    await inputPhone.setValue('')
    expect(wrapper.find('#phone').element.value).to.equal('')
    expect(wrapper.find('#improperPhone').text()).to.equal('Email or Phone is required')
    const inputPassword = wrapper.find('#password')
    // set the value to equal blank
    await inputPassword.setValue('')
    expect(wrapper.find('#password').element.value).to.equal('')
    expect(wrapper.find('#improperPassword').text()).to.equal('Password is required')
    const inputRepeatPassword = wrapper.find('#repeatPassword')
    // set the value to equal blank
    await inputRepeatPassword.setValue('')
    expect(wrapper.find('#repeatPassword').element.value).to.equal('')
    // expected response back
    expect(wrapper.find('#improperRepeatedPassword').text()).to.equal('Please re-enter your password')
  })
})
