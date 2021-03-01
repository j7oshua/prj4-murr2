import { mount } from '@vue/test-utils'
import SitePointsConfirmation from '@/components/SitePointsConfirmation'
import { expect } from 'chai'

let wrapper

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
    it('displays error that pickupID was not found', () => {
      expect(wrapper.find('h1').text().to.be.equal('Error'))
      expect(wrapper.find('.errorMessage').text().to.be.equal('Pickup ID was not found'))
    })
    before(() => {
      wrapper.setData({
        resp: 500
      })
    })
    it('displays error that could not connect to server',() => {
      expect(wrapper.find('h1').text().to.be.equal('Connection Error'))
      expect(wrapper.find('.errorMessage').text().to.be.equal('Could not connect to the server'))
    })
  })
  // *********
  describe('clicking the cancel button', async () => {
    it('closes the component', () => {
      wrapper.find('button.cancel').trigger('click')
      expect(wrapper.exists().to.be.false)
    })
  })
  // **********
  describe('clicking the yes button', () => {
    it('displays success message that points were added', async () => {
      wrapper.find('button.yes').trigger('click')
      expect(wrapper.find('h1').text().to.be.equal('Points Added!'))
      expect(wrapper.find('.successMessage').text().to.be.equal('Successfully added points to { sitename }!'))
    })
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
})
