import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Progress from '@/components/ProgressPoints.vue'

//  story32 below
describe('ProgressPoints.vue', () => {
  it('renders props.value when passed residentid 1', () => {
    const residentid = 1
    const msgpoints = 0
    const wrapper = shallowMount(Progress, {
      propsData: { points: msgpoints }
    })
    wrapper.setData({ tempResId: residentid, points: msgpoints })
    expect(wrapper.text()).to.include(msgpoints) // should return 0
  })
  it('renders props.value when passed residentid 1', () => {
    const residentid = 2
    const msgpoints = 1000
    const wrapper = shallowMount(Progress, {
      propsData: { points: msgpoints }
    })
    wrapper.setData({ tempResId: residentid, points: msgpoints })
    expect(wrapper.text()).to.include(msgpoints) // should return 1000
  })
  it('renders props.value when passed residentid 2', () => {
    const residentid = 2
    const msgpoints = NaN
    const wrapper = shallowMount(Progress, {
      propsData: { points: msgpoints }
    })
    wrapper.setData({ tempResId: residentid, points: msgpoints })
    expect(wrapper.text()).to.include(msgpoints) // should return null
  })
})
