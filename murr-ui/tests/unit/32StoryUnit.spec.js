import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Progress from '@/components/ProgressPoints.vue'

describe('ProgressPoints.vue', () => {
  it('renders props.msg when passed success', () => {
    const msg = 'Great Job!'
    const wrapper = shallowMount(Progress, {
      propsData: { msg }
    })
    expect(wrapper.text()).to.include(msg)
  })

  it('does not render props.msg when passed shows ERROR', () => {
    const msg = 'Sorry, Runtime Error: 443. Go back to previous page'
    const wrapper = shallowMount(Progress, {
      propsData: { msg }
    })
    expect(wrapper.text()).to.include(msg)
  })

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

  it('ERROR when passed null or no connected account', () => {
    const PointValue = null
    const wrapper = shallowMount(Progress, {
      propsData: { PointValue }
    })
    expect(wrapper.text()).to.include('Sorry, Error: 442. Go back and log in or wait for your account to be created')
  })
})
