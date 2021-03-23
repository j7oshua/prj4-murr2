import { shallowMount } from '@vue/test-utils'
import DriverPickUp from '@/components/DriverPickUp'
import { expect } from 'chai'
// golbal wrapper
let wrapper

describe('DriverPickUp.vue', () => {
  beforeEach(() => {
    wrapper = shallowMount(DriverPickUp)

    // propsData: {
    //   siteObject: {
    //     id: 1,
    //     siteName: 'Wascana',
    //     numBins: 4
    //   },
    //   showForm: true
    // }
  })
  it('Should success', async () => {
    expect(wrapper.html().includes('Collected: '))
    // const Collected = wrapper.find('#collected')
    // await Collected.setValue('4')
    // expect(wrapper.find('#collected').element.value).to.equal('4')
  })
})
