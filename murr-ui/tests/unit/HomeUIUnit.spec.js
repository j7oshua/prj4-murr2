
import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Progress from '@/components/ProgressPoints.vue'

//  story32 below
describe('ProgressPoints.vue', () => {
  it('renders props.value when passed residentid 1', () => {
    const residentid = 1
    const msgpoints = 0
    const wrapper = shallowMount(Progress, {
      propsData: {
        residentid: residentid,
        points: 0
      }
    })
    expect(wrapper.text()).to.include(msgpoints) // should return 0
  })

  it('renders props.value when passed residentid 2', () => {
    const residentid = 2
    const msgpoints = null
    const wrapper = shallowMount(Progress, {
      propsData: {
        residentid: residentid,
        points: null
      }
    })
    expect(wrapper.text()).to.include(msgpoints) // should return null
  })
})


