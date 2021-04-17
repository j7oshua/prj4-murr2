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
    const response = await request
      .post('/login')
      .send({username: 'email@email.com', password: 'password'})
    expect(response.status).to.eql(200)
    expect(response.body.data).to.contains( {'id' : 9} )
    expect(response.body).to.contains({'token': response.body.token})
  })

  /**
   * Title: Resident successfully logs in with phone number
   * Purpose: This test will test that a resident can login with their phone number
   * Expected Result: Success
   * Return: Status Code: 200
   **/
  it('Resident successfully logs in with valid phone and password.', async function () {
    const response = await request.post('/login')
      .send({username: '3065558888', password: 'password'})
    expect(response.status).to.eql(200)
    expect(response.body.data).to.contains( {'id' : 12} )
    expect(response.body).to.contains({'token': response.body.token})
  })
  /**
   * Title: Resident unsuccessfully logs in
   * Purpose: This test will test that if a Resident unsuccessfully logs in, they will see an error message
   * Expected Result: Success
   * Return: Status Code: 401
   **/
  it('Resident unsuccessfully logs in ', async function () {
    const response = await request.post('/login')
      .send({username: 'email', password: 'password'})
    expect(response.status).to.eql(401)
    expect(response.body).to.contain({ message: "Invalid credentials." })
  })
  /**
   * Title: Resident enters valid url without logging in
   * Purpose: This test will test that if a Resident types in a valid URL but has not logged in, they will
   *          be blocked from certain pages
   * Expected Result: Success
   * Return: Status Code: 401
   **/
  it('Resident enters valid url without logging in ', async function () {
    const response = await request.post('/login')
      .send({username: '', password: ''})
      .set("Authorization", 'Bearer token=null')
    expect(response.status).to.eql(401)
    expect(response.body).to.contain({ message: "Invalid credentials." })
  })
})
