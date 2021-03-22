const request = require('supertest')('http://127.0.0.1:8000/api')
const expect = require('chai').expect

// npm install --save supertest mocha chai

describe('GET /articles', function () {

  /**
   * Title: Resident views all recycling articles on main page
   * Purpose: This test will test that ALL articles appear on the main education page
   * Expected Result: Success
   * Return: Status Code: 200, Array of article objects
   **/
  it('Resident views all recycling articles on main page', async function () {
    const response = await request.get('/articles')
    expect(response.status).to.eql(200)

    expect(response.body['hydra:member'][0]).to.contain({ title: 'What Can You Recycle' })
    expect(response.body['hydra:member'][1]).to.contain({ title: 'Multi-Unit Cart Service' })
    expect(response.body['hydra:member'][2]).to.contain({ title: 'Multi-Unit Bin Service' })

    expect(response.body['hydra:member'][0]).to.contain({ image: 'https://image1.jpg' })
    expect(response.body['hydra:member'][1]).to.contain({ image: 'https://www.cosmoindustries.com/assets/images/cosmocarts-460x307.jpg' })
    expect(response.body['hydra:member'][2]).to.contain({ image: 'https://www.cosmoindustries.com/assets/images/side-by-side-recycling-and-garbage-460x307.jpg' })
  })

  /**
   * Title: Resident selects recycling article “What can you Recycle"
   * Purpose: This test will test that once a Resident selects an article they will be transferred to an article
   *          page with that article's specific details
   * Expected Result: Success
   * Return: Status Code: 200, Array of an article
   **/
  it('Resident selects recycling article “What can you Recycle”', async function () {
    const response = await request.get('/articles/1')
    expect(response.status).to.eql(200)

    expect(response.body).to.contain({ title: 'What Can You Recycle' })
    expect(response.body).to.contain({ image: 'https://image1.jpg' })
    expect(response.body).to.contain({ info: 'Paper, Plastic, and Cardboard' })
  })

  /**
   * Title: Resident unsuccessfully views recycling article
   * Purpose: This test will test that if a Resident attempts to go an article that doesnt exist, they will see an error page
   * Expected Result: Success
   * Return: Status Code: 404
   **/
  it('Resident unsuccessfully views recycling article', async function () {
    const response = await request.get('/articles/-1')
    expect(response.status).to.eql(404)
  })
})

