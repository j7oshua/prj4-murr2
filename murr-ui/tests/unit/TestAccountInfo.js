const request = require('supertest')('http://127.0.0.1:8000/api')
const expect = require('chai').expect

// npm install --save supertest mocha chai

describe('AccountInfo', function () {

  //Resident posts valid first name
  it('Valid first name', async function () {
    const account = {
      firstName: "Tom"
    }
    const response = await request
      .post(account.firstName)
      .send(account)
    expect(response.status).to.eql(200)
    expect(response.text).to.eql('Account information has been updated')
  })

  //Resident posts invalid first name
  it('First name too long', async function () {
    const first = 'f'
    const account = {
      firstName: first.repeat(21)
    }
    const response = await request
      .post(account.firstName)
      .send(account)
    expect(response.status).to.eql(400)
    expect(response.text).to.eql('Unable to update account information')
  })

  //Resident posts invalid first name
  it('First name too short', async function () {
    const account = {
      firstName: "f"
    }
    const response = await request
      .post(account.firstName)
      .send(account)
    expect(response.status).to.eql(400)
    expect(response.text).to.eql('Unable to update account information')
  })

  //Resident posts valid last name
  it('Valid last name', async function () {
    const account = {
      lastName: 'L.'
    }
    const response = await request
      .post(account.lastName)
      .send(account)
    expect(response.status).to.eql(200)
    expect(response.text).to.eql('Account information has been updated')
  })

  //Resident posts invalid last name
  it('Last name too long', async function () {
    const last = 'n'
    const account = {
      lastName: last.repeat(21)
    }
    const response = await request
      .post(account.lastName)
      .send(account)
    expect(response.status).to.eql(400)
    expect(response.text).to.eql('Unable to update account information')
  })

  //Resident posts valid profile picture
  it('Valid profile picture', async function () {
    const account = {
      profilePic: 'C:/image.jpg'
    }
    const response = await request
      .post(account.profilePic)
      .send(account)
    expect(response.status).to.eql(200)
    expect(response.text).to.eql('Account information has been updated')
  })

  //Resident posts invalid profile picture
  it('Profile picture not image', async function () {
    const account = {
      profilePic: 'C:/image.txt'
    }
    const response = await request
      .post(account.profilePic)
      .send(account)
    expect(response.status).to.eql(400)
    expect(response.text).to.eql('Unable to update account information')
  })
})