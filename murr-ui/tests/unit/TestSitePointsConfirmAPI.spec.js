const request = require('supertest')('http://127.0.0.1:8000/site/')
const expect = require('chai').expect

describe('POST to the database', () => {
  it('creates points for the site and returns status code 200', async function () {
    // Creates a mock pickupID to send to the server
    const pickup = {
      pickupID: 1
    }
    const response = await request
      .post('1')
      .send(pickup)
    expect(response.status).to.eql(201)
    expect(response.text).to.eql('100 Points successfully added to Wascana')
  })
  it('receive status code 500 while sending no pickupID', async function () {
    const newPickup = {}
    const response = await request
      .post('1')
      .send(newPickup)
    expect(response.status).to.eql(500)
  })
})
