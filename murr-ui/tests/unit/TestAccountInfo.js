const request = require('supertest')('http://127.0.0.1:8000/api')
const expect = require('chai').expect

// npm install --save supertest mocha chai

describe('Account Info Update', function () {
  it('Valid first name', async function () {

  })

  it('First name too long', async function () {

  })

  it('First name too short', async function () {

  })

  it('Valid last name', async function () {

  })

  it('Last name too long', async function () {

  })

  it('Valid profile picture', async function () {

  })

  it('Profile picture not image', async function () {

  })
})

// describe('POST to the database', () => {
//   it('creates points for the site and returns status code 200', async function () {
//     // Creates a mock pickupID to send to the server
//     const pickup = {
//       pickupID: 1
//     }
//     const response = await request
//       .post('1')
//       .send(pickup)
//     expect(response.status).to.eql(200)
//     expect(response.text).to.eql('100 Points successfully added to Wascana')
//   })
//   it('receive status code 500 while sending no pickupID', async function () {
//     const newPickup = {}
//     const response = await request
//       .post('1')
//       .send(newPickup)
//     expect(response.status).to.eql(500)
//   })
// })
