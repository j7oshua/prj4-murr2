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
  describe('clicking the cancel button', async () => {
    it('closes the component', () => {
      wrapper.find('button.cancel').trigger('click')
      expect(wrapper.exists().to.be.false)
    })
  })
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
    })
  })
})
