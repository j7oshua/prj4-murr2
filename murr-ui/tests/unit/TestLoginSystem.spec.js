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
  describe('Testing the input of invalid email or phone format', () => {
    it('Displays error that an invalid username or password was entered with invalid email', async () => {
      // Find the username and password input fields
      const inputUsername = wrapper.find('#username')
      const inputPassword = wrapper.find('#password')

      // Input the fields with data (username is in improper email format)
      await inputUsername.setValue('helloemailcom')
      await inputPassword.setValue('password')
      // Find and click the submit button
      await wrapper.find('button').trigger
      // Expect a error message of Invalid username/password to be displayed to user
      expect(wrapper.find('#errorMessage').text()).to.equal('Invalid credentials')
    })

    it('Displays error that an invalid username or password was entered with invalid phone less 10 chars', async () => {
      const inputUsername = wrapper.find('#username')
      const inputPassword = wrapper.find('#password')

      await inputUsername.setValue('333')
      await inputPassword.setValue('password')
      await wrapper.find('button').trigger

      expect(wrapper.find('#errorMessage').text()).to.equal('Invalid credentials')
    })

    it('Displays error that an invalid username or password was entered with invalid phone more 10 chars', async () => {
      const inputUsername = wrapper.find('#username')
      const inputPassword = wrapper.find('#password')

      await inputUsername.setValue('3'.repeat(11))
      await inputPassword.setValue('password')
      await wrapper.find('button').trigger

      expect(wrapper.find('#errorMessage').text()).to.equal('Invalid credentials')
    })

    it('Displays error that an invalid password left blank', async () => {
      const inputUsername = wrapper.find('#username')
      const inputPassword = wrapper.find('#password')

      await inputUsername.setValue('3'.repeat(10))
      await inputPassword.setValue('')
      await wrapper.find('button').trigger

      expect(wrapper.find('#errorMessage').text()).to.equal('Invalid credentials')
    })
  })
})
