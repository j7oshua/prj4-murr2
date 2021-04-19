import { shallowMount } from '@vue/test-utils'
import ProfileInfo from '@/components/ProfileInfo'
import { BootstrapVue } from 'bootstrap-vue'
import Vue from 'vue'
// import Points from '../../src/views/Points'
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
          firstName: '',
          lastName: '',
          profilePic: 'profile_default.jpg'
        },
        residentID: 1
      }
    })
  })

  it('Should successfully render first name on the first name input', async () => {
    wrapper.find('#editProfileTitle')
    wrapper.find('#btnEditOrSave').trigger('click')
    await wrapper.setData({
      editMode: true
    })
    const inputFirst = wrapper.find('#firstNameInput')
    inputFirst.element.value = 'Tom'
    expect(wrapper.find('#firstNameInput').element.value).to.equal('Tom')
  })

  it('Should unsuccessfully update with too long first name', async () => {
    // wrapper = shallowMount(ProfileInfo, {
    //   propsData: {
    //     profile: {
    //       firstName: '',
    //       lastName: '',
    //       profilePic: 'profile_default.jpg'
    //     },
    //     residentID: 1
    //   },
    //   computed: {
    //     fNameError () {
    //       return true
    //     }
    //   }
    // })
    wrapper.find('#editProfileTitle')
    wrapper.find('#btnEditOrSave').trigger('click')
    await wrapper.setData({
      editMode: 'true',
      fNameState: 'false'
    })
    const inputFirst = wrapper.find('#firstNameInput')
    inputFirst.element.value = 'l'.repeat(21)
    expect(wrapper.find('#firstNameInput').element.value).to.equal('l'.repeat(21))
    expect(wrapper.find('#fNameInvalid').element.value).to.equal('First Name cannot be longer than 20 characters')
  })

  it('Should successfully render last name on the last name input', async () => {
    wrapper.find('#editProfileTitle')
    wrapper.find('#btnEditOrSave').trigger('click')
    await wrapper.setData({
      editMode: true
    })
    const inputFirst = wrapper.find('#lastNameInput')
    inputFirst.element.value = 'Andrews'
    expect(wrapper.find('#lastNameInput').element.value).to.equal('Andrews')
  })

  it('Should unsuccessfully update with too long last name', async () => {
    const inputLast = wrapper.find('#lastName')
    await inputLast.setValue('l'.repeat(21))
    expect(wrapper.find('#validInput').text()).to.equal('Unable to update profile information')
  })

  it('Should successfully update with valid image file for profile picture', async () => {
    const inputPicture = wrapper.find('#profPicInput')
    inputPicture.element.value = 'profile_default.jpg'
    expect(wrapper.find('#validInput').text()).to.equal('Profile information has been updated')
  })

  it('Should unsuccessfully update with invalid image file for profile picture', async () => {
    const inputPicture = wrapper.find('#picture')
    await inputPicture.setValue('C:/image.jpg')
    expect(wrapper.find('#validInput').text()).to.equal('Unable to update profile information')
  })

  it('Should unsuccessfully update with all the inputs empty', async () => {
    const inputFirst = wrapper.find('#picture')
    const inputLast = wrapper.find('#lastName')
    const inputPicture = wrapper.find('#picture')

    await inputFirst.setValue('')
    await inputLast.setValue('')
    await inputPicture.setValue('')
    expect(wrapper.find('#validInput').text()).to.equal('Unable to update profile information')
  })
})
