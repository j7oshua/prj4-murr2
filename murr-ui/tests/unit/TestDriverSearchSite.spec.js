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
   * TestNullName
   */
  it('Should show a message when search was clicked but nothing is entered', async () => {
    expect(wrapper.element.value).to.equal('Enter a site name')
  })

  /**
   * TestPartialName
   */
  it('Should display two sites', async () => {
    const Search = wrapper.find('#search')
    await Search.setValue('Bri')
    wrapper.find('#searchButton').at(0).simulate('click')
    expect(wrapper.status).to.eql(200)
    expect(wrapper.find('#SiteTable').element.value).to.equal('Brighton')
    expect(wrapper.find('#SiteTable').element.value).to.equal('Britney Manor')
  })

  /**
   * TestFullNameBrighton
   */
  it('Should display one site with the input Brighton', async () => {
    const Search = wrapper.find('#search')
    await Search.setValue('Brighton')
    wrapper.find('#searchButton').at(0).simulate('click')
    expect(wrapper.status).to.eql(200)
    expect(wrapper.find('#SiteTable').element.value).to.equal('Brighton')
  })
})
