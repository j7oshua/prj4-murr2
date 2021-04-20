import { shallowMount } from '@vue/test-utils'
import ProfileInfo from '@/components/ProfileInfo'
import { BootstrapVue } from 'bootstrap-vue'
import Vue from 'vue'
import { expect } from 'chai'

Vue.use(BootstrapVue)
let wrapper
// let wrapperInvalid
// Gotta go over tests today

describe('Points', () => {
  beforeEach(() => {
    wrapper = shallowMount(ProfileInfo, {
      propsData: {
        profile: {
          firstName: 'John',
          lastName: 'Doe',
          profilePic: null
        },
        residentID: 1,
        showModal: true
      }
    })
  })

  it('Should display profile information from the modal', async () => {
    expect(wrapper.find('#profileTitle').text()).to.equal('Profile Information')
    expect(wrapper.find('#viewProfileName').text()).to.equal('John Doe')
  })

  it('Should successfully render first name on the first name input', async () => {
    await wrapper.setData({
      editMode: true
    })
    // await wrapper.find('#btnEditOrSave').trigger('click')
    // console.log(wrapper.find('#btnEditOrSave').html())
    const inputFirst = wrapper.find('#firstNameInput')
    inputFirst.element.value = 'Tom'
    expect(wrapper.find('#editProfileTitle').text()).to.equal('Edit Profile Information')
    expect(wrapper.find('#firstNameInput').element.value).to.equal('Tom')
    expect(wrapper.find('#validFirstName').text()).to.equal('The first name is valid')
  })

  it('Should unsuccessfully update with too long first name', async () => {
    wrapper.find('#btnEditOrSave').trigger('click')
    await wrapper.setData({
      editMode: true
    })
    const inputFirst = wrapper.find('#firstNameInput')
    inputFirst.element.value = 'l'.repeat(21)
    expect(wrapper.find('#editProfileTitle').text()).to.equal('Edit Profile Information')
    expect(wrapper.find('#firstNameInput').element.value).to.equal('l'.repeat(21))
    await wrapper.setData({
      tempProfile: {
        firstName: 'l'.repeat(21)
      }
    })
    expect(wrapper.find('#invalidFirstName').text()).to.equal('First Name cannot be longer than 20 characters')
  })

  it('Should successfully render last name on the last name input', async () => {
    wrapper.find('#btnEditOrSave').trigger('click')
    await wrapper.setData({
      editMode: true
    })
    const inputLast = wrapper.find('#lastNameInput')
    inputLast.element.value = 'Andrews'
    expect(wrapper.find('#editProfileTitle').text()).to.equal('Edit Profile Information')
    expect(wrapper.find('#lastNameInput').element.value).to.equal('Andrews')
    expect(wrapper.find('#validLastName').text()).to.equal('The last name is valid')
  })

  it('Should unsuccessfully update with too long last name', async () => {
    wrapper.find('#btnEditOrSave').trigger('click')
    await wrapper.setData({
      editMode: true
    })
    const inputLast = wrapper.find('#lastNameInput')
    inputLast.element.value = 'l'.repeat(21)
    expect(wrapper.find('#editProfileTitle').text()).to.equal('Edit Profile Information')
    expect(wrapper.find('#lastNameInput').element.value).to.equal('l'.repeat(21))
    await wrapper.setData({
      tempProfile: {
        lastName: 'l'.repeat(21)
      }
    })
    expect(wrapper.find('#invalidLastName').text()).to.equal('Last Name cannot be longer than 20 characters')
  })

  it('Should successfully update with valid image file for profile picture', async () => {
    await wrapper.setProps({
      residentID: 1,
      showModal: true,
      profile: {
        firstName: 'Mark',
        lastName: 'Jacobs',
        profilePic: null
      }
    })
    await wrapper.setData({
      editMode: true
    })
    wrapper.find('#btnEditOrSave').trigger('click')
    expect(wrapper.find('#editProfileTitle').text()).to.equal('Edit Profile Information')
    await wrapper.setData({
      file: {
        name: 'test.jpg',
        size: 50000,
        type: 'image/jpg'
      }
    })
    expect(wrapper.find('#validProfPicSize').text()).to.equal('Profile pic is valid')
  })

  it('Should unsuccessfully update with invalid too large image for profile picture', async () => {
    // wrapper.find('#btnEditOrSave').trigger('click')
    await wrapper.setData({
      editMode: true
    })
    expect(wrapper.find('#editProfileTitle').text()).to.equal('Edit Profile Information')
    await wrapper.setData({
      file: {
        name: 'test2.jpg',
        size: 5000000000,
        type: 'image/jpg'
      }
    })
    expect(wrapper.find('#invalidProfPicSize').text()).to.equal('Profile pic cannot be larger than 2MB')
  })

  it('Should unsuccessfully render with all the inputs empty', async () => {
    wrapper.find('#btnEditOrSave').trigger('click')
    await wrapper.setData({
      editMode: true
    })
    const inputFirst = wrapper.find('#firstNameInput')
    const inputLast = wrapper.find('#lastNameInput')
    const inputProfPic = wrapper.find('#profPicInput')
    inputFirst.element.value = ''
    inputLast.element.value = ''
    inputProfPic.element.value = ''
    expect(wrapper.find('#editProfileTitle').text()).to.equal('Edit Profile Information')
    expect(wrapper.find('#firstNameInput').element.value).to.equal('')
    expect(wrapper.find('#lastNameInput').element.value).to.equal('')
    expect(wrapper.find('#profPicInput').element.value).to.equal('')
    await wrapper.setData({
      tempProfile: {
        firstName: '',
        lastName: ''
      },
      file: []
    })
    expect(wrapper.find('#validFirstName').text()).to.equal('The first name is valid')
    expect(wrapper.find('#validLastName').text()).to.equal('The last name is valid')
    expect(wrapper.find('#validProfPicSize').text()).to.equal('Profile pic is valid')
  })
})
