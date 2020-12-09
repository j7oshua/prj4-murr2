import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Progress from '@/components/ProgressPoints.vue'

//story32 below
describe('ProgressPoints.vue', () => {

  it('renders props.value when passed residentid 1', () => {
    const residentid = 1
    const wrapper = shallowMount(Progress, {
      propsData: { id:0,residentid: residentid,points:null}
    })
    expect(wrapper.text()).to.include(0)
  })

  it('renders props.value when passed residentid 2', () => {
    const residentid = 1
    const wrapper = shallowMount(Progress, {
      propsData: { id:0,residentid: residentid,points:null}
    })
    expect(wrapper.text()).to.include(3)
  })

  it('renders props.value when passed residentid 3', () => {
    const residentid = 3
    const wrapper = shallowMount(Progress, {
      propsData: { id:0,residentid: residentid,points:null}
    })
    expect(wrapper.text()).to.include(80)
  })

  it('renders props.value when passed residentid 4', () => {
    const residentid = 4
    const wrapper = shallowMount(Progress, {
      propsData: { id:0,residentid: residentid,points:null}
    })
    expect(wrapper.text()).to.include(0)
  })
})
