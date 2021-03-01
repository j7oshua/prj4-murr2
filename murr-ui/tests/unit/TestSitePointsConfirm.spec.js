import { mount } from '@vue/test-utils'
import SitePointsConfirmation from '@/components/SitePointsConfirmation'
import { expect } from 'chai'

let wrapper
const server = '127.0.0.1:8000'
const chai = require('chai')
const chaiHttp = require('chai-http')
chai.use(chaiHttp)

// ******* Setup the props named pickup to contain the values declared below before each test
describe('SitePointsConfirmation.vue', () => {
  beforeEach(() => {
    wrapper = mount(SitePointsConfirmation, {
      propsData: {
        pickup: {
          pickupID: 1,
          siteID: 1,
          numCollected: 5,
          numObstructed: 0,
          numContaminated: 0,
          date: '24-02-2021'
        }
      }
    })
  })
  // ****** Test block for when the component is first rendered
  describe('when rendered, error message displayed', () => {
    it('asks for confirmation of number of containers picked up', () => {
      expect(wrapper.find('h1').text().to.be.equal('Confirm Point Addition to { sitename }'))
      expect(wrapper.find('.message').text().to.be.equal('Do you confirm { numCollected } were collected from '))
    })
    before(() => {
      wrapper.setProps({
        pickup: {
          pickupID: 99,
          siteID: 1,
          numCollected: 0,
          numObstructed: 1,
          numContaminated: 4,
          date: '24-02-2021'
        }
      })
    })
    // ******** Test block when there is no pickup ID found in the database
    it('displays error that pickupID was not found', () => {
      expect(wrapper.find('h1').text().to.be.equal('Error'))
      expect(wrapper.find('.errorMessage').text().to.be.equal('Pickup ID was not found'))
    })
    before(() => {
      wrapper.setData({
        resp: 500
      })
    })
    // ******* Test for when the front end could not communicate with the backend
    it('displays error that could not connect to server', () => {
      expect(wrapper.find('h1').text().to.be.equal('Connection Error'))
      expect(wrapper.find('.errorMessage').text().to.be.equal('Could not connect to the server'))
    })
  })
  // ********* Testing the cancel button for the modal. Should close the modal when the button is clicked
  describe('clicking the cancel button', async () => {
    it('closes the component', () => {
      wrapper.find('button.cancel').trigger('click')
      expect(wrapper.exists().to.be.false)
    })
  })
  // ********** Test block for the yes button.
  describe('clicking the yes button', () => {
    // ************ Test block for when points are added to the site with a success message
    it('displays success message that points were added', async () => {
      wrapper.find('button.yes').trigger('click')
      expect(wrapper.find('h1').text().to.be.equal('Points Added!'))
      expect(wrapper.find('.successMessage').text().to.be.equal('Successfully added points to { sitename }!'))
    })
    // ******* Test block for having no points added to the site
    it('displays message that no points were added', async () => {
      // Set the pickup prop to now include a pickup with no containers collected
      await wrapper.setProps({
        pickup: {
          pickupID: 2,
          siteID: 2,
          numCollected: 0,
          numObstructed: 1,
          numContaminated: 4,
          date: '24-02-2021'
        }
      })
      wrapper.find('button.yes').trigger('click')
      expect(wrapper.find('h1').text().to.be.equal('{ sitename } No Points Added'))
      expect(wrapper.find('.successMessage').text().to.be.equal('No points were added to { sitename }'))
    })
  })
  describe('post to the database', () => {
    it('creates points for the site and returns status code 201', (done) => {
      const newPickup = {
        pickupID: 1
      }
      chai.request(server)
        .post('/api/site/1')
        .send(newPickup)
        .end((res) => {
          expect(res.should.have.status(201))
          expect(res.body.should.be.a('string'))
          done()
        })
    })
    it('error while sending no pickup ID', (done) => {
      const newPickup = {}
      chai.request(server)
        .post('/api/site/1')
        .send(newPickup)
        .end((res) => {
          expect(res.should.have.status(400))
          expect(res.body.should.be.a('string'))
          done()
        })
    })
  })
})
