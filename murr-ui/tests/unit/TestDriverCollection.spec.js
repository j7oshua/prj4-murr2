import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import { expect } from 'chai'
import DriverCollection from '@/views/DriverCollection'
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)
// run npm install chai-sorted

// global wrapper
let wrapper

// Pre-sets the mount
describe('DriverCollection', () => {
  beforeEach(() => {
    wrapper = shallowMount(DriverCollection)
  })

  /**
   * TestEmptyList
   * table is empty
   */
  it('Should display an empty table list of sites', async () => {
    expect(wrapper.element.value).to.equal('Failed Connection')
  })

  /**
   * TestSiteNameNotExists
   */
  it('Should display error message and site list with the input Wellington', async () => {
    const Search = wrapper.find('#filter-input')

    wrapper.find('#filter-input').trigger('Keypress')
    Search.element.value = 'Wellington'
    expect(wrapper.find('#filter-input').element.value).to.equal('Wellington')
    expect(wrapper.html().includes('No site found with that criteria'))
  })

  /**
   * TestPartialName
   */
  it('AShould display 3 sites in aplphabetical order acsending sortedBy name', async () => {
    const Search = wrapper.find('#filter-input')
    Search.element.value = 'Bri'
    expect(wrapper.find('#filter-input').element.value).to.equal('Bri')
    wrapper.find('#filter-input').trigger('Keypress')
    expect(wrapper.html().includes('Applewood Bridge'))
    expect(wrapper.html().includes('Brighton'))
    expect(wrapper.html().includes('Britney Manor'))
  })
})
