import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Progress from '@/components/ProgressPoints.vue'

describe('ProgressPoints.vue', () => {

  it('renders props.value when passed 1', () => {
    const PointValue = 1
    const wrapper = shallowMount(Progress, {
      propsData: { PointValue }
    })
    expect(wrapper.text()).to.include(PointValue)
  })

  it('renders props.value when passed 0', () => {
    const PointValue = 0
    const wrapper = shallowMount(Progress, {
      propsData: { PointValue }
    })
    expect(wrapper.text()).to.include(PointValue)
  })

})
