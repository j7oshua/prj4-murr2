import { shallowMount } from '@vue/test-utils'
import ProfileInfo from '@/components/ProfileInfo'
import { BootstrapVue } from 'bootstrap-vue'
import Vue from 'vue'
// import Points from '../../src/views/Points'
import { expect } from 'chai'
import Points from '../../src/views/Points'

Vue.use(BootstrapVue)
let wrapper
// let wrapperInvalid
// Gotta go over tests today

describe('Points', () => {
  beforeEach(() => {
    wrapper = shallowMount(ProfileInfo, {
      propsData: {
        profile: {
          firstName: '',
          lastName: '',
          profilePic: 'profile_default.jpg'
        },
        residentID: 1
      }
    })
  })

  it('Should display profile information from the modal', async () => {
    wrapper = shallowMount(Points, {
      propsData: {
        profile: {
          firstName: 'Tom',
          lastName: 'Andrews',
          profilePic: 'profile_default.jpg'
        },
        residentID: 1
      },
      created: {

      }
    })
    expect(wrapper.find('#viewProfileName').text()).to.equal('Tom Andrews')
  })

  it('Should successfully render first name on the first name input', async () => {
    wrapper.find('#btnEditOrSave').trigger('click')
    await wrapper.setData({
      editMode: true
    })
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
    wrapper.find('#btnEditOrSave').trigger('click')
    await wrapper.setData({
      editMode: true
    })
    const image = [{
      name: 'test.jpg',
      size: 50000,
      type: 'image/jpg'
    }]
    const inputProfilePic = wrapper.find('#profPicInput')
    inputProfilePic.element.value = image
    await wrapper.setData({
      file: image
    })
    expect(wrapper.find('#profPicInput').element.value).to.equal(image)
    expect(wrapper.find('#editProfileTitle').text()).to.equal('Edit Profile Information')
    expect(wrapper.find('#validProfPicSize').text()).to.equal('Profile pic is valid')
  })

  it('Should unsuccessfully update with invalid too large image for profile picture', async () => {
    wrapper.find('#btnEditOrSave').trigger('click')
    await wrapper.setData({
      editMode: true
    })
    const image2 = [{
      name: 'test2.jpg',
      size: 4000001,
      type: 'image/jpg'
    }]
    const inputProfilePic = wrapper.find('#profPicInput')
    inputProfilePic.element.value = image2
    await wrapper.setData({
      file: image2
    })
    expect(wrapper.find('#profPicInput').element.value).to.equal(image2)
    expect(wrapper.find('#editProfileTitle').text()).to.equal('Edit Profile Information')
    expect(wrapper.find('#invalidProfPicSize').text()).to.equal('Profile pic cannot be larger than 2MB')
  })

  it('Should unsuccessfully update with all the inputs empty', async () => {
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
