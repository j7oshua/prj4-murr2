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
    let residentid
    return instance
      .get(`/residentPoints?residentid=${residentid}`)
      .then(result => result.data)
  }
}

describe('ProgressPoints.vue', () => {
  it('searches for the resident', async () => {
    // const expectedUser = 1
    const request = nock('http://localhost:3000/residentPoints')
      .get('/http://localhost:3000/residentPoints')
      // .get(`/residentPoints?residentid=${expectedUser}`)
      .reply(200)
    // expect(request).equals(200)
    // expect(request).contains({ interceptors: [{ statusCode: 200 }] })
    expect(request).include({ interceptors: [{ statusCode: 200 }] })
    await flushPromises()

    // expect(request.isDone().valueOf(true))
  })
  it('searches for the resident, not existing', async () => {
    const expectedUser = 5
    const request = nock('http://localhost:3000/residentPoints')
      .get(`/residentPoints?residentid=${expectedUser}`)
      .reply(400)

    await flushPromises()

    expect(request.isDone().valueOf(true))
  })
})
