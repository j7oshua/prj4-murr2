import ProfileCompletion from '/components/ProfileDetails.vue'
import {shallowMount} from "@vue/test-utils";

// describe('ProfileDetails.vue', () => {
//   it('renders props.msg when passed', () => {
//     const msg = 'Passed';
//     const wrapper = shallowMount(ProfileCompletion, {
//       propsData: { msg }
//     });
//     expect(wrapper.text()).to.include(msg)
//   })
//
//   it('renders props.msg when failed', () => {
//     const msg = 'Failed';
//     const wrapper = shallowMount(ProfileCompletion, {
//       propsData: { msg }
//     });
//     expect(wrapper.text()).to.include(msg)
//   })


// });


describe('ProfileCompletion', () => {
  it('renders a profileCompletion Screen and responds correctly to user input', () => {
    const wrapper = shallowMount(Foo, {
      data() {
        return {
          message: 'Hello World',
          username: ''
        }
      }
    })

    // see if the message renders
    expect(wrapper.find('.message').text()).toEqual('Hello World')

    // assert the error is rendered
    expect(wrapper.find('.error').exists()).toBeTruthy()

    // update the `username` and assert error is no longer rendered
    wrapper.setData({ username: 'Lachlan' })
    expect(wrapper.find('.error').exists()).toBeFalsy()
  })
})
