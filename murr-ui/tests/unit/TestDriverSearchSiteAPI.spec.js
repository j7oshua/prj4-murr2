const request = require('supertest')('http://127.0.0.1:8000/site/')
const expect = require('chai').expect

describe('GET /sites', function () {

  /**
   *
   */
  it('Display all site when first arriving to the page', async function() {
    const response = await request.get('/sites')
    expect(response.status).to.eql(200)
    expect(response.body['hydra:member'][0]).to.contain({ id: 8 })
    expect(response.body['hydra:member'][1]).to.contain({ id: 10 })
    expect(response.body['hydra:member'][2]).to.contain({ id: 2 })
    expect(response.body['hydra:member'][3]).to.contain({ id: 3 })
    expect(response.body['hydra:member'][4]).to.contain({ id: 9 })
    expect(response.body['hydra:member'][5]).to.contain({ id: 12 })
    expect(response.body['hydra:member'][6]).to.contain({ id: 4 })
    expect(response.body['hydra:member'][7]).to.contain({ id:6 })
    expect(response.body['hydra:member'][8]).to.contain({ id: 5 })
    expect(response.body['hydra:member'][9]).to.contain({ id: 11 })
    expect(response.body['hydra:member'][10]).to.contain({ id: 1 })
    expect(response.body['hydra:member'][11]).to.contain({ id: 7 })

    expect(response.body['hydra:member'][0]).to.contain({ siteName: 'Applewood Bridge' })
    expect(response.body['hydra:member'][1]).to.contain({ siteName: 'Applewood Gate' })
    expect(response.body['hydra:member'][2]).to.contain({ siteName: 'Brighton' })
    expect(response.body['hydra:member'][3]).to.contain({ siteName: 'Britney Manor' })
    expect(response.body['hydra:member'][4]).to.contain({ siteName: 'Censullo Gate' })
    expect(response.body['hydra:member'][5]).to.contain({ siteName: 'Lucas Caswell Manor' })
    expect(response.body['hydra:member'][6]).to.contain({ siteName: 'Rosa Towers' })
    expect(response.body['hydra:member'][7]).to.contain({ siteName: 'Rosewell Evergreen' })
    expect(response.body['hydra:member'][8]).to.contain({ siteName: 'Vendetta Suites' })
    expect(response.body['hydra:member'][9]).to.contain({ siteName: 'Vermont Crossing' })
    expect(response.body['hydra:member'][10]).to.contain({ siteName: 'Wascana' })
    expect(response.body['hydra:member'][11]).to.contain({ siteName: 'Willowgrove Towers' })
  })
})
