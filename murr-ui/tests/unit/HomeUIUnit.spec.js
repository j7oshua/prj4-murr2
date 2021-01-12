
import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Progress from '@/components/ProgressPoints.vue'

//  story32 below
describe('ProgressPoints.vue', () => {
  it('renders props.value when passed residentid 1', () => {
    const residentid = 1
    const msgpoints = 0
    const wrapper = shallowMount(Progress, {
      propsData: { msgpoints }
    })
    wrapper.setData({ tempResId: residentid, tempNum: msgpoints })
    expect(wrapper.vm.$data.tempNum).contain(msgpoints)
  })

  it('renders props.value when passed residentid 2', () => {
    const residentid = 2
    const msgpoints = null
    const wrapper = shallowMount(Progress, {
      propsData: { msgpoints }
    })
    wrapper.setData({ tempResId: residentid, tempNum: msgpoints })
    expect(wrapper.text()).to.include(msgpoints) // should return null
  })
})
