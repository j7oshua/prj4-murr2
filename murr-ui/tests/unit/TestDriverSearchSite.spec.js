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
    expect(wrapper.element.value).to.equal('Failed Connection')
  })

  /**
   * TestFullList
   */
  it('Should display a full table list of all sites', async () => {
    expect(wrapper.find('#SiteTable').element.value).to.equal('Brighton')
    expect(wrapper.find('#SiteTable').element.value).to.equal('Briteny Manor')
    expect(wrapper.find('#SiteTable').element.value).to.equal('Rosa Towers')
    expect(wrapper.find('#SiteTable').element.value).to.equal('Vendetta Suites')
    expect(wrapper.find('#SiteTable').element.value).to.equal('Roswell Evergreen')
    expect(wrapper.find('#SiteTable').element.value).to.equal('Willowgrove Towers')
    expect(wrapper.find('#SiteTable').element.value).to.equal('Hudson Bay Apartments')
    expect(wrapper.find('#SiteTable').element.value).to.equal('Censullo Gate')
    expect(wrapper.find('#SiteTable').element.value).to.equal('Applegate Woods')
    expect(wrapper.find('#SiteTable').element.value).to.equal('Vermont Crossing')
    expect(wrapper.find('#SiteTable').element.value).to.equal('Lucas Caswell Manor')
  })

  /**
   * TestNullName
   */
  it('Should show a message when search was clicked but nothing is entered', async () => {
    expect(wrapper.element.value).to.equal('Enter a site name')
  })

  /**
   * TestPartialName
   */
  it('Should display two sites', async () => {
    expect(wrapper.find('#SiteTable').element.value).to.equal('Brighton')
    expect(wrapper.find('#SiteTable').element.value).to.equal('Britney Manor')
  })

  /**
   * TestFullNameBrighton
   */
  it('Should display one site with the input Brighton', async () => {
    expect(wrapper.find('#SiteTable').element.value).to.equal('Brighton')
  })
})
