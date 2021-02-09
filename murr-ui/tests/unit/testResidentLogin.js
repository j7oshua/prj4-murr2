import nock from 'nock'
import axios from 'axios'
import { expect } from 'chai'
import httpAdapter from 'axios/lib/adapters/http'

// eslint-disable-next-line no-unused-vars
const instance = axios.create({
  baseURL: 'http://localhost:3000/login',
  adapter: httpAdapter
})
// this.axios.get('http://localhost:3000/residentPoints', {
// params: { residentid: this.residentid }})
describe('ResidentLogin.vue', () => {
  it('Resident with correct email and correct password', async () => {
    const loginInfo = 'test@email.com'
    const password = 'password'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
      .reply(200)
    const wrapper = mount(password)
    // expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 200 }] })

    // homepage
    expect(wrapper.attributes('password')).toBe('password')

  })

  it('Resident with correct phone and correct password', async () => {
    const loginInfo = '123456789'
    const password = 'password'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
      .reply(200)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 200 }] })
    // homepage
  })

  it('Resident with wrong email and correct password', async () => {
    const loginInfo = 'testemail.com'
    const password = 'password'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
      .reply(404)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
    const msg = 'Login failed. Please try again.'
    expect(msg)
  })

  it('Resident with wrong phone and correct password', async () => {
    const loginInfo = '12345678'
    const password = 'password'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
      .reply(404)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
    const msg = 'Login failed. please try again.'
    expect(msg)
  })

  it('Resident with correct email and wrong password', async () => {
    const loginInfo = 'test@email.com'
    const password = 'pssword'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
      .reply(404)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
    const msg = 'Login failed. Please try again'
    expect(msg)
  })

  it('Resident with correct phone and wrong password', async () => {
    const loginInfo = '123456789'
    const password = 'pssword'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
      .reply(404)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
    const msg = 'Login failed. Please try again'
    expect(msg)
  })

  it('Resident with wrong email and wrong password', async () => {
    const loginInfo = 'testemail.com'
    const password = 'pssword'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
      .reply(404)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
    const msg = 'Login failed. Please try again.'
    expect(msg)
  })
  it('Resident with wrong phone and wrong password', async () => {
    const loginInfo = '12345678'
    const password = 'pssword'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
      .reply(404)
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
    const msg = 'Login failed. Please try again.'
    expect(msg)
  })
})
