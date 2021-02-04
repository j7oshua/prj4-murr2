import flushPromises from 'flush-promises'
import nock from 'nock'
import axios from 'axios'
import { expect } from 'chai'
import httpAdapter from 'axios/lib/adapters/http'

const instance = axios.create({
  baseURL: 'http://localhost:3000/residentPoints',
  adapter: httpAdapter
})

export default {
  getPoints () {
    let residentId
    return instance
      .get(`/residentPoints?residentId=${residentId}`)
      .then(result => result.data)
  }
}

describe('ResidentPoints.vue', () => {
  it('searches for the resident', async () => {
    const expectedUser = 1
    const points = 1000
    const request = nock('http://localhost:3000/residentPoints')
      // make the call to the mock database passing in the residentId
      .get(`/residentPoints?residentId=${expectedUser}&points=${points}`)
      .reply(200)
    await flushPromises()
    // should return a status code of 200
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 200 }] })
  })

  it('searches for the resident, not existing', async () => {
    const expectedUser = 5
    const points = 0
    const request = nock('http://localhost:3000/residentPoints')
      // make the call to the mock database passing in the residentId
      .get(`/residentPoints?residentId=${expectedUser}&points=${points}`)
      .reply(400)

    await flushPromises()
    // should return a status code of 400
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 404 }] })
  })
})
