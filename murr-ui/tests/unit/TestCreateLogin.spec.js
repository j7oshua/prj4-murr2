import { shallowMount } from '@vue/test-utils'
import CreateLogin from '@/components/CreateLogin'
import { expect } from 'chai'

let wrapper

describe('CreateLogin.vue', () => {
  beforeEach(() => {
    wrapper = shallowMount(CreateLogin)
  })

  it('Should successfully be valid with all fields entered', async () => {
    const inputEmail = wrapper.find('#email')
    await inputEmail.setValue('hello@email.com')
    expect(wrapper.find('#email').element.value).to.equal('hello@email.com')
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

  it('Should successfully be valid when resident enters valid email and password', async () => {
    const inputEmail = wrapper.find('#email')
    await inputEmail.setValue('hello@email.com')
    expect(wrapper.find('#email').element.value).to.equal('hello@email.com')
    expect(wrapper.find('#properEmail').text()).to.equal('Your email is valid!')
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

  it('Should successfully be valid when resident enters valid phone number and password', async () => {
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

  it('Should display error Email or Phone is required', async () => {
    expect(wrapper.find('#improperEmail').text()).to.equal('Email or Phone is required')
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

  it('Should display error when invalid email format is entered', async () => {
    const inputEmail = wrapper.find('#email')
    await inputEmail.setValue('hello')
    expect(wrapper.find('#email').element.value).to.equal('hello')
    expect(wrapper.find('#improperEmail').text()).to.equal('Email is not in proper format')
  })

  it('Should display error when invalid phone containing more than 10 digits is entered', async () => {
    const inputPhone = wrapper.find('#phone')
    await inputPhone.setValue('3'.repeat(11))
    expect(wrapper.find('#phone').element.value).to.equal('3'.repeat(11))
    expect(wrapper.find('#improperPhone').text()).to.equal('Phone Number must be 10 digits!')
  })

  it('Should display error when invalid phone containing less than 10 digits is entered', async () => {
    const inputPhone = wrapper.find('#phone')
    await inputPhone.setValue('3'.repeat(9))
    expect(wrapper.find('#phone').element.value).to.equal('3'.repeat(9))
    expect(wrapper.find('#improperPhone').text()).to.equal('Phone Number must be 10 digits!')
  })

  it('Should display error when characters is entered into the phone number and 10 chars', async () => {
    const inputPhone = wrapper.find('#phone')
    await inputPhone.setValue('h'.repeat(10))
    expect(wrapper.find('#phone').element.value).to.equal('h'.repeat(10))
    expect(wrapper.find('#improperPhone').text()).to.equal('Phone Number must contain only digits!')
  })

  it('Should display error when password is inputted with under 7 characters', async () => {
    const inputPassword = wrapper.find('#password')
    await inputPassword.setValue('pass')
    expect(wrapper.find('#password').element.value).to.equal('pass')
    expect(wrapper.find('#improperPassword').text()).to.equal('Password must be at least 7 characters!')
  })

  it('Should display error when password is inputted with over 30 characters', async () => {
    const inputPassword = wrapper.find('#password')
    await inputPassword.setValue('p'.repeat(31))
    expect(wrapper.find('#password').element.value).to.equal('p'.repeat(31))
    expect(wrapper.find('#improperPassword').text()).to.equal('Password can\'t be over 30 characters!')
  })

  it('Should display error when password is left blank', async () => {
    const inputPassword = wrapper.find('#password')
    await inputPassword.setValue('')
    expect(wrapper.find('#password').element.value).to.equal('')
    expect(wrapper.find('#improperPassword').text()).to.equal('Password is required')
  })

  it('Should display error if the repeated password does not match password', async () => {
    const inputPassword = wrapper.find('#password')
    await inputPassword.setValue('password')
    expect(wrapper.find('#password').element.value).to.equal('password')
    expect(wrapper.find('#properPassword').text()).to.equal('Your password is valid!')
    const inputRepeatPassword = wrapper.find('#repeatPassword')
    await inputRepeatPassword.setValue('pass')
    expect(wrapper.find('#repeatPassword').element.value).to.equal('pass')
    expect(wrapper.find('#improperRepeatedPassword').text()).to.equal('Passwords must be identical!')
  })

  it('Should display errors when no information is entered', async () => {
    const inputEmail = wrapper.find('#email')
    await inputEmail.setValue('')
    expect(wrapper.find('#email').element.value).to.equal('')
    expect(wrapper.find('#improperEmail').text()).to.equal('Email or Phone is required')
    const inputPhone = wrapper.find('#phone')
    await inputPhone.setValue('')
    expect(wrapper.find('#phone').element.value).to.equal('')
    expect(wrapper.find('#improperPhone').text()).to.equal('Email or Phone is required')
    const inputPassword = wrapper.find('#password')
    await inputPassword.setValue('')
    expect(wrapper.find('#password').element.value).to.equal('')
    expect(wrapper.find('#improperPassword').text()).to.equal('Password is required')
    const inputRepeatPassword = wrapper.find('#repeatPassword')
    await inputRepeatPassword.setValue('')
    expect(wrapper.find('#repeatPassword').element.value).to.equal('')
    expect(wrapper.find('#improperRepeatedPassword').text()).to.equal('Please re-enter your password')
  })
})
