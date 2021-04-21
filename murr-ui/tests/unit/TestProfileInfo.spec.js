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
    expect(wrapper.find('#editProfileTitle').exists()).to.equal(false)
    await wrapper.setData({
      tempProfile: {
        firstName: 'Tom'
      },
      editMode: true
    })
    expect(wrapper.find('#editProfileTitle').text()).to.equal('Edit Profile Information')
    expect(wrapper.find('#validFirstName').text()).to.equal('The first name is valid')
  })

  it('Should unsuccessfully update with too long first name', async () => {
    await wrapper.setData({
      tempProfile: {
        firstName: 'f'.repeat(21)
      },
      editMode: true
    })
    expect(wrapper.find('#invalidFirstName').text()).to.equal('First Name cannot be longer than 20 characters')
  })

  it('Should successfully render last name on the last name input', async () => {
    await wrapper.setData({
      tempProfile: {
        lastName: 'Andrews'
      },
      editMode: true
    })
    expect(wrapper.find('#validLastName').text()).to.equal('The last name is valid')
  })

  it('Should unsuccessfully update with too long last name', async () => {
    await wrapper.setData({
      tempProfile: {
        lastName: 'l'.repeat(21)
      },
      editMode: true
    })
    expect(wrapper.find('#invalidLastName').text()).to.equal('Last Name cannot be longer than 20 characters')
  })

  it('Should successfully update with valid image file for profile picture', async () => {
    await wrapper.setData({
      file: {
        name: 'test.jpg',
        size: (1024 * 1024 * 2),
        type: 'image/jpg'
      },
      editMode: true
    })
    expect(wrapper.find('#validProfPicSize').text()).to.equal('Profile pic is valid')
  })

  it('Should unsuccessfully update with invalid too large image for profile picture', async () => {
    await wrapper.setData({
      file: {
        name: 'test.jpg',
        size: (1024 * 1024 * 2 + 1),
        type: 'image/jpg'
      },
      editMode: true
    })
    expect(wrapper.find('#invalidProfPicSize').text()).to.equal('Profile pic cannot be larger than 2MB')
  })

  it('Should unsuccessfully render with all the inputs empty', async () => {
    await wrapper.setData({
      tempProfile: {
        firstName: '',
        lastName: ''
      },
      file: [],
      editMode: true
    })
    expect(wrapper.find('#validFirstName').text()).to.equal('The first name is valid')
    expect(wrapper.find('#validLastName').text()).to.equal('The last name is valid')
    expect(wrapper.find('#validProfPicSize').text()).to.equal('Profile pic is valid')
  })
})
