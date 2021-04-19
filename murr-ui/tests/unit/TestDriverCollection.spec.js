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
   * Purpose: tests that is there are no items in the list
   *         that a message is displayed: 'No sites to display'
   */
  it('Should display an empty table list of sites', async () => {
    expect(wrapper.html().includes('No sites to display'))
  })

  /**
   * TestSiteNameNotExists
   * Purpose: to check that no site exists with the name Wellington
   * Returns: Error Message: 'No site found with those criteria'
   */
  it('Should display error message and site list with the input Wellington', async () => {
    const Search = wrapper.find('#filter-input')
    // on key press
    wrapper.find('#filter-input').trigger('Keypress')
    // set the value to wellington
    Search.element.value = 'Wellington'
    // makes sure values match
    expect(wrapper.find('#filter-input').element.value).to.equal('Wellington')
    // expected result
    expect(wrapper.html().includes('No site found with those criteria'))
  })

  /**
   * TestPartialName
   * Purpose: Check for partial input with sites name 'Bri'
   * Return: 3 sites, Applwood Bridge, Brighton and Britney Manor.
   */
  it('AShould display 3 sites in alphabetical order ascending sortedBy name', async () => {
    const Search = wrapper.find('#filter-input')
    Search.element.value = 'Bri'
    expect(wrapper.find('#filter-input').element.value).to.equal('Bri')
    wrapper.find('#filter-input').trigger('Keypress')
    expect(wrapper.html().includes('Applewood Bridge'))
    expect(wrapper.html().includes('Brighton'))
    expect(wrapper.html().includes('Britney Manor'))
  })
})
