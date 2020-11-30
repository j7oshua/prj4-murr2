import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Progress from '@/components/ProgressPoints.vue'

describe('ProgressPoints.vue', () => {
  it('renders props.msg when passed', () => {
    const msg = 'Great Job!'
    const wrapper = shallowMount(Progress, {
      propsData: { msg }
    })
    expect(wrapper.text()).to.include(msg)
  })
})

describe('ProgressPoints.vue', () => {
  it('renders props.value when passed', () => {
    const PointValue = 1
    const wrapper = shallowMount(Progress, {
      propsData: { PointValue }
    })
    expect(wrapper.text()).to.include(PointValue)
  })
})
