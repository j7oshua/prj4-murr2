const request = require('supertest')('http://127.0.0.1:8000/api/')
const expect = require('chai').expect

describe('GET /sites', function () {
  /**
   * TestFullFirstPage
   */
  it('Display all site when first arriving to the page', async function () {
    // set a custom url that gets the order of all Site names in asc for page one
    const response = await request.get('sites?order[siteName]&page=1')
    // excepting status code to equal 200 -- ok
    expect(response.status).to.eql(200)
    // show all the expected hydra member objects for page one for page one (id and siteName)
    expect(response.body['hydra:member'][0]).to.contain({ id: 8 })
    expect(response.body['hydra:member'][1]).to.contain({ id: 10 })
    expect(response.body['hydra:member'][2]).to.contain({ id: 2 })
    expect(response.body['hydra:member'][3]).to.contain({ id: 3 })
    expect(response.body['hydra:member'][4]).to.contain({ id: 9 })
    expect(response.body['hydra:member'][5]).to.contain({ id: 12 })
    expect(response.body['hydra:member'][6]).to.contain({ id: 4 })
    expect(response.body['hydra:member'][7]).to.contain({ id: 6 })
    expect(response.body['hydra:member'][8]).to.contain({ id: 5 })
    expect(response.body['hydra:member'][9]).to.contain({ id: 11 })
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
  })

  /**
   * TestFullSecondPage
   */
  it('Display all sites on page 2', async function () {
    // set a custom url that gets the order of all Site names in asc for page two
    const response = await request.get('sites?order[siteName]&page=2')
    expect(response.status).to.eql(200)
    expect(response.body['hydra:member'][10]).to.contain({ id: 1 })
    expect(response.body['hydra:member'][11]).to.contain({ id: 7 })
    expect(response.body['hydra:member'][10]).to.contain({ siteName: 'Wascana' })
    expect(response.body['hydra:member'][11]).to.contain({ siteName: 'Willowgrove Towers' })
  })

  /**
   * TestFullNameBrighton
   */
  it('Display one site when searching with "Brighton"', async function () {
    // set a custom url that gets the order of all Site names that have "Brighton" in asc for page one
    const response = await request.get('sites?order[siteName]&siteName=Brighton&page=1')
    expect(response.status).to.eql(200)
    expect(response.body['hydra:member'][0]).to.contain({ id: 2 })
    expect(response.body['hydra:member'][0]).to.contain({ siteName: 'Brighton' })
  })

  /**
   * TestPartialNameBri
   */
  it('Display three sites when searching with "Bri"', async function () {
    // set a custom url that gets the order of all Site names that have "Bri" in asc for page one
    const response = await request.get('sites?order[siteName]&siteName=Bri&page=1')
    expect(response.status).to.eql(200)
    expect(response.body['hydra:member'][1]).to.contain({ id: 8 })
    expect(response.body['hydra:member'][1]).to.contain({ siteName: 'Applewood Bridge' })
    expect(response.body['hydra:member'][1]).to.contain({ id: 2 })
    expect(response.body['hydra:member'][1]).to.contain({ siteName: 'Brighton' })
    expect(response.body['hydra:member'][1]).to.contain({ id: 3 })
    expect(response.body['hydra:member'][1]).to.contain({ siteName: 'Britney Manor' })
  })

  /**
   * TestSiteNameDoesNotExist
   */
  it('Display an error for searching a site that does not exist', async function () {
    // set a custom url that gets the order of all Site names that have "Wellington" in asc for page one
    const response = await request.get('/sites?order[siteName]&siteName=Wellington&page=1')
    // excepting status code to equal 404 -- Not Found
    expect(response.status).to.eql(404)
    // excepting a error msg with the hydra decription : 'Item not found for "/api/sites?siteName=Wellington" '
    expect(response.body['hydra:description']).to.contain('Item not found for "/api/sites?siteName=Wellington"')
  })
})
