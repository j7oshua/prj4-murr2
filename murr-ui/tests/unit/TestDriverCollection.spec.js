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
<<<<<<< HEAD
    wrapper.find('#filter-input').trigger('Keypress')
    Search.element.value = 'Wellington'
    expect(wrapper.find('#filter-input').element.value).to.equal('Wellington')
=======
    await Search.setValue('Wellington')
    expect(wrapper.find('#filter-input').element.value).to.equal('Wellington')
    wrapper.find('#filter-input').trigger('keypress')
>>>>>>> 009efe0d372b9550f35ab47bba859da59ad6bd99
    expect(wrapper.html().includes('No site found with that criteria'))
  })

  /**
   * TestPartialName
   */
  it('AShould display 3 sites in aplphabetical order acsending sortedBy name', async () => {
    const Search = wrapper.find('#filter-input')
<<<<<<< HEAD
    Search.element.value = 'Bri'
    expect(wrapper.find('#filter-input').element.value).to.equal('Bri')
    wrapper.find('#filter-input').trigger('Keypress')
    expect(wrapper.html().includes('Applewood Bridge'))
    expect(wrapper.html().includes('Brighton'))
    expect(wrapper.html().includes('Britney Manor'))
=======
    await Search.setValue('Bri')
    expect(wrapper.find('#filter-input').element.value).to.equal('Bri')
    wrapper.find('#filter-input').trigger('keypress')
    expect(wrapper.find('#my-table').text()).to.equal('Applewood Bridge')
    expect(wrapper.find('#my-table').text()).to.equal('Brighton')
    expect(wrapper.find('#my-table').text()).to.equal('Britney Manor')
    expect([{ id: 8, name: 'Applewood Bridge' }, { id: 2, name: 'Brighton' }, { id: 3, name: 'Britney Manor' }]).to.be.sortedBy('name')
>>>>>>> 009efe0d372b9550f35ab47bba859da59ad6bd99
  })
})
