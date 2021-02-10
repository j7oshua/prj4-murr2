import nock from 'nock'
import { expect } from 'chai'
import ResidentLogin from '../../src/components/ResidentLogin'
import { mount } from '@vue/test-utils'


describe('ResidentLogin.vue', () => {
  // Correct login information will move to the next page
  it('Resident with correct login credentials', async () => {
    const loginInfo = 'test@email.com'
    const password = 'password'
    const route = 'point/resident'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
      .reply(200)
    const wrapper = mount(ResidentLogin)
    expect(request.statusCode()).equals(404)
    expect(wrapper).route.equals(route) //Redirected to resident home page
  })

  // Incorrect login information will have a error message
  it('Resident with wrong login credentials', async () => {
    const loginInfo = 'testemail.com'
    const password = 'pssword'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
      .reply(404)
    const wrapper = mount(ResidentLogin)
    const msg = 'Login failed. Please try again.'
    expect(request.statusCode()).equals(404)
    expect(wrapper.text()).to.include(msg) //Error message appears
  })
})
