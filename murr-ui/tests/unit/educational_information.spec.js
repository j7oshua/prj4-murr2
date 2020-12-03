import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import RecyclingInformation from '@/components/RecyclingInformation'

describe('RecyclingInformation.vue', () => {
  it('should show props.msg when passed', () => {
    const msg = 'Passed'
    const wrapper = shallowMount(RecyclingInformation, {
      propsData: { msg }
    })
    expect(wrapper.text()).to.include(msg)
  })
})
