// import statement needed for tests
import { shallowMount } from '@vue/test-utils'
import Login from '@/components/Login'
import { expect } from 'chai'

// global variable for wrapper container
let wrapper

describe('Login.vue Component', () => {
  beforeEach(() => {
    wrapper = shallowMount(Login)
  })
  // Group of tests that will be testing the proper input of a phone number or email address
  it('Displays error that an invalid username or password was entered with invalid email', async () => {
    // Find the username and password input fields
    const inputUsername = wrapper.find('#username')
    const inputPassword = wrapper.find('#password')
    // Input the fields with data (username is in improper email format)
    await inputUsername.setValue('t@.ca')
    await inputPassword.setValue('password')
    // Find and click the submit button
    await wrapper.find('button').trigger
    // Expect a error message of Invalid username/password to be displayed to user
    expect(wrapper.find('#errorMessageUser').text()).to.equal('Email or Phone be at least 6 characters!')
  })
  it('Displays error that an invalid username or password was entered with invalid phone less 6 chars', async () => {
    const inputUsername = wrapper.find('#username')
    const inputPassword = wrapper.find('#password')
    await inputUsername.setValue('12345')
    await inputPassword.setValue('password')
    await wrapper.find('button').trigger
    expect(wrapper.find('#errorMessageUser').text()).to.equal('Email or Phone be at least 6 characters!')
  })
  it('Displays error that an invalid username or password was entered with invalid username over 150 characters', async () => {
    const inputUsername = wrapper.find('#username')
    const inputPassword = wrapper.find('#password')
    await inputUsername.setValue('1'.repeat(151))
    await inputPassword.setValue('password')
    await wrapper.find('button').trigger
    expect(wrapper.find('#errorMessageUser').text()).to.equal('Email or Phone can\'t be over 150 characters!')
  })
  it('Displays error that an invalid username or password was entered with no username', async () => {
    const inputUsername = wrapper.find('#username')
    const inputPassword = wrapper.find('#password')
    await inputUsername.setValue('')
    await inputPassword.setValue('password')
    await wrapper.find('button').trigger
    expect(wrapper.find('#errorMessageUser').text()).to.equal('Email or Phone is required')
  })
  it('Displays error that an invalid password left blank', async () => {
    const inputUsername = wrapper.find('#username')
    const inputPassword = wrapper.find('#password')
    await inputUsername.setValue('3'.repeat(10))
    await inputPassword.setValue('')
    await wrapper.find('button').trigger
    expect(wrapper.find('#errorMessagePass').text()).to.equal('Password is required')
  })
  it('Displays error that an invalid password cannot be less than 7 characters', async () => {
    const inputUsername = wrapper.find('#username')
    const inputPassword = wrapper.find('#password')
    await inputUsername.setValue('email@email.com')
    await inputPassword.setValue('p'.repeat(6))
    await wrapper.find('button').trigger
    expect(wrapper.find('#errorMessagePass').text()).to.equal('Password must be at least 7 characters!')
  })
  it('Displays error that an invalid password cannot be over 30 characters', async () => {
    const inputUsername = wrapper.find('#username')
    const inputPassword = wrapper.find('#password')
    await inputUsername.setValue('email@email.com')
    await inputPassword.setValue('p'.repeat(31))
    await wrapper.find('button').trigger
    expect(wrapper.find('#errorMessagePass').text()).to.equal('Password can\'t be over 30 characters!')
  })
})
