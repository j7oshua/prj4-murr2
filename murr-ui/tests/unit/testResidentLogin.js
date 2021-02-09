import nock from 'nock'
import { expect } from 'chai'
import ResidentLogin from '../../src/components/ResidentLogin'
import { mount } from '@vue/test-utils'

describe('ResidentLogin.vue', () => {
  //Correct login information returns status code 200
  it('Resident with correct email and correct password', async () => {
    const loginInfo = 'test@email.com'
    const password = 'password'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
    const wrapper = mount(ResidentLogin)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 200 }] })
    expect(wrapper.attributes('loginInfo').to.be(loginInfo))
    expect(wrapper.attributes('password').to.be(password))
  })

  //Correct login information returns status code 200
  it('Resident with correct phone and correct password', async () => {
    const loginInfo = '123456789'
    const password = 'password'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
    const wrapper = mount(ResidentLogin)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 200 }] })
    expect(wrapper.attributes('loginInfo').to.be(loginInfo))
    expect(wrapper.attributes('password').to.be(password))
  })

  //Incorrect login information returns status code 404
  it('Resident with wrong email and correct password', async () => {
    const loginInfo = 'testemail.com'
    const password = 'password'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
    const wrapper = mount(ResidentLogin)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
    expect(wrapper.attributes('loginInfo').to.be(loginInfo))
    expect(wrapper.attributes('password').to.be(password))
    const msg = 'Login failed. Please try again.'
    expect(wrapper.text()).to.include(msg)
  })

  //Incorrect login information returns status code 404
  it('Resident with wrong phone and correct password', async () => {
    const loginInfo = '12345678'
    const password = 'password'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
    const wrapper = mount(ResidentLogin)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
    expect(wrapper.attributes('loginInfo').to.be(loginInfo))
    expect(wrapper.attributes('password').to.be(password))
    const msg = 'Login failed. Please try again.'
    expect(wrapper.text()).to.include(msg)
  })

  //Incorrect login information returns status code 404
  it('Resident with correct email and wrong password', async () => {
    const loginInfo = 'test@email.com'
    const password = 'pssword'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
    const wrapper = mount(ResidentLogin)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
    expect(wrapper.attributes('loginInfo').to.be(loginInfo))
    expect(wrapper.attributes('password').to.be(password))
    const msg = 'Login failed. Please try again.'
    expect(wrapper.text()).to.include(msg)
  })

  //Incorrect login information returns status code 404
  it('Resident with correct phone and wrong password', async () => {
    const loginInfo = '123456789'
    const password = 'pssword'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
    const wrapper = mount(ResidentLogin)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
    expect(wrapper.attributes('loginInfo').to.be(loginInfo))
    expect(wrapper.attributes('password').to.be(password))
    const msg = 'Login failed. Please try again.'
    expect(wrapper.text()).to.include(msg)
  })

  //Incorrect login information returns status code 404
  it('Resident with wrong email and wrong password', async () => {
    const loginInfo = 'testemail.com'
    const password = 'pssword'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
    const wrapper = mount(ResidentLogin)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
    expect(wrapper.attributes('loginInfo').to.be(loginInfo))
    expect(wrapper.attributes('password').to.be(password))
    const msg = 'Login failed. Please try again.'
    expect(wrapper.text()).to.include(msg)
  })

  //Incorrect login information returns status code 404
  it('Resident with wrong phone and wrong password', async () => {
    const loginInfo = '12345678'
    const password = 'pssword'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
    const wrapper = mount(ResidentLogin)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
    expect(wrapper.attributes('loginInfo').to.be(loginInfo))
    expect(wrapper.attributes('password').to.be(password))
    const msg = 'Login failed. Please try again.'
    expect(wrapper.text()).to.include(msg)
  })
})
