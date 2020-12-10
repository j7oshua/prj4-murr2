
import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Progress from '@/components/ProgressPoints.vue'

//story32 below
describe('ProgressPoints.vue', () => {

  it('renders props.value when passed residentid 1', () => {
    const residentid = 1;
    const msgpoints = "Points:0";
    const wrapper = shallowMount(Progress, {
      propsData: { id:0,residentid: residentid,points:null}
    })
    expect(wrapper.text()).to.include(msgpoints) //should return 0 for points:0
  })

  it('renders props.value when passed residentid 2', () => {
    const residentid = 1;
    const msgpoints = "Points:3";
    const wrapper = shallowMount(Progress, {
      propsData: { id:0,residentid: residentid,points:null}
    })
    expect(wrapper.text()).to.include(msgpoints) //should return 3 for points:3
  })

  it('renders props.value when passed residentid 3', () => {
    const residentid = 3;
    const msgpoints = "Points:80";
    const wrapper = shallowMount(Progress, {
      propsData: { id:0,residentid: residentid,points:null}
    })
    expect(wrapper.text()).to.include(msgpoints) //should return 80 for points:80
  })

  it('renders props.value when passed residentid 4', () => {
    const residentid = 4;
    const msgpoints = "Points:0";
    const wrapper = shallowMount(Progress, {
      propsData: { id:0,residentid: residentid,points:null}
    })
    expect(wrapper.text()).to.include(msgpoints) //default to zero for points:0
  })
});
