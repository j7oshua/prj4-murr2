import { shallowMount } from '@vue/test-utils'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import { expect } from 'chai'
import DriverCollection from '@/views/DriverCollection'

// global wrapper
let wrapper

// Pre-sets the mount
describe('DriverCollection.vue', () => {
  beforeEach(() => {
    wrapper = shallowMount(DriverCollection)
  })

  /**
   * TestEmptyList
   */
  it('Should display an empty table list of sites', async () => {
    expect(wrapper.find('#SiteTable').element.value).to.equal('')
  })

  /**
   * TestFullList
   */
  it('Should display a full table list of all sites', async () => {
    expect(wrapper.find('#SiteTable').element.value).to.equal('Wascana, Brighton, Britney Manor, Rosa Towers, Vendetta Suites, Roswell Evergreen, Willowgrove Towers, Hudson Bay Apartments, Censullo Gate, Applegate Woods, Vermont Crossing, Lucas Caswell Manor')
  })
})
