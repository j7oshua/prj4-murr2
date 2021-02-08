import flushPromises from 'flush-promises'
import nock from 'nock'
import axios from 'axios'
import { expect } from 'chai'
import httpAdapter from 'axios/lib/adapters/http'

describe('ResidentLogin.vue', () => {
  it('Resident with correct email and correct password', async () => {
    const expectedUser = 1
    const email = 'test@email.com'
    const password = 'password'
    const request = nock('http://localhost:3000/login')
      // make the call to the mock database passing in the residentId
      .get(`/login?residentId=${expectedUser}&password=${password}`)
      .reply(200)
    await flushPromises()
    // should return a status code of 200
    expect(request).to.contains.all.keys({interceptors: [{statusCode: 200}]})
  })

  it('Resident with correct phone and correct password', async () => {
  })

  it('Resident with wrong email and correct password', async () => {
  })

  it('Resident with wrong phone and correct password', async () => {
  })

  it('Resident with correct email and wrong password', async () => {
  })

  it('Resident with correct phone and wrong password', async () => {
  })

  it('Resident with wrong email and wrong password', async () => {
  })

  it('Resident with wrong phone and wrong password', async () => {
  })
})
