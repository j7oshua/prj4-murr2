import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Progress from '@/components/ProgressPoints.vue'

//  story32 below
describe('ProgressPoints.vue', () => {
  it('renders props.value when passed residentid 1', () => {
    const residentid = 3
    const points = 0
    const wrapper = shallowMount(Progress, {
      propsData: { residentid: residentid, tempPoints: points }
    })
    wrapper.setData({ tempPoints: points })
    expect(wrapper.text()).to.include(points) // should return 0
  })
  it('renders props.value when passed residentid 1', () => {
    const residentid = 1
    const points = 1000
    const wrapper = shallowMount(Progress, {
      propsData: { residentid: residentid, tempPoints: points }
    })
    wrapper.setData({ tempPoints: points })
    expect(wrapper.text()).to.include(points) // should return 1000
  })
  it('renders props.value when passed residentid 2', () => {
    const residentid = 4
    const points = NaN
    const wrapper = shallowMount(Progress, {
      propsData: { residentid: residentid, tempPoints: points }
    })
    wrapper.setData({ tempPoints: points })
    expect(wrapper.text()).to.include(points) // should return null
  })
})
