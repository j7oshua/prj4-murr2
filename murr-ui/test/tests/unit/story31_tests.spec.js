import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import CreateLogin from '../../../src/components/CreateLogin'

describe('CreateLogin.vue', () => {
  it('Successfully created login with all required fields', () => {
    const msg = 'Successfully created a Resident account.'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {email: 'email@email.com', phone: '306-111-1111', password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Successfully created login with minimum required fields, just email', () => {
    const msg = 'Successfully created a Resident account.'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {email: 'email@email.com', password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Successfully created login with minimum required fields, just phone', () => {
    const msg = 'Successfully created a Resident account.'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {phone: '306-111-1111', password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('No email or phone entered', () => {
    const msg = 'Must enter an email and/or phone number'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {email: '', phone: '', password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Improper email format entered', () => {
    const msg = 'Invalid email entered, please try again.'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {email: 'wrong.com', password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Improper phone entered with more than 10 characters', () => {
    const msg = 'Phone number must be 10 digits.'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    const wrong_phone = 111-111-11111;
    wrapper.setData( {phone: wrong_phone, password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Improper phone entered with characters instead of numbers', () => {
    const msg = 'Invalid phone number entered, cannot contain letters'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    const wrong_phone = 'aaa-aaa-aaaa';
    wrapper.setData( {phone: wrong_phone, password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Improper phone entered with less than 10 characters', () => {
    const msg = 'Phone number must be 10 digits.'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    const wrong_phone = 111-111;
    wrapper.setData( {phone: wrong_phone, password: 'Passw0rd'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Improper password entered, must contain at least one capital', () => {
    const msg = 'Password must be at least 7 characters, containing at least one capital letter and a number, and less than 30 characters'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {email: 'email@email.com', password: 'password'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Improper password entered, must contain at least one number', () => {
    const msg = 'Password must be at least 7 characters, containing at least one capital letter and a number, and less than 30 characters'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {email: 'email@email.com', password: 'Password'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Enters email too long over 150 characters', () => {
    const msg = 'Invalid email entered, email must be less than 150 characters, please try again.'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    const long_email = 'a'.repeat(151)
    wrapper.setData( {email: long_email, password: 'pass'})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Enters password too long over 30 characters', () => {
    const msg = 'Password must be at least 7 characters, containing at least one capital letter and a number, and less than 30 characters'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    const long_password = 'a'.repeat(31)
    wrapper.setData( {email: 'email@email.com', password: long_password})
    expect(wrapper.text()).to.include(msg)
  })
})
describe('CreateLogin.vue', () => {
  it('Enters password too short, must be over 7 characters', () => {
    const msg = 'Password must be at least 7 characters, containing at least one capital letter and a number, and less than 30 characters'
    const wrapper = shallowMount(CreateLogin, {
      propsData: { msg }
    })
    wrapper.setData( {email: 'email@email.com', password: 'pass'})
    expect(wrapper.text()).to.include(msg)
  })
})
