const request = require('supertest')('http://127.0.0.1:8000')
const expect = require('chai').expect

// npm install --save supertest mocha chai
// json-server --watch db.json

describe('POST /login', function () {
  /**
   * Title: Resident successfully logs in with email
   * Purpose: This test will test that a resident can login with their email
   * Expected Result: Success
   * Return: Status Code: 200
   **/
  it('Resident successfully logs in with their valid email and password.', async function () {
    const response = await request.post('/login')
    expect(response.status).to.eql(204)
    expect(response.body).to.contain({ location: '/api/residents/8' })
    expect(response.body).to.contain({ sessionCookie: '' })
  })

  /**
   * Title: Resident successfully logs in with phone number
   * Purpose: This test will test that a resident can login with their phone number
   * Expected Result: Success
   * Return: Status Code: 200
   **/
  it('Resident successfully logs in with valid phone and password.', async function () {
    const response = await request.post('/login')
    expect(response.status).to.eql(204)
    expect(response.body).to.contain({ location: '/api/residents/8' })
    expect(response.body).to.contain({ sessionCookie: '' })
  })
  /**
   * Title: Resident unsuccessfully logs in
   * Purpose: This test will test that if a Resident unsuccessfully logs in, they will see an error message
   * Expected Result: Success
   * Return: Status Code: 404
   **/
  it('Resident unsuccessfully logs in ', async function () {
    const response = await request.post('/login')
    expect(response.status).to.eql(400)
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
    const response = await request.post('/login')
    expect(response.status).to.eql(400)
    expect(response.body['hydra:description']).to.contain({ error: 'Invalid Credentials' })
  })
})
