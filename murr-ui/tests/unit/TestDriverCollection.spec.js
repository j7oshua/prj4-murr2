import { shallowMount } from '@vue/test-utils'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import { expect } from 'chai'
import DriverCollection from '@/views/DriverCollection'

// run npm install chai-sorted

// global wrapper
let wrapper

// Pre-sets the mount
describe('DriverCollection.vue', () => {
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
    const Search = wrapper.find('#search')
    await Search.setValue('Wellington')
    expect(wrapper.find('#search').element.value).to.equal('Wellington')
    wrapper.find('#searchButton').trigger('click')
    expect(wrapper.find('#span').text()).to.equal('Site does not exist')
  })
  /**
   * TestPartialName
   */
  it('AShould display 3 sites in aplphabetical order acsending sortedBy name', async () => {
    const Search = wrapper.find('#search')
    await Search.setValue('Bri')
    expect(wrapper.find('#search').element.value).to.equal('Bri')
    wrapper.find('#searchButton').trigger('click')
    expect(wrapper.find('#SiteTable').text()).to.equal('Applewood Bridge')
    expect(wrapper.find('#SiteTable').text()).to.equal('Brighton')
    expect(wrapper.find('#SiteTable').text()).to.equal('Britney Manor')
    expect([{ id: 8, name: 'Applewood Bridge' }, { id: 2, name: 'Brighton' }, { id: 3, name: 'Britney Manor' }]).to.be.sortedBy('name')
  })
})
