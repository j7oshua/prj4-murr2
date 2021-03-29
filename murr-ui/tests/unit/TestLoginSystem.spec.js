const request = require('supertest')('http://127.0.0.1:8000/api')
const expect = require('chai').expect

// npm install --save supertest mocha chai

describe('GET /login', function () {
  /**
   * Title: Resident successfully logs in with email
   * Purpose: This test will test that a resident can login with their email
   * Expected Result: Success
   * Return: Status Code: 200
   **/
  it('Resident successfully logs in with their valid email and password.', async function () {
    const response = await request.get('/resident/1')
    expect(response.status).to.eql(200)

    expect(response.body['hydra:member'][0]).to.contain({ phone: '' })
    expect(response.body['hydra:member'][0]).to.contain({ email: 'email8@email.com' })
    expect(response.body['hydra:member'][0]).to.contain({ apiToken: '123456' })
  })

  /**
   * Title: Resident successfully logs in with phone number
   * Purpose: This test will test that a resident can login with their phone number
   * Expected Result: Success
   * Return: Status Code: 200
   **/
  it('Resident successfully logs in with valid phone and password.', async function () {
    const response = await request.get('/resident/1')
    expect(response.status).to.eql(200)

    expect(response.body['hydra:member'][0]).to.contain({ phone: '3065558888' })
    expect(response.body['hydra:member'][0]).to.contain({ email: '' })
    expect(response.body['hydra:member'][0]).to.contain({ apiToken: '123456' })
  })

  /**
   * Title: Resident unsuccessfully logs in
   * Purpose: This test will test that if a Resident unsuccessfully logs in, they will see an error message
   * Expected Result: Success
   * Return: Status Code: 404
   **/
  it('Resident unsuccessfully logs in ', async function () {
    const response = await request.get('/resident/1')
    expect(response.status).to.eql(404)
    expect(response.body['hydra:member'][0]).to.contain({ apiToken: null })
    expect(response.body['hydra:description']).to.contain({ error: 'Invalid Login: Fields do not match' })
  })
  /**
 * Title: Resident enters valid url without logging in
 * Purpose: This test will test that if a Resident types in a valid URL but has not logged in, they will
 *          be blocked from certain pages
 * Expected Result: Success
 * Return: Status Code: 404
 **/
  it('Resident enters valid url without logging in ', async function () {
    const response = await request.get('/points/1')
    expect(response.status).to.eql(404)
    expect(response.body['hydra:member'][0]).to.contain({ apiToken: null })
    expect(response.body['hydra:description']).to.contain({ error: 'Request Denied, must be logged in.' })
  })
})
