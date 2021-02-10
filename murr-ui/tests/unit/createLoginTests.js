// //import { expect } from 'chai'
// import { shallowMount } from '@vue/test-utils'
// import CreateLogin from '@/components/CreateLogin'
//
// describe('CreateLogin.vue', () => { // successful test, all attributes entered
//   it('Resident enters valid email, and valid phone number and valid password', () => {
//     const msg = 'Successfully created a Resident account.'
//     const wrapper = shallowMount(CreateLogin, {
//       props: { msg }
//     })
//     wrapper.setData({ email: 'email@email.com', phone: '306-111-1111', password: '1234567' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters valid email and valid password', () => {
//     const msg = 'Successfully created a Resident account.'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     wrapper.setData({ email: 'email@email.com', password: 'Passw0rd' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters valid phone number and valid password', () => {
//     const msg = 'Successfully created a Resident account.'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     wrapper.setData({ phone: '306-111-1111', password: 'Passw0rd' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters just a password', () => {
//     const msg = 'Must enter an email and/or phone number'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     wrapper.setData({ email: '', phone: '', password: 'Passw0rd' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters invalid email format and valid password', () => {
//     const msg = 'Invalid email entered, please try again.'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     wrapper.setData({ email: 'wrong.com', password: 'Passw0rd' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters invalid phone containing more than 10 digits and valid password', () => {
//     const msg = 'Phone number must be 10 digits.'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     const wrong_phone = '111-111-11111'
//     wrapper.setData({ phone: wrong_phone, password: 'Passw0rd' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters invalid phone with characters and valid password', () => {
//     const msg = 'Invalid phone number entered, cannot contain letters'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     const wrong_phone = 'aaa-aaa-aaaa'
//     wrapper.setData({ phone: wrong_phone, password: 'Passw0rd' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters invalid phone containing more than 10 digits and valid password', () => {
//     const msg = 'Phone number must be 10 digits.'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     const wrong_phone = '111-111'
//     wrapper.setData({ phone: wrong_phone, password: 'Passw0rd' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters valid email and incorrect password, no capital letters', () => {
//     const msg = 'Password must be at least 7 characters, containing at least one capital letter and a number, and less than 30 characters'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     wrapper.setData({ email: 'email@email.com', password: 'password' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters valid email and incorrect password, shorter than 7 characters', () => {
//     const msg = 'Password must be at least 7 characters, containing at least one capital letter and a number, and less than 30 characters'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     wrapper.setData({ email: 'email@email.com', password: 'Password' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters invalid email over 150 characters and valid password', () => {
//     const msg = 'Invalid email entered, email must be less than 150 characters, please try again.'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     const long_email = 'a'.repeat(151)
//     wrapper.setData({ email: long_email, password: 'pass' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters valid email and incorrect password, longer than 30 characters', () => {
//     const msg = 'Password must be at least 7 characters, containing at least one capital letter and a number, and less than 30 characters'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     const long_password = 'a'.repeat(31)
//     wrapper.setData({ email: 'email@email.com', password: long_password })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters valid email and incorrect password, shorter than 7 characters', () => {
//     const msg = 'Password must be at least 7 characters, containing at least one capital letter and a number, and less than 30 characters'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     wrapper.setData({ email: 'email@email.com', password: 'pass' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters only email and/or phone number and no password', () => {
//     const msg = 'Must enter a password.'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     wrapper.setData({ email: 'email@email.com', password: '' })
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('Resident enters no information', () => {
//     const msg = 'Must enter an email and/or phone number'
//     const wrapper = shallowMount(CreateLogin, {
//       propsData: { msg }
//     })
//     wrapper.setData({ phone: '', email: '', password: '' })
//     expect(wrapper.text()).to.include(msg)
//   })
// })
//
