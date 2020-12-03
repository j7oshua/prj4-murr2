import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import CreateLogin from '../../../src/components/CreateLogin'

describe('CreateLogin.vue', () => {
  it('Successfully created login with all required fields', () => {
    const msg = 'Successfully created login'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {email: 'email@email.com', phone: '306-111-1111', password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Successfully created login with minimum required fields, just email', () => {
    const msg = 'Successfully created login'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {email: 'email@email.com', password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Successfully created login with minimum required fields, just phone', () => {
    const msg = 'Successfully created login'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {phone: '306-111-1111', password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('No email or phone entered', () => {
    const msg = 'Must enter a phone number or email'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {email: '', phone: '', password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Improper email format entered', () => {
    const msg = 'Must enter a proper email'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {email: 'wrong.com', password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Improper phone entered', () => {
    const msg = 'Must enter a proper phone number'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    const wrong_phone = 111-111-11111;
    wrapper.setData( {phone: wrong_phone, password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Improper password entered', () => {
    const msg = 'Must enter a proper password'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {email: 'email@email.com', password: 'pass'})
    expect(wrapper.text()).to.include(msg)
  })
})
