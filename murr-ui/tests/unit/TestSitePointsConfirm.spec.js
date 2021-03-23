import { mount } from '@vue/test-utils'
import SitePointsConfirmation from '@/components/SitePointsConfirmation'
import { expect } from 'chai'

let wrapper

// Setup the props named pickup to contain the values declared below before each test
describe('SitePointsConfirmation', () => {
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
        },
        showModal: true,
        siteName: 'Wascana',
        respCode: 0
      }
    })
  })
  //   // Multiple tests, for when the component is first rendered
  describe('When component is first rendered', () => {
    it('asks for confirmation of number of containers picked up', () => {
      expect(wrapper.find('h4').text()).to.equal('Confirm Point Addition to Wascana')
      expect(wrapper.find('.message').text()).to.equal('Do you confirm 5 containers were collected from Wascana?')
    })
    it('displays error that pickupID was not found', async () => {
      await wrapper.setProps({
        pickup: {
          pickupID: 99,
          site: 1,
          numCollected: 5,
          numObstructed: 0,
          numContaminated: 0,
          dateTime: '2020-03-03'
        }
      })
      expect(wrapper.html().includes('Error: Bad Request'))
      expect(wrapper.html().includes('Pickup ID 99 was not found'))
    })
    // Testing the yes button.
    describe('clicking the yes button', () => {
      it('displays success message that points were added', async () => {
        await wrapper.setData({
          respCode: 201
        })
        wrapper.find('#btnyes').trigger('click')
        expect(wrapper.html().includes('Points Added to Wascana!'))
        expect(wrapper.html().includes('Successfully added 100 points to Wascana!'))
      })
      it('displays message that no points were added', async () => {
        // Set the pickup prop to now include a pickup with no containers collected
        await wrapper.setProps({
          pickup: {
            pickupID: 2,
            site: 2,
            numCollected: 0,
            numObstructed: 2,
            numContaminated: 4,
            dateTime: '2020-03-03'
          }
        })
        await wrapper.setData({
          siteName: 'Brighton',
          respCode: 200
        })
        wrapper.find('#btnyes').trigger('click')
        expect(wrapper.html().includes('Brighton - No Points Added'))
        expect(wrapper.html().includes('No points were added to Brighton'))
      })
      it('displays message that a error occured when sending a invalid pickup', async () => {
        await wrapper.setProps({
          pickup: {}
        })
        await wrapper.setData({
          respCode: 400
        })
        wrapper.find('#btnyes').trigger('click')
        expect(wrapper.html().includes('There was a error sending the request'))
        expect(wrapper.html().includes('Error: Bad Request'))
      })
      it('displays message that a error occured when a server connection error occurs', async () => {
        await wrapper.setData({
          respCode: 500
        })
        wrapper.find('#btnyes').trigger('click')
        expect(wrapper.html().includes('There was a error sending the request'))
        expect(wrapper.html().includes('Error: Not Found'))
      })
    })
  })
})
