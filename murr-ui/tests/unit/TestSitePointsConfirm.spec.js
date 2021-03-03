import { mount } from '@vue/test-utils'
import SitePointsConfirmation from '@/components/SitePointsConfirmation'
import { expect } from 'chai'

let wrapper
// URL to the backend server
const server = '127.0.0.1:8000'

// Used to test the front end api calls to the backend server
const chai = require('chai')
const chaiHttp = require('chai-http')
chai.use(chaiHttp)

// Setup the props named pickup to contain the values declared below before each test
describe('SitePointsConfirmation.vue', () => {
  beforeEach(() => {
    wrapper = mount(SitePointsConfirmation, {
      propsData: {
        pickUp: {
          pickupID: 1,
          site: 1,
          numCollected: 5,
          numObstructed: 0,
          numContaminated: 0,
          dateTime: '2020-03-03'
        }
      }
    })
  })
  // Multiple tests, for when the component is first rendered
  describe('When component is first rendered', () => {
    it('asks for confirmation of number of containers picked up', () => {
      expect(wrapper.find('h1').text().to.be.equal('Confirm Point Addition to Wascana'))
      expect(wrapper.find('.message').text().to.be.equal('Do you confirm 5 containers were collected from Wascana?'))
    })
    // Sets the prop data to a pickupID that does not exist
    before(() => {
      wrapper.setProps({
        pickup: {
          pickupID: 99,
          site: 1,
          numCollected: 5,
          numObstructed: 0,
          numContaminated: 0,
          dateTime: '2020-03-03'
        }
      })
    })
    it('displays error that pickupID was not found', () => {
      expect(wrapper.find('h1').text().to.be.equal('Error'))
      expect(wrapper.find('.errorMessage').text().to.be.equal('Pickup ID was not found'))
    })
    // Sets the component data to simulate a response code of 500 for connection error
    before(() => {
      wrapper.setData({
        respCode: 500
      })
    })
    it('displays error that could not connect to server', () => {
      expect(wrapper.find('h1').text().to.be.equal('Connection Error'))
      expect(wrapper.find('.errorMessage').text().to.be.equal('Could not connect to the server'))
    })
  })
  // Testing the cancel button.
  describe('clicking the cancel button', async () => {
    it('closes the component', () => {
      wrapper.find('button.cancel').trigger('click')
      expect(wrapper.exists().to.be.false)
    })
  })
  // Testing the yes button.
  describe('clicking the yes button', () => {
    it('displays success message that points were added', async () => {
      wrapper.find('button.yes').trigger('click')
      expect(wrapper.find('h1').text().to.be.equal('Points Added!'))
      expect(wrapper.find('.successMessage').text().to.be.equal('Successfully added points to Wascana!'))
    })
    it('displays message that no points were added', async () => {
      // Set the pickup prop to now include a pickup with no containers collected
      await wrapper.setProps({
        pickup: {
          pickupID: 2,
          site: 2,
          numCollected: 5,
          numObstructed: 0,
          numContaminated: 0,
          dateTime: '2020-03-03'
        }
      })
      wrapper.find('button.yes').trigger('click')
      expect(wrapper.find('h1').text().to.be.equal('Brighton - No Points Added'))
      expect(wrapper.find('.successMessage').text().to.be.equal('No points were added to Brighton'))
    })
  })
  // Tests the POST api call to the server.
  describe('POST to the database', () => {
    it('creates points for the site and returns status code 201', (done) => {
      // Creates a mock pickupID to send to the server
      const newPickup = {
        pickupID: 1
      }
      chai.request(server)
        .post('/site/1')
        .send(newPickup)
        .end((res) => {
          expect(res.should.have.status(201))
          done()
        })
    })
    it('receive status code 400 while sending no pickupID', (done) => {
      const newPickup = {}
      chai.request(server)
        .post('/site/1')
        .send(newPickup)
        .end((res) => {
          expect(res.should.have.status(400))
          done()
        })
    })
  })
  // Testing the GET request to receive the site name from the database
  describe('GET request', () => {
    it('gets back the site name from the database', (done) => {
      const getSiteName = {
        site: 1
      }
      const siteURL = '/api/site/' + getSiteName.site.toString()
      chai.request(server)
        .get(siteURL)
        .send(getSiteName)
        .end((res) => {
          expect(res.should.have.status(200))
          expect(res.body.should.have.property('siteName').equal('Wascana'))
          done()
        })
    })
    it('gets back an error status code 400 that the site does not exist', (done) => {
      const getSiteName = {
        site: 99
      }
      const siteURL = '/api/site/' + getSiteName.site.toString()
      chai.request(server)
        .get(siteURL)
        .send(getSiteName)
        .end((res) => {
          expect(res.should.have.status(400))
          done()
        })
    })
  })
})
