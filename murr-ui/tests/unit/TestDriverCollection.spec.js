import { shallowMount } from '@vue/test-utils'
import { expect } from 'chai'
import DriverCollection from '@/views/DriverCollection'

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
    await Search.setValue('Wellington')
    expect(wrapper.find('#filter-input').element.value).to.equal('Wellington')
    wrapper.find('#filter-input').trigger('keypress')
    expect(wrapper.html().includes('No site found with that criteria'))
  })
  /**
   * TestPartialName
   */
  it('AShould display 3 sites in aplphabetical order acsending sortedBy name', async () => {
    const Search = wrapper.find('#filter-input')
    await Search.setValue('Bri')
    expect(wrapper.find('#filter-input').element.value).to.equal('Bri')
    wrapper.find('#filter-input').trigger('keypress')
    expect(wrapper.find('#my-table').text()).to.equal('Applewood Bridge')
    expect(wrapper.find('#my-table').text()).to.equal('Brighton')
    expect(wrapper.find('#my-table').text()).to.equal('Britney Manor')
    expect([{ id: 8, name: 'Applewood Bridge' }, { id: 2, name: 'Brighton' }, { id: 3, name: 'Britney Manor' }]).to.be.sortedBy('name')
  })
})
