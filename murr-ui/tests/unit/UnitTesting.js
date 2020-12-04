import ProfileForm from '/components/ProfileForm'
import {shallowMount} from "@vue/test-utils";

// describe('ProfileDetails.vue', () => {
//   it('renders props.msg when passed', () => {
//     const msg = 'Passed';
//     const wrapper = shallowMount(ProfileCompletion, {
//       propsData: { msg }
//     });
//     expect(wrapper.text()).to.include(msg)
//   })



describe('ProfileForm', () => {
  it('renders a profile form Screen and responds correctly to user input', () => {
    const wrapper = shallowMount(ProfileForm, {
      data() {
        return {
          firstName: 'Lane',
          lastName: 'Lockhart',
          address: '222 seventh st west',
          city: 'Warman',
          province: 'SK',
          postalCode: 'S0K4S0'
        }
      }
    });

    // see if the message renders
    expect(wrapper.find('.firstName').text()).toEqual('Lane');

    // assert the error is rendered
    expect(wrapper.find('.error').exists()).toBeTruthy();

    // update the `username` and assert error is no longer rendered
    wrapper.setData({ firstName: '' });
    expect(wrapper.find('.error').exists()).toBeFalsy();
  })
});
