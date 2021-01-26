import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Points from '@/components/ProgressPoints.vue'

describe('ProgressPoints.vue', () => {
  it('renders props.msg when passed', () => {
    const msg = 'new message'
    const wrapper = shallowMount(Points, {
      propsData: { msg }
    })
    expect(wrapper.text()).to.include(msg)
  })
})
