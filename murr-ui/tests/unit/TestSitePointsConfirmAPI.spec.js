const request = require('supertest')('http://127.0.0.1:8000/site/')
const expect = require('chai').expect

/**
 * Purpose: Test the front end if it communicates with the back end properly.
 * */
describe('POST to the database', () => {
  /**
   * This test block will send the pickup ID to add points to site 1
   * This should return a response code of 201 and a success message
   * */
  it('creates points for the site and returns status code 201', async function () {
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
  /**
   * This test block will send the pickup ID to add points to site 1 but the pickup has no bins collected
   * This should return a response code of 200 and a message where it says no points were added to the test.
   * */
  it('add 0 points for the site and returns status code 200', async function () {
    // Creates a mock pickupID to send to the server
    const pickup = {
      pickupID: 2
    }
    const response = await request
      .post('2')
      .send(pickup)
    expect(response.status).to.eql(200)
    expect(response.text).to.eql('No points were added to Brighton')
  })
  /**
   * This test block will send an invalid pickup ID to add points to site 1
   * This should return a response code of 422 and an error message where it says Pickup ID not found
   * */
  it('add points for the site using pickupID of 99 and returns status code 422', async function () {
    // Creates a mock pickupID to send to the server
    const pickup = {
      pickupID: 99
    }
    const response = await request
      .post('2')
      .send(pickup)
    expect(response.status).to.eql(422)
    expect(response.header.error).to.eql('Pickup ID not found')
  })
  /**
   * This test block will send an empty pickup ID to add points to site 1
   * This should return a response code of 500
   * */
  it('receive status code 500 while sending no pickupID', async function () {
    const newPickup = {}
    const response = await request
      .post('1')
      .send(newPickup)
    expect(response.status).to.eql(500)
  })
})
