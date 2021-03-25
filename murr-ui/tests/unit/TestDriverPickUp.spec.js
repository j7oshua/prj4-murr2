import { shallowMount } from '@vue/test-utils'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import DriverPickUp from '@/components/DriverPickUp'
import { expect } from 'chai'

// golbal wrapper
let wrapper

describe('DriverPickUp.vue', () => {
  beforeEach(() => {
    wrapper = shallowMount(DriverPickUp)
  })

  /**
   *
   */
  it('Should display Valid bin amount when all four bins in Collect input', async () => {
    const Collected = wrapper.find('#collected')
    await Collected.setValue('5')
    expect(wrapper.find('#collected').element.value).to.equal('5')
    expect(wrapper.find('.border-success span').text()).to.equal('Valid bin amount')
  })

  /**
   *
   */
  it('should display Valid bin amount when all four bins in all input types', async () => {
    const collect = wrapper.find('#collected')
    await collect.setValue(2)
    expect(wrapper.find('#collected').element.value).to.equal('2')
    const obstruct = wrapper.find('#obstructed')
    await obstruct.setValue(2)
    expect(wrapper.find('#obstructed').element.value).to.equal('2')
    const contaminated = wrapper.find('#contaminated')
    await contaminated.setValue(1)
    expect(wrapper.find('#contaminated').element.value).to.equal('1')
    expect(wrapper.find('.border-success span').text()).to.equal('Valid bin amount')
  })

  /**
   *
   */
  it('Should display error message when all input types total 6 and is expecting 4', async () => {
    const collectBins = wrapper.find('#collected')
    await collectBins.setValue('2')
    expect(wrapper.find('#collected').element.value).to.equal('2')
    const obstructedBins = wrapper.find('#obstructed')
    await obstructedBins.setValue('2')
    expect(wrapper.find('#obstructed').element.value).to.equal('2')
    const contaminatedBins = wrapper.find('#contaminated')
    await contaminatedBins.setValue('2')
    expect(wrapper.find('#contaminated').element.value).to.equal('2')
    expect(wrapper.find('.border-danger span').text()).to.equal('This Site is expecting 5 bins.')
  })

  /**
   *
   */
  it('Should display error message when all input types total 3 and is expecting 4', async () => {
    const collectBin = wrapper.find('#collected')
    await collectBin.setValue('1')
    expect(wrapper.find('#collected').element.value).to.equal('1')
    const obstructBin = wrapper.find('#obstructed')
    await obstructBin.setValue('1')
    expect(wrapper.find('#obstructed').element.value).to.equal('1')
    const contaminatedBin = wrapper.find('#contaminated')
    await contaminatedBin.setValue('1')
    expect(wrapper.find('#contaminated').element.value).to.equal('1')
    expect(wrapper.find('.border-danger span').text()).to.equal('This Site is expecting 5 bins.')
  })

  /**
   *
   */
  it('Should display error message when all input types are set to null and is expecting 4', async () => {
    expect(wrapper.find('.border-danger span').text()).to.equal('This Site is expecting 5 bins.')
  })

  /**
   *
   */
  it('Check for null siteId', async () => {
    await wrapper.setData({
      siteObject: {
        id: '',
        siteName: 'Wascana',
        numBins: 4
      }
    })
    expect(wrapper.find('#invalidSite').text()).to.equal('Error - No site exists.')
  })

  /**
   *
   */
  it('Returns the Site id', async () => {
    expect(wrapper.find('#siteId').text()).to.equal('1')
  })

  /**
   *
   */
  it('Checks for site name from props as empty string', async () => {
    await wrapper.setProps({
      siteObject: {
        id: 1,
        siteName: '',
        numBins: 4
      }
    })
    expect(wrapper.find('#invalidSiteName').text()).to.equal('Error - No site exists')
  })

  /**
   *
   */
  it('returns site name', async () => {
    expect(wrapper.find('#siteName').text()).to.equal('Wascana')
  })
})
