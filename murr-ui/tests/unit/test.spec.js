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

describe('ResidentPoints.vue', () => {
  it('searches for the resident', async () => {
    const expectedUser = 1
    const points = 1000
    const request = nock('http://localhost:3000/residentPoints')
      .get(`/residentPoints?residentid=${expectedUser}&points=${points}`)
      .reply(200)
    await flushPromises()
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 200 }] })
  })

  it('searches for the resident, not existing', async () => {
    const expectedUser = 5
    const points = 0
    const request = nock('http://localhost:3000/residentPoints')
      .get(`/residentPoints?residentid=${expectedUser}&points=${points}`)
      .reply(400)

    await flushPromises()
    expect(request).to.contains.all.keys({ interceptors: [{ statusCode: 400 }] })
  })
})
